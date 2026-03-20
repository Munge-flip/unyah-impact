<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Api\OrderApiController;

Route::get('/', [AgentController::class, 'index'])->name('dashboard');
Route::get('/api/stats', [AgentController::class, 'apiStats'])->name('api.stats');
Route::get('/api/orders', [OrderApiController::class, 'index'])->name('api.orders');

//Agent Profile Management
Route::get('/edit', [AgentController::class, 'edit'])->name('dashboard.edit');
Route::get('/update', [AgentController::class, 'update'])->name('dashboard.update');
Route::patch('/profile/update', [AgentController::class, 'updateProfile'])->name('profile.update');
Route::put('/password/update', [AgentController::class, 'updatePassword'])->name('password.update');

//Agent Order Management
Route::get('/order', [AgentController::class, 'order'])->name('order');
Route::get('/order/{id}', [AgentController::class, 'show'])->name('order.show');
Route::patch('/order/{id}/complete', [AgentController::class, 'completeOrder'])->name('order.complete');
Route::get('/order/{id}/chat', [App\Http\Controllers\ChatController::class, 'show'])->name('order.chat');
Route::post('/order/{id}/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');