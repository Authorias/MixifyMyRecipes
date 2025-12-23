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

    public function update($id, $data)
    {
        return IngredientType::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return IngredientType::destroy($id);
    }

    public function readAll(): array
    {
        return IngredientType::all()->toArray();
    }

    public function readById($id): ?object
    {
        return IngredientType::find($id);
    }
}