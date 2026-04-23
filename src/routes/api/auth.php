<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->name('api.authentication.')->group(function (): void {
    Route::post('login', [AuthenticationController::class, 'login'])
        ->middleware('throttle:login')
        ->name('login');

    Route::post('logout', [AuthenticationController::class, 'logout'])
        ->middleware(['auth', 'throttle:api'])
        ->name('logout');
});
