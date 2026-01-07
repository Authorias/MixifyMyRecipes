<?php

use Illuminate\Support\Facades\Route;

function createApiCrudRoutes(string $name, string $controllerName) {
    $prefix = 'api/' . $name;

    // Public read endpoints
    Route::get($prefix, [$controllerName, 'index'])
        ->middleware('throttle:api')
        ->name('api.' . $name . '.index');
    Route::get($prefix . '/{id}', [$controllerName, 'get'])
        ->middleware('throttle:api')
        ->name('api.' . $name . '.get');
    
    // Protected write endpoints
    Route::post($prefix, [$controllerName, 'add'])
        ->middleware(['auth', 'throttle:api'])
        ->name('api.' . $name . '.add');
    Route::put($prefix . '/{id}', [$controllerName, 'update'])
        ->middleware(['auth', 'throttle:api'])
        ->name('api.' . $name . '.update');
    Route::delete($prefix . '/{id}', [$controllerName, 'delete'])
        ->middleware(['auth', 'throttle:api'])
        ->name('api.' . $name . '.delete');
}
