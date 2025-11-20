<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('dashboard');
Route::get('/order', [UserController::class, 'order'])->name('order');
Route::get('/chat', [UserController::class, 'chat'])->name('chat');