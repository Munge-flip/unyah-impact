<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index'])->name('dashboard');

Route::get('/order', [AdminController::class, 'order'])->name('order');

Route::get('/agent', [AdminController::class, 'agent'])->name('agent');

Route::get('/user', [AdminController::class, 'user'])->name('user');

Route::get('/agent/create', [AdminController::class, 'create'])->name('agent.create');

Route::get('/user/{id}', [AdminController::class, 'edit'])->name('user.edit');

Route::get('/order/{id}', [AdminController::class, 'show'])->name('order.show');

Route::delete('/user/{id}', [AdminController::class, 'destroyUser'])->name('user.delete');