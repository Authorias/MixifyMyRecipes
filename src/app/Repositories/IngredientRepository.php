<?php

namespace App\Repositories;

use App\Models\Ingredient;
use App\Repositories\IIngredientRepository;

class IngredientRepository extends Repository implements IIngredientRepository
{
    public function readById(array $primaryKeys): ?object
    {
        return $this->getModelName()::where('id', $this->getValueFromPrimaryKeys($primaryKeys))->first();
    }

    public function __construct()
    {
        parent::__construct(Ingredient::class);
    }
}