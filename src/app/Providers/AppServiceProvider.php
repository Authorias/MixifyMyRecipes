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

use App\Repositories\IIngredientRepository;
use App\Repositories\IngredientRepository;
use App\Repositories\IIngredientTypeRepository;
use App\Repositories\IngredientTypeRepository;
use App\Repositories\IRecipeRepository;
use App\Repositories\RecipeRepository;
use App\Repositories\IRecipeTypeRepository;
use App\Repositories\RecipeTypeRepository;
use App\Repositories\IMenuRepository;
use App\Repositories\MenuRepository;
use App\Repositories\IUnitRepository;
use App\Repositories\UnitRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();

        $this->registerJsonConverters();

        $this->registerControllers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SiteThrottler::configure();
    }

    private function registerControllers()
    {
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

    private function registerRepositories()
    {
        // Register repositories
        $this->app->bind(IIngredientRepository::class, IngredientRepository::class);
        $this->app->bind(IIngredientTypeRepository::class, IngredientTypeRepository::class);
        $this->app->bind(IRecipeRepository::class, RecipeRepository::class);
        $this->app->bind(IRecipeTypeRepository::class, RecipeTypeRepository::class);
        $this->app->bind(IMenuRepository::class, MenuRepository::class);
        $this->app->bind(IUnitRepository::class, UnitRepository::class);
    }

    private function registerJsonConverters()
    {
        // Register converters as singletons for efficiency
        $this->app->singleton(IngredientTypeJsonModelConverter::class);
        $this->app->singleton(RecipeTypeJsonModelConverter::class);
        $this->app->singleton(UnitJsonModelConverter::class);
        $this->app->singleton(IngredientJsonModelConverter::class);
        $this->app->singleton(RecipeJsonModelConverter::class);
        $this->app->singleton(MenuJsonModelConverter::class);
    }
}