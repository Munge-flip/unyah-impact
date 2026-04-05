<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ChatApiController;

Route::get('/', [UserController::class, 'index'])->name('dashboard');
Route::get('/api/orders', [OrderApiController::class, 'index'])->name('api.orders');

//User Profile Management
Route::get('/edit', [UserController::class, 'edit'])->name('dashboard.edit');
Route::get('/update', [UserController::class, 'editPassword'])->name('dashboard.update');
Route::patch('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::put('/password/update', [UserController::class, 'updatePassword'])->name('password.update');

//User Order Management
Route::get('/order', [UserController::class, 'orders'])->name('order');
Route::get('/order/{id}', [UserController::class, 'show'])->name('order.show');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{id}/chat', [ChatController::class, 'show'])->name('order.chat');
Route::post('/order/{id}/chat', [ChatController::class, 'store'])->name('chat.store');

// API for Live Chat
Route::get('/api/orders/{orderId}/messages', [ChatApiController::class, 'index']);
Route::post('/api/orders/{orderId}/messages', [ChatApiController::class, 'store']);

//User Transaction Management
Route::patch('/order/{id}/pay', [App\Http\Controllers\UserController::class, 'payNow'])->name('order.pay');
Route::get('/transactions', [TransactionController::class, 'userTransactions'])->name('transactions');
Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');