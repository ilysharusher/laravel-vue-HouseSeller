<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::resource('listing', ListingController::class);

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/show', [App\Http\Controllers\IndexController::class, 'show']);