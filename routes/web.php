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