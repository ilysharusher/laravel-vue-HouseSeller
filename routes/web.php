<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Listing\ListingController;
use App\Http\Controllers\Listing\ListingImageController;
use App\Http\Controllers\Listing\ListingOfferController;
use App\Http\Controllers\Realtor\RealtorListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('listing.index');
});

Route::resource('listing', ListingController::class)->only('index', 'show');

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', LoginController::class)->name('login.store');
        Route::get('register', [AuthController::class, 'register'])->name('register');
        Route::post('register', RegisterController::class)->name('register.store');
    });
    Route::middleware('auth')->group(function () {
        Route::post('logout', LogoutController::class)->name('logout');
    });
});

Route::middleware('auth')->group(function () {
    Route::resource('listing.offer', ListingOfferController::class);
    Route::prefix('realtor')->name('realtor.')->group(function () {
        Route::patch('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->name('listing.restore')->withTrashed();
        Route::delete('listing/{listing}/destroy_all', [ListingImageController::class, 'destroy_all'])->name('listing.image.destroy.all');
        Route::resource('listing', RealtorListingController::class);
        Route::resource('listing.image', ListingImageController::class);
    });
});
