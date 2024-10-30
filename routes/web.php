<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/register', 'create');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::post('/store', 'store');
    Route::get('/verify-email', 'showVerificationFormRegister')->name('verify-email');
    Route::get('/verify-email-login', 'showVerificationFormLogin')->name('verify-email-login');
    Route::post('/resend-code', 'resendVerificationCode')->name('resend-code');
    Route::post('/verify-email', 'verifyEmailCodeRegister');
    Route::post('/verify-email-login', 'verifyEmailCodeLogin');
    Route::post('/logout', 'logout');
});

// Route::get('/test-alert', function () {
//     session()->flash('message', 'This is a test alert message!');
//     return view('components.messages');
// });
