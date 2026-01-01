<?php

namespace App\Repositories;

interface IRecipeIngredientRepository extends IReadWriteRepository
{
    function readByRecipeId(int $recipeId): array;
}