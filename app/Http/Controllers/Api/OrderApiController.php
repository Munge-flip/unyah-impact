<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    /**
     * Display a listing of orders.
     * GET /api/v1/orders
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Order::with(['user', 'agent']);

        // Role-Based Filtering Logic
        if ($user->role === 'admin') {
            // ADMIN: Only show orders that have been VERIFIED (paid)
            $query->where('payment_status', 'paid')
                  ->orderBy('updated_at', 'desc'); // Recently acted upon first
            
            if ($request->has('user_id')) {
                $query->where('user_id', $request->user_id);
            }
            if ($request->has('agent_id')) {
                $query->where('agent_id', $request->agent_id);
            }
        } 
        elseif ($user->role === 'agent') {
            // AGENT: Only show orders ASSIGNED to this agent
            $query->where('agent_id', $user->id)
                  ->orderBy('updated_at', 'desc');
        } 
        else {
            // USER: Only show orders PLACED by this user
            $query->orderBy('created_at', 'desc')
                  ->where('user_id', $user->id);
        }

        // Other shared filters
        if ($request->has('game')) {
            $query->where('orders.game', $request->game);
        }
        if ($request->has('status')) {
            $query->where('orders.status', $request->status);
        }

        // Instant Search Logic
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('orders.id', 'like', "%{$search}%")
                  ->orWhere('orders.game', 'like', "%{$search}%")
                  ->orWhere('orders.service_type', 'like', "%{$search}%")
                  ->orWhere('orders.service_category', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Orders retrieved successfully',
            'data' => $orders->items(),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ]
        ], 200);
    }

    /**
     * Store a newly created order.
     * POST /api/v1/orders
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'game' => 'required|string',
                'service_category' => 'required|string',
                'service_type' => 'required|string',
                'price' => 'required|numeric|min:0',
                'payment_method' => 'required|string',
            ]);

            $order = Order::create([
                'user_id' => $validated['user_id'],
                'game' => $validated['game'],
                'service_category' => $validated['service_category'],
                'service_type' => $validated['service_type'],
                'price' => $validated['price'],
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order->load(['user'])
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
     * Display the specified order.
     * GET /api/v1/orders/{id}
     */
    public function show($id)
    {
        $order = Order::with(['user', 'agent', 'messages', 'transaction'])->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order retrieved successfully',
            'data' => $order
        ], 200);
    }

    /**
     * Update the specified order.
     * PUT/PATCH /api/v1/orders/{id}
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'status' => 'sometimes|in:pending,in-progress,completed',
                'payment_status' => 'sometimes|in:unpaid,pending_verification,paid',
                'agent_id' => 'sometimes|nullable|exists:users,id',
            ]);

            $order->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'data' => $order->fresh()->load(['user', 'agent'])
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
     * Remove the specified order.
     * DELETE /api/v1/orders/{id}
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ], 200);
    }
}