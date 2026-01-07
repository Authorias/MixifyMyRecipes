<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IngredientTypeController;


use App\Http\Controllers\Api\AuthenticationController as ApiAuthenticationController;
use App\Http\Controllers\Api\IngredientController as ApiIngredientController;
use App\Http\Controllers\Api\IngredientTypeController as ApiIngredientTypeController;
use App\Http\Controllers\Api\MenuController as ApiMenuController;
use App\Http\Controllers\Api\RecipeController as ApiRecipeController;
use App\Http\Controllers\Api\RecipeTypeController as ApiRecipeTypeController;
use App\Http\Controllers\Api\UnitController as ApiUnitController;

include(__DIR__ . '/utils.php');

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', [HomeController::class, 'index'])
//    ->middleware('throttle:global')
//    ->name('home');

Route::get('login', [LoginController::class, 'index'])
    ->middleware('throttle:login')
    ->name('login');

Route::get('authenticate', [LoginController::class, 'authenticate'])
    ->middleware('throttle:authenticate')
    ->name('authenticate');

Route::resource('ingredients', IngredientController::class)
    ->middleware(['auth', 'throttle:global'])
    ->names('ingredients');

Route::resource('ingredienttypes', IngredientTypeController::class)
    ->middleware(['auth', 'throttle:global'])
    ->names('ingredienttypes');

Route::resource('recipes', RecipeController::class)
    ->middleware(['auth', 'throttle:global'])
    ->names('recipes');

Route::resource('menus', MenuController::class)
    ->middleware(['auth', 'throttle:global'])
    ->names('menus');

// API Routes
createApiCrudRoutes('ingredients', ApiIngredientController::class);
createApiCrudRoutes('ingredienttypes', ApiIngredientTypeController::class);
createApiCrudRoutes('recipetypes', ApiRecipeTypeController::class);
createApiCrudRoutes('units', ApiUnitController::class);

createApiCrudRoutes('menus', ApiMenuController::class);
Route::post('api/menus/recipes/{menuid}', [ApiMenuController::class, 'addRecipe'])
    ->middleware(['auth', 'throttle:api'])
    ->name('api.menus.recipes.add');
Route::put('api/menus/recipes/{menuid}', [ApiMenuController::class, 'updateRecipe'])
    ->middleware(['auth', 'throttle:api'])
    ->name('api.menus.recipes.update');
Route::delete('api/menus/recipes/{menuid}/{recipeid}', [ApiMenuController::class, 'deleteRecipe'])
    ->middleware(['auth', 'throttle:api'])
    ->name('api.menus.recipes.delete');

createApiCrudRoutes('recipes', ApiRecipeController::class);
Route::post('api/recipes/ingredients/{recipeid}', [ApiRecipeController::class, 'addIngredient'])
    ->middleware(['auth', 'throttle:api'])
    ->name('api.recipes.ingredients.add');
Route::put('api/recipes/ingredients/{recipeid}', [ApiRecipeController::class, 'updateIngredient'])
    ->middleware(['auth', 'throttle:api'])
    ->name('api.recipes.ingredients.update');
Route::delete('api/recipes/ingredients/{recipeid}/{ingredientid}', [ApiRecipeController::class, 'deleteIngredient'])
    ->middleware(['auth', 'throttle:api'])
    ->name('api.recipes.ingredients.delete');


Route::post('api/authentication/login', [ApiAuthenticationController::class, 'login'])
    ->middleware('throttle:login')
    ->name('api.authentication.login');
Route::post('api/authentication/logout', [ApiAuthenticationController::class, 'logout'])
    ->middleware(['auth', 'throttle:api'])
    ->name('api.authentication.logout');
