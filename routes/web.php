<?php

use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return view('user.dashboard');
});

Route::get('/user/order', function () {
    return view('user.order');
});

Route::get('/user/chat', function () {
    return view('user.chat');
});

Route::get("/admin", function() {
    return view ('admin.dashboard');
});

Route::get("/admin/order", function() {
    return view ('admin.order');
});

Route::get("/admin/agent", function() {
    return view ('admin.agent');
});

Route::get("/admin/user", function() {
    return view ('admin.user');
});