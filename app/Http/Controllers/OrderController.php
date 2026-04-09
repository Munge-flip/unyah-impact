<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game' => 'required|string',
            'service_category' => 'required|string',
            'service_type' => 'required|string',
            'price' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);


        $order = Order::create([
            'user_id' => Auth::id(),
            'game' => $validated['game'],
            'service_category' => $validated['service_category'],
            'service_type' => $validated['service_type'],
            'price' => $validated['price'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            
            'payment_status' => 'unpaid', 
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order placed! Please submit your payment details below.',
                'order_id' => $order->id,
                'redirect' => "/user/order/{$order->id}"
            ]);
        }

        return redirect()->route('user.order.show', $order->id) // Redirect to specific order
            ->with('success', 'Order placed! Please submit your payment details below.');
    }
}