<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Ingredient;
use App\Models\IngredientRecipe;

class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'abbreviation',
    ];

    protected $table = 'units';

    public $timestamps = true;

    public function ingredientRecipes(): HasMany
    {
        return $this->hasMany(IngredientRecipe::class, 'unitid');
    }
}