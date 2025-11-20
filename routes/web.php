<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;

Route::prefix('user')->name('User.')->group(base_path('routes/user.php'));
Route::prefix('agent')->name('Agent.')->group(base_path('routes/agent.php'));
Route::prefix('admin')->name('Admin.')->group(base_path('routes/admin.php'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::get('/index', function() {
    return view ('public.index');
})->name('index');

Route::get('/genshin', function() {
    return view ('services.genshin');
})->name('services.genshin');

Route::get('/hsr', function() {
    return view ('services.hsr');
})->name('services.hsr');

Route::get('/zzz', function() {
    return view ('services.zzz');
})->name('services.zzz');