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

        return redirect()->route('user.order.show', $order->id) // Redirect directly to the order to pay
            ->with('success', 'Order placed! Please submit your payment details below.');
    }
}