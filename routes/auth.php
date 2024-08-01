<?php

use App\Http\Controllers\Auth\{ForgotPasswordController,
    LoginController,
    LogoutController,
    RegisterController,
    VerifyEmailController
};
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'login_store'])->name('login.store');

        Route::name('password.')->group(function () {
            Route::get('forgot-password', [ForgotPasswordController::class, 'password_request'])->name('request');
            Route::post('forgot-password', [ForgotPasswordController::class, 'password_email'])->name('email');
            Route::get('reset-password/{token}', [ForgotPasswordController::class, 'password_reset'])->name('reset');
            Route::post('/reset-password', [ForgotPasswordController::class, 'password_update'])->name('update');
        });

        Route::get('register', [RegisterController::class, 'register'])->name('register');
        Route::post('register', [RegisterController::class, 'register_store'])->name('register.store');
    });
    Route::middleware('auth')->group(function () {
        Route::post('logout', LogoutController::class)->name('logout');
    });
});

Route::middleware(['auth', 'protect.email.verification'])->group(function () {
    Route::get('/email/verify', [VerifyEmailController::class, 'verification_notice'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verification_process'])
        ->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', [VerifyEmailController::class, 'send_verification_email'])
        ->middleware('throttle:6,1')->name('verification.send');
});
