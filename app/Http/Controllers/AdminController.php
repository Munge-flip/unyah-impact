<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view ("admin.dashboard");
    }
        public function order() {
        return view ("admin.order");
    }
        public function agent() {
        return view ("admin.agent");
    }
        public function user() {
        return view ("admin.user");
    }
}
