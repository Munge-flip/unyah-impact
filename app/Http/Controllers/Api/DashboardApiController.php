<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;

class DashboardApiController extends Controller
{
    /**
     * Get Admin Dashboard Statistics
     */
    public function index()
    {
        try {
            $totalOrders = Order::count();
            $verifiedOrders = Order::where('payment_status', 'paid')->count();
            $activeAgents = User::where('role', 'agent')->count();
            $totalUsers = User::where('role', 'user')->count();
            $revenue = Order::where('status', 'completed')->sum('price');
            
            $pendingTransactions = Transaction::where('status', 'pending')->count();
            $verifiedTransactions = Transaction::where('status', 'verified')->count();
            $totalTransactions = Transaction::count();

            $recentOrders = Order::with('user:id,name')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'game' => $order->game,
                        'service_type' => $order->service_type,
                        'user_name' => $order->user->name ?? 'Unknown',
                        'created_at_human' => $order->created_at->diffForHumans(),
                    ];
                });

            $recentTransactions = Transaction::with(['user:id,name', 'order:id'])
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($transaction) {
                    return [
                        'id' => $transaction->id,
                        'amount' => $transaction->amount,
                        'status' => $transaction->status,
                        'user_name' => $transaction->user->name ?? 'Unknown',
                        'order_id' => $transaction->order_id,
                        'created_at_human' => $transaction->created_at->diffForHumans(),
                    ];
                });

            return response()->json([
                'success' => true,
                'stats' => [
                    'totalOrders' => $totalOrders,
                    'activeAgents' => $activeAgents,
                    'totalUsers' => $totalUsers,
                    'revenue' => (float) $revenue,
                    'pendingTransactions' => $pendingTransactions,
                    'verifiedTransactions' => $verifiedTransactions,
                    'totalTransactions' => $totalTransactions,
                ],
                'recentOrders' => $recentOrders,
                'recentTransactions' => $recentTransactions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch dashboard statistics.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
