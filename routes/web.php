<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeniorsController;
use App\Http\Controllers\EncoderController;
use App\Http\Controllers\AdminController;

Route::controller(SeniorsController::class)->group(function () {
    Route::get('/', 'index')->name('/');
    Route::get('/announcements', 'announcements');
    Route::post('/filter-announcements', 'filterAnnouncements');
    Route::get('/about-us', 'about_us');
    Route::get('/contact-us', 'contact_us');
    Route::post('/request-tracker', 'track_request')->name('track-request');
    Route::get('/register', 'create');
    Route::get('/verify-email', 'showVerificationFormRegister')->name('verify-email');
    Route::get('/verify-email-login', 'showVerificationFormLogin')->name('verify-email-login');
    Route::get('/reset-password', 'showResetPasswordForm')->name('reset-password');
    Route::get('/login', function () {return redirect('/');});
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
        Route::put('/profile/change-password', 'changePassword')->name('change-password');
        Route::post('/profile/verify-change-password-email', 'verifyChangePasswordCode')->name('verify-change-password-email');
    });
});

Route::controller(EncoderController::class)->group(function () {
    Route::get('/encoder', 'showEncoderIndex')->name('encoder');
    Route::get('/encoder/about-us', 'about_us');
    Route::get('/encoder/verify-email-login', 'showEncoderVerificationFormLogin')->name('encoder-verify-email-login');
    Route::get('/encoder/reset-password', 'showEncoderResetPasswordForm')->name('encoder-reset-password');
    Route::get('/encoder/login', function () {return redirect('/encoder');});
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
        Route::post('/encoder/dashboard/filter-dashboard-beneficiaries', 'filterSeniorsDashboardBeneficiaries');

        Route::get('/encoder/application-requests', 'showEncoderApplicationRequests');
        Route::post('/encoder/application-requests/filter-application-requests', 'filterSeniorsApplicationRequests');
        Route::get('/encoder/application-requests/view-senior-profile/{senior}', 'showEncoderSeniorProfile');

        Route::put('/encoder/view-senior-profile/{id}/update-application-status', 'updateEncoderSeniorApplicationStatus')->name('encoder-update-application-status');
        Route::put('/encoder/view-senior-profile/{id}/update-account-status', 'updateEncoderSeniorAccountStatus')->name('encoder-update-account-status');

        Route::get('/encoder/beneficiaries', 'showEncoderBeneficiariesList');
        Route::post('/encoder/beneficiaries/filter-beneficiaries', 'filterSeniorsBeneficiaries');
        Route::get('/encoder/beneficiaries/view-senior-profile/{senior}', 'showEncoderSeniorProfile');
        Route::get('/encoder/beneficiaries/add-beneficiary', 'showEncoderAddBeneficiary');
        Route::post('/encoder/beneficiaries/add-beneficiary/submit-beneficiary', 'submitEncoderAddBeneficiary')->name('encoder-submit-add-beneficiary');
        Route::get('/encoder/beneficiaries/edit-senior-profile/{senior}', 'showEncoderEditSeniorProfile');
        Route::put('/encoder/beneficiaries/edit-senior-profile/{senior}', 'updateEncoderEditBeneficiary')->name('encoder-submit-edit-beneficiary');

        Route::get('/encoder/pension-distribution-list', 'showEncoderPensionDistributionList');
        Route::post('/encoder/pension-distribution-list/filter-pension-distribution-list', 'filterPensionDistributionList');
        Route::post('/encoder/pension-distribution-list/submit-add-pension', 'submitEncoderAddPensionDistribution')->name('encoder-submit-add-pension-distribution');
        Route::get('/encoder/pension-distribution-list/getPensionDistributionDataForEdit/{id}', 'getPensionDataForEdit');
        Route::put('/encoder/pension-distribution-list/submit-edit-pension', 'submitEncoderEditPensionDistribution')->name('encoder-submit-edit-pension-distribution');
        Route::get('/encoder/pension-distribution-list/getPensionDistributionDataForDelete/{id}', 'getPensionDataForDelete');
        Route::post('/encoder/pension-distribution-list/submit-delete-pension', 'submitEncoderDeletePensionDistribution')->name('encoder-submit-delete-pension-distribution');
        Route::post('/encoder/logout', 'encoder_logout');
        Route::put('/encoder/profile/change-password', 'changeEncoderPassword')->name('encoder-change-password');
        Route::put('/encoder/profile/edit-profile', 'editEncoderProfile')->name('encoder-edit-profile');
        Route::put('/encoder/profile/edit-profile-picture', 'editEncoderProfilePicture')->name('encoder-edit-profile-picture');

        Route::post('/encoder/profile/verify-change-password-email', 'verifyEncoderChangePasswordCode')->name('encoder-verify-change-password-email');
        Route::post('/encoder/profile/verify-password', 'verifyEncoderPasswordForEditProfile')->name('encoder-verify-password');
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'showAdminIndex')->name('admin');
    Route::get('/admin/about-us', 'about_us');
    Route::get('/admin/verify-email-login', 'showAdminVerificationFormLogin')->name('admin-verify-email-login');
    Route::get('/admin/reset-password', 'showAdminResetPasswordForm')->name('admin-reset-password');
    Route::get('/admin/login', function () {return redirect('/admin');});
    Route::put('/admin/forgot-password', 'sendAdminEmailForReset')->name('admin-forgot-password');
    Route::put('/admin/reset-password', 'resetAdminPassword');
    Route::post('/admin/login', 'admin_login')->name('admin_login')->middleware('guest:admin');
    Route::post('/admin/verify-email', 'verifyAdminEmailCodeRegister');
    Route::post('/admin/verify-email-login', 'verifyAdminEmailCodeLogin');
    Route::post('/admin/resend-code', 'resendAdminVerificationCode')->name('admin-resend-code');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin/profile/{admin}', 'showAdminProfile');
        Route::get('/admin/dashboard', 'showAdminDashboard');
        Route::post('/admin/dashboard/filter-dashboard-beneficiaries', 'filterSeniorsDashboardBeneficiaries');

        Route::get('/admin/application-requests', 'showAdminApplicationRequests');
        Route::post('/admin/application-requests/filter-application-requests', 'filterSeniorsApplicationRequests');
        Route::get('/admin/application-requests/view-senior-profile/{senior}', 'showAdminSeniorProfile');

        Route::put('/admin/view-senior-profile/{id}/update-application-status', 'updateAdminSeniorApplicationStatus')->name('admin-update-application-status');
        Route::put('/admin/view-senior-profile/{id}/update-account-status', 'updateAdminSeniorAccountStatus')->name('admin-update-account-status');
        
        Route::get('/admin/encoders', 'showAdminEncodersList');
        Route::post('/admin/encoders/filter-encoders', 'filterEncoders');
        Route::get('/admin/encoders/view-encoder-profile/{encoder}', 'showAdminEncoderProfile');
        Route::post('/admin/encoders/submit-encoder', 'submitAdminAddEncoder')->name('admin-submit-add-encoder');
        Route::put('/admin/encoders/view-encoder-profile/{id}/update-encoder-role', 'updateAdminEncoderRoles')->name('admin-update-encoder-role');
        Route::put('/admin/encoders/view-encoder-profile/{id}/update-encoder-profile', 'updateAdminEncoderProfile')->name('admin-submit-edit-encoder');

        Route::get('/admin/beneficiaries', 'showAdminBeneficiariesList');
        Route::post('/admin/beneficiaries/filter-beneficiaries', 'filterSeniorsBeneficiaries');
        Route::get('/admin/beneficiaries/view-senior-profile/{senior}', 'showAdminSeniorProfile');
        Route::get('/admin/beneficiaries/add-beneficiary', 'showAdminAddBeneficiary');
        
        Route::post('/admin/beneficiaries/submit-beneficiary', 'submitAdminAddBeneficiary')->name('admin-submit-add-beneficiary');
        Route::get('/admin/beneficiaries/edit-senior-profile/{senior}', 'showAdminEditSeniorProfile');
        Route::put('/admin/beneficiaries/edit-senior-profile/{senior}', 'updateAdminEditBeneficiary')->name('admin-submit-edit-beneficiary');

        Route::get('/admin/pension-distribution-list', 'showAdminPensionDistributionList');
        Route::post('/admin/pension-distribution-list/filter-pension-distribution-list', 'filterPensionDistributionList');
        Route::post('/admin/pension-distribution-list/submit-add-pension', 'submitAdminAddPensionDistribution')->name('admin-submit-add-pension-distribution');
        Route::get('/admin/pension-distribution-list/getPensionDistributionDataForEdit/{id}', 'getPensionDataForEdit');
        Route::put('/admin/pension-distribution-list/submit-edit-pension', 'submitAdminEditPensionDistribution')->name('admin-submit-edit-pension-distribution');
        Route::get('/admin/pension-distribution-list/getPensionDistributionDataForDelete/{id}', 'getPensionDataForDelete');
        Route::post('/admin/pension-distribution-list/submit-delete-pension', 'submitAdminDeletePensionDistribution')->name('admin-submit-delete-pension-distribution');

        Route::post('/admin/logout', 'admin_logout');
        Route::put('/admin/profile/change-password', 'changeAdminPassword')->name('admin-change-password');
        Route::put('/admin/profile/edit-profile', 'editAdminProfile')->name('admin-edit-profile');
        Route::put('/admin/profile/edit-profile-picture', 'editAdminProfilePicture')->name('admin-edit-profile-picture');
        
        Route::post('/admin/profile/verify-change-password-email', 'verifyAdminChangePasswordCode')->name('admin-verify-change-password-email');
        Route::post('/admin/profile/verify-password', 'verifyAdminPasswordForEditProfile')->name('admin-verify-password');
    });
});