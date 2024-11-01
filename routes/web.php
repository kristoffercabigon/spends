<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index')->name('/');
    Route::get('/register', 'create');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::post('/store', 'store');
    Route::get('/verify-email', 'showVerificationFormRegister')->name('verify-email');
    Route::get('/verify-email-login', 'showVerificationFormLogin')->name('verify-email-login');
    Route::get('/forgot-password', 'showForgotPassword')->name('forgot-password');
    Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password');
    Route::post('/resend-code', 'resendVerificationCode')->name('resend-code');
    Route::post('/verify-email', 'verifyEmailCodeRegister');
    Route::post('/verify-email-login', 'verifyEmailCodeLogin');
    Route::put('/forgot-password', 'sendEmailForReset');
    Route::put('/reset-password', 'resetPassword');
    Route::post('/logout', 'logout');
});