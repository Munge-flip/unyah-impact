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

        return view('admin.transactions.index', compact('transactions'));
    }

    public function userTransactions()
    {
        $transactions = Auth::user()->transactions()
            ->with('order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'order', 'verifiedBy'])->findOrFail($id);

        if (Auth::user()->role === 'user' && $transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        if (Auth::user()->role === 'admin') {
            return view('admin.transactions.show', compact('transaction'));
        }

        return view('user.transactions.show', compact('transaction'));
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
            return back()->with('error', 'Transaction already exists for this order.');
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

        return redirect()->route('user.transactions.show', $transaction->id)
            ->with('success', 'Payment submitted! Waiting for admin verification.');
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

        return back()->with('success', 'Transaction ' . $validated['status'] . ' successfully!');
    }

    public function downloadProof($id)
    {
        $transaction = Transaction::findOrFail($id);

        if (!$transaction->payment_proof) {
            return back()->with('error', 'No payment proof available.');
        }

        return Storage::disk('public')->download($transaction->payment_proof);
    }
}