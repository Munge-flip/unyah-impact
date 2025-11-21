<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;

Route::get('/', [AgentController::class, 'index'])->name('dashboard');

Route::get('/order', [AgentController::class, 'order'])->name('order');

Route::get('/order/{id}', [AgentController::class, 'show'])->name('order.show');

Route::get('/chat', [AgentController::class, 'chat'])->name('chat');