<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\RecipeIngredient;
use App\Repositories\IRecipeIngredientRepository;

class RecipeIngredientRepository extends Repository implements IRecipeIngredientRepository {
    public function getById(array $primaryKeys) : ?object {
        return $this->getModelName()::where('recipeid', $this->getValueFromPrimaryKeys($primaryKeys))
            ->where('ingredientid', $this->getValueFromPrimaryKeys($primaryKeys, 1))
            ->first();
    }

    public function getByRecipeId(int $recipeId) : Collection {
        return $this->getModelName()::where('recipeid', $recipeId)
            ->get();
    }

    public function __construct() {
        parent::__construct(RecipeIngredient::class);
    }
}