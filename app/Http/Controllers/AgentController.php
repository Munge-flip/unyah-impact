<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index() {
        return view ("agent.dashboard");
    }
        public function order() {
        return view ("agent.orders.index");
    }
        public function chat() {
        return view ("agent.chat");
    }
    public function show($id) {
        return view ('agent.orders.show', ['id' => $id]);
    }
}
