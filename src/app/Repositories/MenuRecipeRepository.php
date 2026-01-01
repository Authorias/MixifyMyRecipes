<?php

namespace App\Repositories;

use App\Models\MenuRecipe;
use App\Repositories\IMenuRecipeRepository;

class MenuRecipeRepository extends Repository implements IMenuRecipeRepository
{
    public function readByMenuId(int $menuId): array
    {
        return $this->getModelName()::where('menuid', $menuId)
        ->get()
        ->toArray();
    }

    public function readById(array $primaryKeys): ?object
    {
        return $this->getModelName()::where('menuid', $this->getValueFromPrimaryKeys($primaryKeys))
            ->where('recipeid', $this->getValueFromPrimaryKeys($primaryKeys, 1))
            ->first();
    }

    public function __construct()
    {
        parent::__construct(MenuRecipe::class);
    }
}