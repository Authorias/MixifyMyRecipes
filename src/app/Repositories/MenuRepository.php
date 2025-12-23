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

    public function update($id, $data)
    {
        return Menu::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Menu::destroy($id);
    }

    public function readAll(): array
    {
        return Menu::all()->toArray();
    }

    public function readById($id): ?object
    {
        return Menu::find($id);
    }
}