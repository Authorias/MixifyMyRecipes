<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\MenuRecipe;
use App\Repositories\IMenuRecipeRepository;

class MenuRecipeRepository extends Repository implements IMenuRecipeRepository {
    public function getByMenuId(int $menuId) : Collection {
        return $this->getModelName()::where('menuid', $menuId)
            ->get();
    }

    public function getById(array $primaryKeys) : ?object {
        return $this->getModelName()::where('menuid', $this->getValueFromPrimaryKeys($primaryKeys))
            ->where('recipeid', $this->getValueFromPrimaryKeys($primaryKeys, 1))
            ->first();
    }

    public function __construct() {
        parent::__construct(MenuRecipe::class);
    }
}