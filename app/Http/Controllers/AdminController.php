<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function profile()
    {
        return response()->json([
            'success' => true,
            'data' => Auth::user()
        ]);
    }

    public function editProfile()
    {
        // In SPA, this just returns the same user data or redirects handled by frontend
        return $this->profile();
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'data' => $user
        ]);
    }

    /**
     * Update admin password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.'
        ]);
    }

    public function index()
    {
        $totalOrders = Order::count();
        $activeAgents = User::where('role', 'agent')->count();
        $totalUsers = User::where('role', 'user')->count();
        $revenue = Order::where('status', 'completed')->sum('price');
        $pendingTransactions = \App\Models\Transaction::where('status', 'pending')->count();
        $verifiedTransactions = \App\Models\Transaction::where('status', 'verified')->count();
        $totalTransactions = \App\Models\Transaction::count();

        $recentOrders = Order::select('orders.*')
            ->leftJoin('transactions', function($join) {
                $join->on('orders.id', '=', 'transactions.order_id')
                     ->where('transactions.status', '=', 'verified');
            })
            ->with('user')
            ->orderBy('orders.updated_at', 'desc')
            ->take(5)
            ->get();

        $recentTransactions = \App\Models\Transaction::with(['user', 'order'])
            ->latest()
            ->take(5)
            ->get();

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
    }

    public function create()
    {
        // Not used in SPA, frontend handles form
        return response()->json(['success' => true]);
    }

    public function agent()
    {
        $agents = User::where('role', 'agent')
            ->withCount('tasks')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $agents
        ]);
    }

    public function storeAgent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        $agent = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'agent',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agent added successfully',
            'data' => $agent
        ], 201);
    }

    public function order()
    {
        $orders = Order::select('orders.*')
            ->leftJoin('transactions', function($join) {
                $join->on('orders.id', '=', 'transactions.order_id')
                     ->where('transactions.status', '=', 'verified');
            })
            ->with(['user', 'agent', 'transaction'])
            ->orderBy('orders.updated_at', 'desc') // Recently acted upon first
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $orders->items(),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'total' => $orders->total(),
            ]
        ]);
    }

    public function destroyOrder($id)
    {
        Order::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
    }

    public function user()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => $users->items(),
            'meta' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
            ]
        ]);
    }

    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|in:admin,agent,user',
            'password' => 'nullable|min:8',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->role = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    public function show($id)
    {
        $order = Order::with(['user', 'agent'])->findOrFail($id);
        $agents = User::where('role', 'agent')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'order' => $order,
                'agents' => $agents
            ]
        ]);
    }

    public function assignAgent(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'agent_id' => 'required|exists:users,id',
        ]);

        $order->agent_id = $request->agent_id;
        if ($order->status === 'pending') {
            $order->status = 'in-progress';
        }
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Agent assigned successfully.',
            'data' => $order->load(['user', 'agent'])
        ]);
    }
}
