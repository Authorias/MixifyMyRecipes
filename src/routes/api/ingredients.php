<?php

use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\IngredientTypeController;
use App\Http\Controllers\Api\RecipeTypeController;
use App\Http\Controllers\Api\UnitController;
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

Route::prefix('units')->name('api.units.')->group(function (): void {
    Route::get('/', [UnitController::class, 'index'])
        ->middleware('throttle:api')
        ->name('index');
    Route::get('{id}', [UnitController::class, 'get'])
        ->middleware('throttle:api')
        ->name('get');

    Route::post('/', [UnitController::class, 'add'])
        ->middleware(['auth', 'throttle:api'])
        ->name('add');
    Route::put('{id}', [UnitController::class, 'update'])
        ->middleware(['auth', 'throttle:api'])
        ->name('update');
    Route::delete('{id}', [UnitController::class, 'delete'])
        ->middleware(['auth', 'throttle:api'])
        ->name('delete');
});
