<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\ChatApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ServiceManagementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (v1 prefix)
Route::prefix('v1')->group(function () {
    Route::get('/services', [ServiceApiController::class, 'index']);
    Route::get('/services/{id}', [ServiceApiController::class, 'show']);
    Route::post('/register', [AuthApiController::class, 'register']);
    Route::post('/login', [AuthApiController::class, 'login']);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/me', [AuthApiController::class, 'me']);

    // v1 User Routes
    Route::prefix('v1')->group(function () {
        // Profile
        Route::get('/user/profile', [UserController::class, 'index']);
        Route::patch('/user/profile', [UserController::class, 'updateProfile']);
        Route::put('/user/password', [UserController::class, 'updatePassword']);

        // Orders
        Route::get('/user/orders', [UserController::class, 'orders']);
        Route::get('/user/orders/{id}', [UserController::class, 'show']);
        Route::post('/user/orders', [OrderController::class, 'store']);
        Route::patch('/user/orders/{id}/pay', [UserController::class, 'payNow']);

        // Transactions
        Route::get('/user/transactions', [TransactionController::class, 'userTransactions']);
        Route::get('/user/transactions/{id}', [TransactionController::class, 'show']);
        Route::post('/user/transactions', [TransactionController::class, 'store']);

        // Chat
        Route::get('/user/orders/{orderId}/messages', [ChatApiController::class, 'index']);
        Route::post('/user/orders/{orderId}/messages', [ChatApiController::class, 'store']);

        // Existing Resources (kept for backward compatibility if needed)
        Route::apiResource('orders', OrderApiController::class);
        Route::apiResource('users', UserApiController::class);
        Route::apiResource('transactions', TransactionApiController::class);
    });

    // v1 Admin Routes (role:admin)
    Route::middleware('role:admin')->prefix('v1/admin')->group(function() {
        // Dashboard
        Route::get('/stats', [DashboardApiController::class, 'index']);

        // Orders
        Route::get('/orders', [OrderApiController::class, 'index']);
        Route::patch('/orders/{id}', [OrderApiController::class, 'update']);
        Route::delete('/orders/{id}', [OrderApiController::class, 'destroy']);
        Route::get('/orders/{id}', [AdminController::class, 'show']);
        Route::patch('/orders/{id}/assign', [AdminController::class, 'assignAgent']);
        Route::delete('/orders/{id}', [AdminController::class, 'destroyOrder']);

        // Transactions
        Route::get('/transactions', [TransactionApiController::class, 'index']);
        Route::get('/transactions/{id}', [TransactionController::class, 'show']);
        Route::patch('/transactions/{id}/verify', [TransactionController::class, 'verify']);
        Route::get('/transactions/{id}/download-proof', [TransactionController::class, 'downloadProof']);

        // Users
        Route::get('/users', [AdminController::class, 'user']);
        Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
        Route::put('/users/{id}', [AdminController::class, 'update']);
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser']);

        // Agents
        Route::get('/agents', [AdminController::class, 'agent']);
        Route::post('/agents', [AdminController::class, 'storeAgent']);

        // Profile
        Route::get('/profile', [AdminController::class, 'profile']);
        Route::patch('/profile', [AdminController::class, 'updateProfile']);
        Route::put('/profile/password', [AdminController::class, 'updatePassword']);

        // Services
        Route::get('/services', [ServiceManagementController::class, 'index']);
        Route::post('/services', [ServiceManagementController::class, 'store']);
        Route::get('/services/{id}/edit', [ServiceManagementController::class, 'edit']);
        Route::put('/services/{id}', [ServiceManagementController::class, 'update']);
        Route::delete('/services/{id}', [ServiceManagementController::class, 'destroy']);
        Route::patch('/services/{id}/toggle', [ServiceManagementController::class, 'toggleStatus']);
    });

    // v1 Agent Routes (role:agent)
    Route::middleware('role:agent')->prefix('v1/agent')->group(function() {
        // Dashboard stats
        Route::get('/stats', [AgentController::class, 'apiStats']);

        // Orders
        Route::get('/orders', [OrderApiController::class, 'index']);
        Route::get('/orders/{id}', [AgentController::class, 'show']);
        Route::patch('/orders/{id}/complete', [AgentController::class, 'completeOrder']);

        // Profile
        Route::get('/profile', [AgentController::class, 'edit']);
        Route::patch('/profile', [AgentController::class, 'updateProfile']);
        Route::put('/password', [AgentController::class, 'updatePassword']);

        // Chat
        Route::get('/orders/{orderId}/messages', [ChatApiController::class, 'index']);
        Route::post('/orders/{orderId}/messages', [ChatApiController::class, 'store']);
    });
});
