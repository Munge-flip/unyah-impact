<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/', [PageController::class, 'index'])->name('public.index');

Route::prefix('services')->name('services')->group(base_path(('routes/services.php')));

Route::middleware('guest')->group(base_path('routes/auth.php'));

Route::middleware('auth')->group(function() {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('user')->name('user.')->group(base_path('routes/user.php'));

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(base_path('routes/user.php'));

    Route::prefix('agent')->name('agent.')->middleware('role:agent')->group(base_path('routes/user.php'));
    
});

Route::prefix('user')->name('user.')->group(base_path('routes/user.php'));

Route::prefix('agent')->name('agent.')->group(base_path('routes/agent.php'));

Route::prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));