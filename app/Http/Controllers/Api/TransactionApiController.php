<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    /**
     * Display a listing of transactions.
     * GET /api/v1/transactions
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'order', 'verifiedBy']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by user_id
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by payment method
        if ($request->has('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Transactions retrieved successfully',
            'data' => $transactions
        ], 200);
    }

    /**
     * Store a newly created transaction.
     * POST /api/v1/transactions
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'user_id' => 'required|exists:users,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|string',
                'transaction_reference' => 'nullable|string|max:255',
            ]);

            $transaction = Transaction::create([
                'order_id' => $validated['order_id'],
                'user_id' => $validated['user_id'],
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'transaction_reference' => $validated['transaction_reference'] ?? null,
                'status' => 'pending',
                'paid_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully',
                'data' => $transaction->load(['user', 'order'])
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified transaction.
     * GET /api/v1/transactions/{id}
     */
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'order', 'verifiedBy'])->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaction retrieved successfully',
            'data' => $transaction
        ], 200);
    }

    /**
     * Update the specified transaction (verify/reject).
     * PUT/PATCH /api/v1/transactions/{id}
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'status' => 'sometimes|in:pending,verified,rejected,refunded',
                'admin_notes' => 'nullable|string|max:500',
                'verified_by' => 'sometimes|nullable|exists:users,id',
            ]);

            // If status is being changed to verified/rejected, update verification info
            if (isset($validated['status']) && in_array($validated['status'], ['verified', 'rejected'])) {
                $validated['verified_at'] = now();
                
                // Update related order payment status
                if ($validated['status'] === 'verified') {
                    $transaction->order->update(['payment_status' => 'paid']);
                } else {
                    $transaction->order->update(['payment_status' => 'unpaid']);
                }
            }

            $transaction->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Transaction updated successfully',
                'data' => $transaction->fresh()->load(['user', 'order', 'verifiedBy'])
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified transaction.
     * DELETE /api/v1/transactions/{id}
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ], 200);
    }
}