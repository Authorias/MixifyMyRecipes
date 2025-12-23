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

    public function update($id, $data)
    {
        return RecipeType::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return RecipeType::destroy($id);
    }

    public function readAll(): array
    {
        return RecipeType::all()->toArray();
    }

    public function readById($id): ?object
    {
        return RecipeType::find($id);
    }
}