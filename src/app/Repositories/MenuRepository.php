<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\IMenuRepository;

class MenuRepository extends Repository implements IMenuRepository
{
    public function readById(array $primaryKeys): ?object
    {
        return $this->getModelName()::where('id', $this->getValueFromPrimaryKeys($primaryKeys))->first();
    }

    public function __construct()
    {
        parent::__construct(Menu::class);
    }
}