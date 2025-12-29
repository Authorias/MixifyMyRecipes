<?php

namespace App\Repositories;

use App\Models\RecipeType;
use App\Repositories\IRecipeTypeRepository;

class RecipeTypeRepository extends Repository implements IRecipeTypeRepository
{
    public function create($data)
    {
        return RecipeType::create($data);
    }

    public function update(array $primaryKeys, $data)
    {
        return RecipeType::where(
            'id', 
            $this->getValueFromPrimaryKeys($primaryKeys, 0)
        )->update($data);
    }

    public function delete(array $primaryKeys)
    {
        return RecipeType::destroy($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }

    public function readAll(): array
    {
        return RecipeType::all()->toArray();
    }

    public function readById(array $primaryKeys): ?object
    {
        return RecipeType::find($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }
}