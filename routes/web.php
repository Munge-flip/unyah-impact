<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.dashboard');
});

Route::get('/user/order', function () {
    return view('user.order');
});