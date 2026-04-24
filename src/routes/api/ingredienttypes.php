<?php

use App\Http\Controllers\Api\IngredientTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('ingredienttypes')->name('api.ingredienttypes.')->group(function (): void {
    Route::get('/', [IngredientTypeController::class, 'index'])
        ->middleware('throttle:api')
        ->name('index');
    Route::get('{id}', [IngredientTypeController::class, 'get'])
        ->middleware('throttle:api')
        ->name('get');

    Route::post('/', [IngredientTypeController::class, 'add'])
        ->middleware(['auth', 'throttle:api'])
        ->name('add');
    Route::put('{id}', [IngredientTypeController::class, 'update'])
        ->middleware(['auth', 'throttle:api'])
        ->name('update');
    Route::delete('{id}', [IngredientTypeController::class, 'delete'])
        ->middleware(['auth', 'throttle:api'])
        ->name('delete');
});