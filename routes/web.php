<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::resource('listing', App\Http\Controllers\ListingController::class);

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/show', [App\Http\Controllers\IndexController::class, 'show']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');
