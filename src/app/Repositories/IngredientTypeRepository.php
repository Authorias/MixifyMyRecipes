<?php

namespace App\Repositories;

use App\Models\IngredientType;
use App\Repositories\IIngredientTypeRepository;

class IngredientTypeRepository extends Repository implements IIngredientTypeRepository {
    public function __construct() {
        parent::__construct(IngredientType::class);
    }
}