<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show($orderId)
    {
        $order = Order::with('messages.user')->findOrFail($orderId);

        $user = Auth::user();
        if ($user->id !== $order->user_id && $user->id !== $order->agent_id && $user->role !== 'admin') {
            abort(403, 'Unauthorized access to this chat.');
        }

        return view('chat.show', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $order = Order::findOrFail($orderId);

        Message::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back();
    }
}