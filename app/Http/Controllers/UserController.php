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
        return view("app");
    }
    public function orders()
    {
        return view("app");
    }
    public function show($id)
    {
        $order = Auth::user()->orders()->with(['user', 'agent', 'transaction'])->findOrFail($id);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $order
            ]);
        }

        return view('app');
    }
    public function edit()
    {
        return view('app');
    }
    public function editPassword()
    {
        return view('app');
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

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'user' => $user
            ]);
        }

        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully.');
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

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully.'
            ]);
        }

        return redirect()->route('user.dashboard')->with('success', 'Password changed successfully.');
    }
    public function payNow($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);

        $order->payment_status = 'paid';
        $order->save();

        return back()->with('success', 'Payment successful!');
    }
}
