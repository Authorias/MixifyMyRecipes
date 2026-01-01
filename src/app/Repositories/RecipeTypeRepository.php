<?php

namespace App\Repositories;

use App\Models\RecipeType;
use App\Repositories\IRecipeTypeRepository;

class RecipeTypeRepository extends Repository implements IRecipeTypeRepository
{
    public function readById(array $primaryKeys): ?object
    {
        return $this->getModelName()::where('id', $this->getValueFromPrimaryKeys($primaryKeys))->first();
    }

    public function __construct()
    {
        parent::__construct(RecipeType::class);
    }
}