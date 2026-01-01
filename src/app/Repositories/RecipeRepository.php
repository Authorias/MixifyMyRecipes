<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\IRecipeRepository;

class RecipeRepository extends Repository implements IRecipeRepository
{
    public function readById(array $primaryKeys): ?object
    {
        return $this->getModelName()::where('id', $this->getValueFromPrimaryKeys($primaryKeys))->first();
    }

    public function __construct()
    {
        parent::__construct(Recipe::class);
    }
}