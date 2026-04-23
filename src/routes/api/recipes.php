<?php

use App\Http\Controllers\Api\RecipeController;
use Illuminate\Support\Facades\Route;

Route::prefix('recipes')->name('api.recipes.')->group(function (): void {
    Route::get('/', [RecipeController::class, 'index'])
        ->middleware('throttle:api')
        ->name('index');
    Route::get('{id}', [RecipeController::class, 'get'])
        ->middleware('throttle:api')
        ->name('get');

    Route::post('/', [RecipeController::class, 'add'])
        ->middleware(['auth', 'throttle:api'])
        ->name('add');
    Route::put('{id}', [RecipeController::class, 'update'])
        ->middleware(['auth', 'throttle:api'])
        ->name('update');
    Route::delete('{id}', [RecipeController::class, 'delete'])
        ->middleware(['auth', 'throttle:api'])
        ->name('delete');

    Route::post('ingredients/{recipeid}', [RecipeController::class, 'addIngredient'])
        ->middleware(['auth', 'throttle:api'])
        ->name('ingredients.add');
    Route::put('ingredients/{recipeid}', [RecipeController::class, 'updateIngredient'])
        ->middleware(['auth', 'throttle:api'])
        ->name('ingredients.update');
    Route::delete('ingredients/{recipeid}/{ingredientid}', [RecipeController::class, 'deleteIngredient'])
        ->middleware(['auth', 'throttle:api'])
        ->name('ingredients.delete');
});
