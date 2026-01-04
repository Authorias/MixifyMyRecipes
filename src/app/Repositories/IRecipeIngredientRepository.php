<?php

namespace App\Repositories;

interface IRecipeIngredientRepository extends IReadWriteRepository {
    function getByRecipeId(int $recipeId) : array;
}