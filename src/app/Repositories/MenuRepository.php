<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\IMenuRepository;

class MenuRepository extends Repository implements IMenuRepository
{
    public function create($data)
    {
        return Menu::create($data);
    }

    public function update(array $primaryKeys, $data)
    {
        return Menu::where(
            'id', 
            $this->getValueFromPrimaryKeys($primaryKeys, 0)
        )->update($data);
    }

    public function delete(array $primaryKeys)
    {
        return Menu::destroy($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }

    public function readAll(): array
    {
        return Menu::all()->toArray();
    }

    public function readById(array $primaryKeys): ?object
    {
        return Menu::find($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }
}