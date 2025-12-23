<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Repositories\IUnitRepository;

class UnitRepository extends Repository implements IUnitRepository
{
    public function create($data)
    {
        return Unit::create($data);
    }

    public function update($id, $data)
    {
        return Unit::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Unit::destroy($id);
    }

    public function readAll(): array
    {
        return Unit::all()->toArray();
    }

    public function readById($id): ?object
    {
        return Unit::find($id);
    }
}