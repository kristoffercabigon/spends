<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;
use App\Http\Controllers\EncoderController;
use App\Http\Controllers\AdminController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index')->name('/');
    Route::get('/register', 'create');
    Route::get('/verify-email', 'showVerificationFormRegister')->name('verify-email');
    Route::get('/verify-email-login', 'showVerificationFormLogin')->name('verify-email-login');
    Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password');
    Route::put('/forgot-password', 'sendEmailForReset')->name('forgot-password')->middleware('guest');
    Route::put('/reset-password', 'resetPassword');
    Route::post('/login', 'login')->name('login')->middleware('guest');
    Route::post('/store', 'store');
    Route::post('/resend-code', 'resendVerificationCode')->name('resend-code');
    Route::post('/verify-email', 'verifyEmailCodeRegister');
    Route::post('/verify-email-login', 'verifyEmailCodeLogin');

    Route::middleware('auth')->group(function () {
        Route::get('/profile/{senior}', 'showSeniorProfile');
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/change-password', 'changePassword')->name('change-password');
    });
});

Route::controller(EncoderController::class)->group(function () {
    Route::get('/encoder', 'showEncoderIndex')->name('encoder');
    Route::get('/encoder/verify-email-login', 'showEncoderVerificationFormLogin')->name('encoder-verify-email-login');
    Route::get('/encoder/reset-password', 'showEncoderResetPasswordForm')->name('encoder-reset-password');
    Route::put('/encoder/forgot-password', 'sendEncoderEmailForReset')->name('encoder-forgot-password');
    Route::put('/encoder/reset-password', 'resetEncoderPassword');
    Route::post('/encoder/login', 'encoder_login')->name('encoder_login')->middleware('guest');
    Route::post('/encoder/verify-email', 'verifyEncoderEmailCodeRegister');
    Route::post('/encoder/verify-email-login', 'verifyEncoderEmailCodeLogin');
    Route::post('/encoder/resend-code', 'resendEncoderVerificationCode')->name('encoder-resend-code');

    Route::middleware('auth')->group(function () {
        Route::post('/encoder/logout', 'encoder_logout');
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'showAdminIndex')->name('admin');
    Route::get('/admin/verify-email-login', 'showAdminVerificationFormLogin')->name('admin-verify-email-login');
    Route::get('/admin/reset-password', 'showAdminResetPasswordForm')->name('admin-reset-password');
    Route::put('/admin/forgot-password', 'sendAdminEmailForReset')->name('admin-forgot-password');
    Route::put('/admin/reset-password', 'resetAdminPassword');
    Route::post('/admin/login', 'admin_login')->name('admin_login')->middleware('guest');
    Route::post('/admin/verify-email', 'verifyAdminEmailCodeRegister');
    Route::post('/admin/verify-email-login', 'verifyAdminEmailCodeLogin');
    Route::post('/admin/resend-code', 'resendAdminVerificationCode')->name('admin-resend-code');

    Route::middleware('auth')->group(function () {
        Route::post('/admin/logout', 'admin_logout');
    });
});