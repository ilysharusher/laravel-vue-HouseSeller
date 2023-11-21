<?php

use App\Http\Controllers\Message\MessageController;
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

    Route::resource('message', MessageController::class);
});
