<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\IRecipeRepository;

class RecipeRepository extends Repository implements IRecipeRepository {
    public function __construct() {
        parent::__construct(Recipe::class);
    }
}