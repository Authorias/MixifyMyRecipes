<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IngredientTypeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'throttle:global'])->group(function (): void {
    Route::resource('ingredients', IngredientController::class)
        ->names('ingredients');

    Route::resource('ingredienttypes', IngredientTypeController::class)
        ->names('ingredienttypes');

    Route::resource('recipes', RecipeController::class)
        ->names('recipes');

    Route::resource('menus', MenuController::class)
        ->names('menus');
});
