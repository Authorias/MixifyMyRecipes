<?php

namespace App\Repositories;

use App\Models\IngredientType;
use App\Repositories\IIngredientTypeRepository;

class IngredientTypeRepository extends Repository implements IIngredientTypeRepository
{
    public function create($data)
    {
        return IngredientType::create($data);
    }

    public function update(array $primaryKeys, $data)
    {
        return IngredientType::where(
            'id', 
            $this->getValueFromPrimaryKeys($primaryKeys, 0)
        )->update($data);
    }

    public function delete(array $primaryKeys)
    {
        return IngredientType::destroy($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }

    public function readAll(): array
    {
        return IngredientType::all()->toArray();
    }

    public function readById(array $primaryKeys): ?object
    {
        return IngredientType::find($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }
}