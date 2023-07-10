<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/show', [App\Http\Controllers\IndexController::class, 'show']);