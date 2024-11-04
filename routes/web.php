<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;
use App\Http\Controllers\EncoderController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index')->name('/');
    Route::get('/register', 'create');
    Route::get('/verify-email', 'showVerificationFormRegister')->name('verify-email');
    Route::get('/verify-email-login', 'showVerificationFormLogin')->name('verify-email-login');
    Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password');
    Route::put('/forgot-password', 'sendEmailForReset')->name('forgot-password');
    Route::put('/reset-password', 'resetPassword');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::post('/store', 'store');
    Route::post('/resend-code', 'resendVerificationCode')->name('resend-code');
    Route::post('/verify-email', 'verifyEmailCodeRegister');
    Route::post('/verify-email-login', 'verifyEmailCodeLogin');
    Route::post('/logout', 'logout');
});

Route::controller(EncoderController::class)->group(function () {
    Route::get('/encoder', 'encoder_index')->name('encoder');
    Route::put('/encoder/forgot-password', 'sendEncoderEmailForReset')->name('encoder-forgot-password');
    Route::post('/encoder_store', 'encoder_store');
});