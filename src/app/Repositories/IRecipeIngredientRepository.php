<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IRecipeIngredientRepository extends IReadWriteRepository {
    function getByRecipeId(int $recipeId) : Collection;
}