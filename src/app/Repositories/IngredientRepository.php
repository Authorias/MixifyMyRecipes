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

    public function update($id, $data)
    {
        return Ingredient::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Ingredient::destroy($id);
    }

    public function readAll(): array
    {
        return Ingredient::all()->toArray();
    }

    public function readById($id): ?object
    {
        return Ingredient::find($id);
    }
}