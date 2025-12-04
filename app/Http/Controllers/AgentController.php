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
        $agent = Auth::user();

        $ordersHandling = $agent->tasks()->where('status', '!=', 'completed')->count();

        $completedCount = $agent->tasks()->where('status', 'completed')->count();

        $totalAssigned = $agent->tasks()->count();

        $completionRate = $totalAssigned > 0
            ? round(($completedCount / $totalAssigned) * 100) . '%'
            : '0%';

        return view("agent.dashboard.index", compact(
            'agent',
            'ordersHandling',
            'completedCount',
            'completionRate'
        ));
    }
    public function order()
    {
        $orders = Auth::user()->tasks()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view("agent.orders.index", compact('orders'));
    }
    public function edit()
    {
        return view('agent.dashboard.edit-info');
    }
    public function update()
    {
        return view('agent.dashboard.edit-password');
    }
    public function show($id)
    {
        $order = Auth::user()->tasks()->with('user')->findOrFail($id);
        return view('agent.orders.show', compact('order'));
    }
    public function completeOrder($id)
    {
        $order = Auth::user()->tasks()->findOrFail($id);

        $order->status = 'completed';
        $order->save();

        return back()->with('success', 'Order marked as completed.');
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

        return back()->with('success', 'Profile updated successfully.');
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

        return back()->with('success', 'Password changed successfully.');
    }
}
