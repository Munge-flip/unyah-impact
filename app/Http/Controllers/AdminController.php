<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();

        $activeAgents = User::where('role', 'agent')->count();

        $totalUsers = User::where('role', 'user')->count();

        $revenue = Order::where('status', 'completed')->sum('price');

        $recentOrders = Order::with('user') // Eager load user to show name
            ->latest()
            ->take(5)
            ->get();

        return view("admin.dashboard", compact(
            'totalOrders',
            'activeAgents',
            'totalUsers',
            'revenue',
            'recentOrders'
        ));
    }
    public function create()
    {
        return view('admin.agents.create');
    }
    public function agent()
    {
        $agents = User::where('role', 'agent')
            // ->withCount('tasks')
            ->orderBy('created_at', 'desc')
            ->get();

        return view("admin.agents.index", compact('agents'));
    }
    public function storeAgent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'agent',
        ]);

        return redirect()->route('admin.agent')->with('success', 'Agent added successfully');
    }
    public function order()
    {
        $orders = Order::with(['user', 'agent'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view("admin.orders.index", compact('orders'));
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
