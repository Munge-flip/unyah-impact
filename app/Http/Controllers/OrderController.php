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
            'final_payment_status' => 'nullable|string|in:paid,unpaid', 
        ]);

        $finalStatus = $request->input('final_payment_status', 'unpaid');

        Order::create([
            'user_id' => Auth::id(),
            'game' => $validated['game'],
            'service_category' => $validated['service_category'],
            'service_type' => $validated['service_type'],
            'price' => $validated['price'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            
            'payment_status' => $finalStatus, 
        ]);

        return redirect()->route('user.order')->with('success', 'Order placed successfully!');
    }
}