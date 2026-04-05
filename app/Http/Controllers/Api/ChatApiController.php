<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatApiController extends Controller
{
    /**
     * Get all messages for an order.
     * GET /api/v1/orders/{orderId}/messages
     */
    public function index($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Security check
        $user = Auth::user();
        if ($user->id !== $order->user_id && $user->id !== $order->agent_id && $user->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $messages = Message::where('order_id', $orderId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function($msg) {
                return [
                    'id' => $msg->id,
                    'user_id' => $msg->user_id,
                    'message' => $msg->message,
                    'created_at_human' => $msg->created_at->format('h:i A'),
                ];
            });

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }

    /**
     * Store a new message.
     * POST /api/v1/orders/{orderId}/messages
     */
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $order = Order::findOrFail($orderId);
        
        // Security check
        $user = Auth::user();
        if ($user->id !== $order->user_id && $user->id !== $order->agent_id && $user->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $message = Message::create([
            'order_id' => $order->id,
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'user_id' => $message->user_id,
                'message' => $message->message,
                'created_at_human' => $message->created_at->format('h:i A'),
            ]
        ]);
    }
}
