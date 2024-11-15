<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;
use App\Http\Controllers\EncoderController;
use App\Http\Controllers\AdminController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index')->name('/');
    Route::get('/announcement', 'announcement');
    Route::get('/about-us', 'about_us');
    Route::get('/contact-us', 'contact_us');
    Route::get('/register', 'create');
    Route::get('/verify-email', 'showVerificationFormRegister')->name('verify-email');
    Route::get('/verify-email-login', 'showVerificationFormLogin')->name('verify-email-login');
    Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password');
    Route::put('/forgot-password', 'sendEmailForReset')->name('forgot-password');
    Route::put('/reset-password', 'resetPassword');
    Route::post('/login', 'login')->name('login')->middleware('guest:senior');
    Route::post('/store', 'store');
    Route::post('/contact-us', 'send_message');
    Route::post('/resend-code', 'resendVerificationCode')->name('resend-code');
    Route::post('/verify-email', 'verifyEmailCodeRegister');
    Route::post('/verify-email-login', 'verifyEmailCodeLogin');

    Route::middleware('auth:senior')->group(function () {
        Route::get('/profile/{senior}', 'showSeniorProfile');
        Route::post('/logout', 'logout')->name('logout');
        Route::put('/change-password', 'changePassword')->name('change-password');
        Route::post('/verify-change-password-email', 'verifyChangePasswordCode')->name('verify-change-password-email');
    });
});

Route::controller(EncoderController::class)->group(function () {
    Route::get('/encoder', 'showEncoderIndex')->name('encoder');
    Route::get('/encoder/about-us', 'about_us');
    Route::get('/encoder/verify-email-login', 'showEncoderVerificationFormLogin')->name('encoder-verify-email-login');
    Route::get('/encoder/reset-password', 'showEncoderResetPasswordForm')->name('encoder-reset-password');
    Route::put('/encoder/forgot-password', 'sendEncoderEmailForReset')->name('encoder-forgot-password');
    Route::put('/encoder/reset-password', 'resetEncoderPassword');
    Route::post('/encoder/login', 'encoder_login')->name('encoder_login')->middleware('guest:encoder');
    Route::post('/encoder/send-message', 'send_message');
    Route::post('/encoder/verify-email', 'verifyEncoderEmailCodeRegister');
    Route::post('/encoder/verify-email-login', 'verifyEncoderEmailCodeLogin');
    Route::post('/encoder/resend-code', 'resendEncoderVerificationCode')->name('encoder-resend-code');

    Route::middleware('auth:encoder')->group(function () {
        Route::get('/encoder/profile/{encoder}', 'showEncoderProfile');
        Route::get('/encoder/dashboard', 'showEncoderDashboard');
        Route::post('/encoder/logout', 'encoder_logout');
        Route::put('/encoder/change-password', 'changeEncoderPassword')->name('encoder-change-password');
        Route::put('/encoder/edit-profile', 'editEncoderProfile')->name('encoder-edit-profile');
        Route::put('/encoder/edit-profile-picture', 'editEncoderProfilePicture')->name('encoder-edit-profile-picture');
        Route::post('/encoder/verify-change-password-email', 'verifyEncoderChangePasswordCode')->name('encoder-verify-change-password-email');
        Route::post('/encoder/verify-password', 'verifyEncoderPasswordForEditProfile')->name('encoder-verify-password');
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'showAdminIndex')->name('admin');
    Route::get('/admin/about-us', 'about_us');
    Route::get('/admin/verify-email-login', 'showAdminVerificationFormLogin')->name('admin-verify-email-login');
    Route::get('/admin/reset-password', 'showAdminResetPasswordForm')->name('admin-reset-password');
    Route::put('/admin/forgot-password', 'sendAdminEmailForReset')->name('admin-forgot-password');
    Route::put('/admin/reset-password', 'resetAdminPassword');
    Route::post('/admin/login', 'admin_login')->name('admin_login')->middleware('guest:admin');
    Route::post('/admin/verify-email', 'verifyAdminEmailCodeRegister');
    Route::post('/admin/verify-email-login', 'verifyAdminEmailCodeLogin');
    Route::post('/admin/resend-code', 'resendAdminVerificationCode')->name('admin-resend-code');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin/profile/{admin}', 'showAdminProfile');
        Route::get('/admin/dashboard', 'showAdminDashboard');
        Route::post('/admin/logout', 'admin_logout');
        Route::put('/admin/change-password', 'changeAdminPassword')->name('admin-change-password');
        Route::put('/admin/edit-profile', 'editAdminProfile')->name('admin-edit-profile');
        Route::put('/admin/edit-profile-picture', 'editAdminProfilePicture')->name('admin-edit-profile-picture');
        Route::post('/admin/verify-change-password-email', 'verifyAdminChangePasswordCode')->name('admin-verify-change-password-email');
        Route::post('/admin/verify-password', 'verifyAdminPasswordForEditProfile')->name('admin-verify-password');
    });
});