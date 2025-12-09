<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\Api\AuthApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes (no authentication required)
Route::prefix('v1')->group(function () {
    // Get all services (public access)
    Route::get('/services', [ServiceApiController::class, 'index']);
    Route::get('/services/{id}', [ServiceApiController::class, 'show']);
    Route::post('/register', [AuthApiController::class, 'register']);
    Route::post('/login', [AuthApiController::class, 'login']);
});

// Protected routes (requires authentication with Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/register', [AuthApiController::class, 'register']);
    Route::post('/login', [AuthApiController::class, 'login']);

    // Get authenticated user info
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    });

    // Services CRUD (admin only in real app, but open for API testing)
    Route::prefix('v1')->group(function () {
        Route::post('/services', [ServiceApiController::class, 'store']);
        Route::put('/services/{id}', [ServiceApiController::class, 'update']);
        Route::patch('/services/{id}', [ServiceApiController::class, 'update']);
        Route::delete('/services/{id}', [ServiceApiController::class, 'destroy']);

        // Orders API Resource
        Route::apiResource('orders', OrderApiController::class);

        // Users API Resource
        Route::apiResource('users', UserApiController::class);

        // Transactions API Resource
        Route::apiResource('transactions', TransactionApiController::class);
    });
});
