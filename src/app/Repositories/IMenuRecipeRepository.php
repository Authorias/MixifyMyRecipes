<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IMenuRecipeRepository extends IReadWriteRepository {
    function getByMenuId(int $menuId) : Collection;
}