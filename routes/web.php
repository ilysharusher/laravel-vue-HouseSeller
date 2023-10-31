<?php

use App\Http\Controllers\Auth\{ForgotPasswordController,
    LoginController,
    LogoutController,
    RegisterController,
    VerifyEmailController};
use App\Http\Controllers\Listing\{ListingController, ListingImageController, ListingOfferController};
use App\Http\Controllers\Notification\{DeleteAllNotifications, MarkNotificationAsRead, NotificationController};
use App\Http\Controllers\Offer\AcceptOfferController;
use App\Http\Controllers\Realtor\RealtorListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('listing.index');
});

Route::resource('listing', ListingController::class)->only('index', 'show');

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('listing.offer', ListingOfferController::class);
    Route::resource('notification', NotificationController::class)->only('index');
    Route::delete('notification.destroy_all', DeleteAllNotifications::class)->name('notification.destroy_all');
    Route::patch('notification/{notification}/mark_as_read', MarkNotificationAsRead::class)->name(
        'mark.notification.as.read'
    );
    Route::prefix('realtor')->name('realtor.')->group(function () {
        Route::patch('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->name(
            'listing.restore'
        )->withTrashed();
        Route::delete(
            'listing/{listing}/destroy_permanently',
            [RealtorListingController::class, 'destroy_permanently']
        )->name('listing.destroy.permanently')->withTrashed();
        Route::delete('listing/{listing}/destroy_all', [ListingImageController::class, 'destroy_all'])->name(
            'listing.image.destroy.all'
        );
        Route::resource('listing', RealtorListingController::class);
        Route::resource('listing.image', ListingImageController::class);
        Route::patch('offer/{offer}/accept', AcceptOfferController::class)->name('offer.accept');
    });
});
