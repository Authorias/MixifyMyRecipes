<?php

use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

Route::prefix('menus')->name('api.menus.')->group(function (): void {
    Route::get('/', [MenuController::class, 'index'])
        ->middleware('throttle:api')
        ->name('index');
    Route::get('{id}', [MenuController::class, 'get'])
        ->middleware('throttle:api')
        ->name('get');

    Route::post('/', [MenuController::class, 'add'])
        ->middleware(['auth', 'throttle:api'])
        ->name('add');
    Route::put('{id}', [MenuController::class, 'update'])
        ->middleware(['auth', 'throttle:api'])
        ->name('update');
    Route::delete('{id}', [MenuController::class, 'delete'])
        ->middleware(['auth', 'throttle:api'])
        ->name('delete');

    Route::post('recipes/{menuid}', [MenuController::class, 'addRecipe'])
        ->middleware(['auth', 'throttle:api'])
        ->name('recipes.add');
    Route::put('recipes/{menuid}', [MenuController::class, 'updateRecipe'])
        ->middleware(['auth', 'throttle:api'])
        ->name('recipes.update');
    Route::delete('recipes/{menuid}/{recipeid}', [MenuController::class, 'deleteRecipe'])
        ->middleware(['auth', 'throttle:api'])
        ->name('recipes.delete');
});
