<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::prefix('user')->name('User.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');
    Route::get('/order', [UserController::class, 'order'])->name('order');
    Route::get('/chat', [UserController::class, 'chat'])->name('chat');
});

Route::prefix('agent')->name('Agent.')->group(function() {
    Route::get('/', [AgentController::class, 'index'])->name('dashboard');
    Route::get('/order', [AgentController::class, 'order'])->name('order');
    Route::get('/chat', [AgentController::class, 'chat'])->name('chat');
});

Route::prefix('admin')->name('Admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/order', [AdminController::class, 'order'])->name('order');
    Route::get('/agent', [AdminController::class, 'agent'])->name('agent');
    Route::get('/user', [AdminController::class, 'user'])->name('user');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});