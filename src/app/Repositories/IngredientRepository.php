<?php

namespace App\Repositories;

use App\Models\Ingredient;
use App\Repositories\IIngredientRepository;

class IngredientRepository extends Repository implements IIngredientRepository
{
    public function create($data)
    {
        return Ingredient::create($data);
    }

    public function update(array $primaryKeys, $data)
    {
        return Ingredient::where(
            'id', 
            $this->getValueFromPrimaryKeys($primaryKeys, 0)
        )->update($data);
    }

    public function delete(array $primaryKeys)
    {
        return Ingredient::destroy($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }

    public function readAll(): array
    {
        return Ingredient::all()->toArray();
    }

    public function readById(array $primaryKeys): ?object
    {
        return Ingredient::find($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }
}