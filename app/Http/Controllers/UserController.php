<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        return view("user.dashboard.index");
    }
    public function orders()
    {
        $user = Auth::user();

        $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(5);

        return view("user.orders.index", compact('orders'));
    }
    public function show($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }
    public function edit()
    {
        return view('user.dashboard.edit-info');
    }
    public function editPassword()
    {
        return view('user.dashboard.edit-password');
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

    // 2. Handle Password Update
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
    public function payNow($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);

        $order->payment_status = 'paid';
        $order->save();

        return back()->with('success', 'Payment successful!');
    }
}
