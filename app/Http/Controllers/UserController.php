<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function update()
    {
        return view('user.dashboard.edit-password');
    }
}
