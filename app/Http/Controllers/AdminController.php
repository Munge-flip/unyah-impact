<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        return view('admin.users.edit', ['id' => $id]);
    }
    public function show($id)
    {
        return view('admin.orders.show', ['id' => $id]);
    }
}
