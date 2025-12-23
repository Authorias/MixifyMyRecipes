<?php

use Illuminate\Support\Facades\Route;

function createApiCrudRoutes(string $name, string $controllerName) {
    $prefix = 'api/' . $name;

    Route::get($prefix, [$controllerName, 'index'])
        ->middleware('throttle:api')
        ->name('api.' . $name . '.index');
    Route::get($prefix . '/{id}', [$controllerName, 'get'])
        ->middleware('throttle:api')
        ->name('api.' . $name . '.get');
    Route::post($prefix, [$controllerName, 'add'])
        ->middleware('throttle:api')
        ->name('api.' . $name . '.add');
    Route::put($prefix . '/{id}', [$controllerName, 'update'])
        ->middleware('throttle:api')
        ->name('api.' . $name . '.update');
    Route::delete($prefix . '/{id}', [$controllerName, 'delete'])
        ->middleware('throttle:api')
        ->name('api.' . $name . '.delete');
}
