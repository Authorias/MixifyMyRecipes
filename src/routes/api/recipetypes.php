<?php

use App\Http\Controllers\Api\RecipeTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('recipetypes')->name('api.recipetypes.')->group(function (): void {
    Route::get('/', [RecipeTypeController::class, 'index'])
        ->middleware('throttle:api')
        ->name('index');
    Route::get('{id}', [RecipeTypeController::class, 'get'])
        ->middleware('throttle:api')
        ->name('get');

    Route::post('/', [RecipeTypeController::class, 'add'])
        ->middleware(['auth', 'throttle:api'])
        ->name('add');
    Route::put('{id}', [RecipeTypeController::class, 'update'])
        ->middleware(['auth', 'throttle:api'])
        ->name('update');
    Route::delete('{id}', [RecipeTypeController::class, 'delete'])
        ->middleware(['auth', 'throttle:api'])
        ->name('delete');
});