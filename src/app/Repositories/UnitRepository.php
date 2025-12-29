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

    public function update(array $primaryKeys, $data)
    {
        return Unit::where(
            'id', 
            $this->getValueFromPrimaryKeys($primaryKeys, 0)
        )->update($data);
    }

    public function delete(array $primaryKeys)
    {
        return Unit::destroy($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }

    public function readAll(): array
    {
        return Unit::all()->toArray();
    }

    public function readById(array $primaryKeys): ?object
    {
        return Unit::find($this->getValueFromPrimaryKeys($primaryKeys, 0));
    }
}