<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AgentController extends Controller
{
    public function index()
    {
        return $this->apiStats();
    }

    public function apiStats()
    {
        $agent = Auth::user();
        $ordersHandling = $agent->tasks()->where('status', '!=', 'completed')->count();
        $completedCount = $agent->tasks()->where('status', 'completed')->count();
        $totalAssigned = $agent->tasks()->count();
        $completionRate = $totalAssigned > 0
            ? round(($completedCount / $totalAssigned) * 100) . '%'
            : '0%';

        return response()->json([
            'success' => true,
            'agent' => $agent,
            'stats' => [
                'handling' => $ordersHandling,
                'completed' => $completedCount,
                'rate' => $completionRate
            ]
        ]);
    }

    public function order()
    {
        $orders = Auth::user()->tasks()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

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

    public function edit()
    {
        return response()->json([
            'success' => true,
            'data' => Auth::user()
        ]);
    }

    public function update()
    {
        return $this->edit();
    }

    public function show($id)
    {
        $order = Auth::user()->tasks()->with('user')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    public function completeOrder($id)
    {
        $order = Auth::user()->tasks()->findOrFail($id);

        $order->status = 'completed';
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order marked as completed.',
            'data' => $order
        ]);
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
}
