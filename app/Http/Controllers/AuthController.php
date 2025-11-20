<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login()
    {
        //later
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register()
    {
        //later
    }
    public function logout()
    {
        //later
    }
}
