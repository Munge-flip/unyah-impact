<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view("user.dashboard");
    }
    public function order()
    {
        return view("user.orders.index");
    }
    public function chat()
    {
        return view("user.chat");
    }
    public function show($id)
    {
        return view('user.orders.show', ['id'=>$id]);
    }
}
