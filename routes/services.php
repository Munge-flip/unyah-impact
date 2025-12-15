<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::get('/genshin', [ServiceController::class, 'genshin'])->name('genshin');
Route::get('/hsr', [ServiceController::class, 'hsr'])->name('hsr');
Route::get('/zzz', [ServiceController::class, 'zzz'])->name('zzz');