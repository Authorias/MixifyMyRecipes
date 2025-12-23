<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Providers\SiteThrottler;
use App\Http\Controllers\Api\Converters\JsonModelConverter;
use App\Http\Controllers\Api\Converters\RecipeJsonModelConverter;
use App\Http\Controllers\Api\Converters\IngredientJsonModelConverter;
use App\Http\Controllers\Api\Converters\MenuJsonModelConverter;
use App\Http\Controllers\Api\Converters\IngredientTypeJsonModelConverter;
use App\Http\Controllers\Api\Converters\RecipeTypeJsonModelConverter;
use App\Http\Controllers\Api\Converters\UnitJsonModelConverter;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\IngredientTypeController;
use App\Http\Controllers\Api\RecipeTypeController;
use App\Http\Controllers\Api\UnitController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register converters as singletons for efficiency
        $this->app->singleton(IngredientTypeJsonModelConverter::class);
        $this->app->singleton(RecipeTypeJsonModelConverter::class);
        $this->app->singleton(UnitJsonModelConverter::class);
        $this->app->singleton(IngredientJsonModelConverter::class);
        $this->app->singleton(RecipeJsonModelConverter::class);
        $this->app->singleton(MenuJsonModelConverter::class);

        // Bind specific converters when controllers are resolved
        $this->app->when(RecipeController::class)
            ->needs(JsonModelConverter::class)
            ->give(RecipeJsonModelConverter::class);

        $this->app->when(IngredientController::class)
            ->needs(JsonModelConverter::class)
            ->give(IngredientJsonModelConverter::class);

        $this->app->when(MenuController::class)
            ->needs(JsonModelConverter::class)
            ->give(MenuJsonModelConverter::class);

        $this->app->when(IngredientTypeController::class)
            ->needs(JsonModelConverter::class)
            ->give(IngredientTypeJsonModelConverter::class);

        $this->app->when(RecipeTypeController::class)
            ->needs(JsonModelConverter::class)
            ->give(RecipeTypeJsonModelConverter::class);

        $this->app->when(UnitController::class)
            ->needs(JsonModelConverter::class)
            ->give(UnitJsonModelConverter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SiteThrottler::configure();
    }
}