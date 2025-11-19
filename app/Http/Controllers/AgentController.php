<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index() {
        return view ("agent.dashboard");
    }
        public function order() {
        return view ("agent.order");
    }
        public function chat() {
        return view ("agent.chat");
    }
}
