<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index'])->name('dashboard');
Route::get('/order', [AdminController::class, 'order'])->name('order');
Route::get('/agent', [AdminController::class, 'agent'])->name('agent');
Route::get('/user', [AdminController::class, 'user'])->name('user');
Route::get('/order/{id}', [AdminController::class, 'show'])->name('order.show');