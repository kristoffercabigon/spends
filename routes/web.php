<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/register', 'create');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::post('/store', 'store');
    Route::get('/verify-email', 'showVerificationForm')->name('verify-email');
    Route::post('/resend-code', 'resendVerificationCode')->name('resend-code');
    Route::post('/verify-email', 'verifyEmailCode');
    Route::post('/logout', 'logout');
});

// Route::get('/test-alert', function () {
//     session()->flash('message', 'This is a test alert message!');
//     return view('components.messages');
// });
