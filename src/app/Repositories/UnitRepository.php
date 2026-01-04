<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Repositories\IUnitRepository;

class UnitRepository extends Repository implements IUnitRepository {
    public function __construct() {
        parent::__construct(Unit::class);
    }
}