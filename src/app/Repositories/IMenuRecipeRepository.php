<?php

namespace App\Repositories;

interface IMenuRecipeRepository extends IReadWriteRepository {
    function getByMenuId(int $menuId): array;
}