<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'index'])
    ->middleware('throttle:login')
    ->name('login');

Route::get('authenticate', [LoginController::class, 'authenticate'])
    ->middleware('throttle:authenticate')
    ->name('authenticate');
