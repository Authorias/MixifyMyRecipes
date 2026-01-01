<?php

namespace App\Repositories;

use App\Models\RecipeIngredient;
use App\Repositories\IRecipeIngredientRepository;

class RecipeIngredientRepository extends Repository implements IRecipeIngredientRepository
{
    public function readById(array $primaryKeys): ?object
    {
        return $this->getModelName()::where('recipeid', $this->getValueFromPrimaryKeys($primaryKeys))
            ->where('ingredient', $this->getValueFromPrimaryKeys($primaryKeys, 1))
            ->first();
    }

    public function readByRecipeId(int $recipeId): array
    {
        return $this->getModelName()::where('recipeid', $recipeId)->get()->toArray();
    }

    public function __construct()
    {
        parent::__construct(RecipeIngredient::class);
    }
}