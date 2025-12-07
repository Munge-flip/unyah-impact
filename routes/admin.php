<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ServiceManagementController;

Route::get('/', [AdminController::class, 'index'])->name('dashboard');

Route::get('/order', [AdminController::class, 'order'])->name('order');

Route::get('/agent', [AdminController::class, 'agent'])->name('agent');

Route::get('/agent/create', [AdminController::class, 'create'])->name('agent.create');

Route::post('/agent', [AdminController::class, 'storeAgent'])->name('agent.store');

Route::get('/user', [AdminController::class, 'user'])->name('user');

Route::get('/agent/create', [AdminController::class, 'create'])->name('agent.create');

Route::get('/user/{id}/edit', [AdminController::class, 'edit'])->name('user.edit');

Route::put('/user/{id}', [AdminController::class, 'update'])->name('user.update');

Route::get('/order/{id}', [AdminController::class, 'show'])->name('order.show');

Route::delete('/user/{id}', [AdminController::class, 'destroyUser'])->name('user.delete');

Route::delete('/order/{id}', [AdminController::class, 'destroyOrder'])->name('order.delete');

Route::patch('/order/{id}/assign', [AdminController::class, 'assignAgent'])->name('order.assign');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');

Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

Route::patch('/transactions/{id}/verify', [TransactionController::class, 'verify'])->name('transactions.verify');

Route::get('/transactions/{id}/download-proof', [TransactionController::class, 'downloadProof'])->name('transactions.download-proof');

// Admin Profile Routes
Route::get('/profile', [AdminController::class, 'profile'])->name('profile.index');
Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
Route::patch('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/password', [AdminController::class, 'editPassword'])->name('profile.password');
Route::put('/profile/password/update', [AdminController::class, 'updatePassword'])->name('profile.password.update');

// Service Management Routes
Route::get('/services', [ServiceManagementController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceManagementController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceManagementController::class, 'store'])->name('services.store');
Route::get('/services/{id}/edit', [ServiceManagementController::class, 'edit'])->name('services.edit');
Route::put('/services/{id}', [ServiceManagementController::class, 'update'])->name('services.update');
Route::delete('/services/{id}', [ServiceManagementController::class, 'destroy'])->name('services.destroy');
Route::patch('/services/{id}/toggle', [ServiceManagementController::class, 'toggleStatus'])->name('services.toggle');