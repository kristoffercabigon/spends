<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/register', 'create');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::post('/store', 'store');
    Route::post('/logout', 'logout');
});

Route::get('/verify-email', [SeniorsController::class, 'verifyEmail']);