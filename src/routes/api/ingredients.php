<?php

use App\Http\Controllers\Api\IngredientController;
use Illuminate\Support\Facades\Route;

Route::prefix('ingredients')->name('api.ingredients.')->group(function (): void {
    Route::get('/', [IngredientController::class, 'index'])
        ->middleware('throttle:api')
        ->name('index');
    Route::get('{id}', [IngredientController::class, 'get'])
        ->middleware('throttle:api')
        ->name('get');

    Route::post('/', [IngredientController::class, 'add'])
        ->middleware(['auth', 'throttle:api'])
        ->name('add');
    Route::put('{id}', [IngredientController::class, 'update'])
        ->middleware(['auth', 'throttle:api'])
        ->name('update');
    Route::delete('{id}', [IngredientController::class, 'delete'])
        ->middleware(['auth', 'throttle:api'])
        ->name('delete');
});
