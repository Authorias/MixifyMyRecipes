<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Repositories\IUnitRepository;

class UnitRepository extends Repository implements IUnitRepository
{
    public function readById(array $primaryKeys): ?object
    {
        return $this->getModelName()::where('id', $this->getValueFromPrimaryKeys($primaryKeys))->first();
    }

    public function __construct()
    {
        parent::__construct(Unit::class);
    }
}