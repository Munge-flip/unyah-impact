<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;

Route::get('/', [UserController::class, 'index'])->name('dashboard');

Route::get('/edit', [UserController::class, 'edit'])->name('dashboard.edit');

Route::get('/update', [UserController::class, 'editPassword'])->name('dashboard.update');

Route::get('/order', [UserController::class, 'orders'])->name('order');

Route::get('/order/{id}', [UserController::class, 'show'])->name('order.show');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/{id}/chat', [ChatController::class, 'show'])->name('order.chat');

Route::post('/order/{id}/chat', [ChatController::class, 'store'])->name('chat.store');

Route::patch('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

Route::put('/password/update', [UserController::class, 'updatePassword'])->name('password.update');
