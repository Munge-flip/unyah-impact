<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'order', 'verifiedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($transactions);
    }

    public function userTransactions()
    {
        $transactions = Auth::user()->transactions()
            ->with('order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $transactions->items(),
            'meta' => [
                'current_page' => $transactions->currentPage(),
                'last_page' => $transactions->lastPage(),
                'total' => $transactions->total(),
            ]
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'order', 'verifiedBy'])->findOrFail($id);

        if (Auth::user()->role === 'user' && $transaction->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'transaction_reference' => 'nullable|string|max:255',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        if ($order->transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction already exists for this order.'
            ], 422);
        }

        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->user_id = Auth::id();
        $transaction->amount = $order->price;
        $transaction->payment_method = $order->payment_method;
        $transaction->transaction_reference = $validated['transaction_reference'] ?? null;
        $transaction->paid_at = now();

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment-proofs', 'public');
            $transaction->payment_proof = $path;
        }

        $transaction->save();

        $order->payment_status = 'pending_verification';
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment submitted! Waiting for admin verification.',
            'data' => $transaction->load('order')
        ]);
    }

    public function verify(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:verified,rejected',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->status = $validated['status'];
        $transaction->admin_notes = $validated['admin_notes'] ?? null;
        $transaction->verified_by = Auth::id();
        $transaction->verified_at = now();
        $transaction->save();

        if ($validated['status'] === 'verified') {
            $transaction->order->payment_status = 'paid';
            $transaction->order->save();
        } else {
            $transaction->order->payment_status = 'unpaid';
            $transaction->order->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaction ' . $validated['status'] . ' successfully!',
            'data' => $transaction->fresh()->load(['user', 'order', 'verifiedBy'])
        ]);
    }

    public function downloadProof($id)
    {
        $transaction = Transaction::findOrFail($id);

        if (!$transaction->payment_proof) {
            return response()->json(['message' => 'No payment proof available.'], 404);
        }

        return Storage::disk('public')->download($transaction->payment_proof);
    }
}
