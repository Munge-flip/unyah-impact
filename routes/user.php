<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('/', [UserController::class, 'index'])->name('dashboard');

Route::get('/edit', [UserController::class, 'edit'])->name('dashboard.edit');

Route::get('/update', [UserController::class, 'update'])->name('dashboard.update');

Route::get('/order', [UserController::class, 'orders'])->name('order');

Route::get('/order/{id}', [UserController::class, 'show'])->name('order.show');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/{id}/chat', [App\Http\Controllers\ChatController::class, 'show'])->name('order.chat');

Route::post('/order/{id}/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');