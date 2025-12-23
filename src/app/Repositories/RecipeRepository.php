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

    public function update($id, $data)
    {
        return Recipe::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Recipe::destroy($id);
    }

    public function readAll(): array
    {
        return Recipe::all()->toArray();
    }

    public function readById($id): ?object
    {
        return Recipe::find($id);
    }
}