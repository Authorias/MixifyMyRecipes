<?php

namespace App\Repositories;

interface IMenuRecipeRepository extends IReadWriteRepository
{
    function readByMenuId(int $menuId): array;
}