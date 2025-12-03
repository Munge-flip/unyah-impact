<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }
    public function create()
    {
        return view('admin.agents.create');
    }
    public function agent()
    {
        return view("admin.agents.index");
    }
    public function order()
    {
        return view("admin.orders.index");
    }
    public function user()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view("admin.users.index", compact('users'));
    }
    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
        return redirect()->route('admin.user')->with('success', 'User updated successfully');
    }
    public function show($id)
    {
        return view('admin.orders.show', ['id' => $id]);
    }
}
