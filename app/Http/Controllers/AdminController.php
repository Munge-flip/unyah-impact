<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }
    public function create() {
        return view ('admin.agents.create');
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
        return view("admin.users.index");
    }
    public function edit($id) {
        return view ('admin.users.edit');
    }
    public function show($id)
    {
        return view('admin.orders.show', ['id' => $id]);
    }
}
