<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\IRecipeRepository;

class RecipeRepository extends Repository implements IRecipeRepository
{
    public function create($data)
    {
        return Recipe::create($data);
    }

    public function update(array $primaryKeys, $data)
    {
        return Recipe::where(
            'id', 
            $this->getValueFromPrimaryKeys($primaryKeys, 0)
        )->update($data);
    }

    public function delete(array $primaryKeys)
    {
        return Recipe::destroy($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }

    public function readAll(): array
    {
        return Recipe::all()->toArray();
    }

    public function readById(array $primaryKeys): ?object
    {
        return Recipe::find($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }
}