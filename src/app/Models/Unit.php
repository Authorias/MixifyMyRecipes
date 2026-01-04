<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\RecipeIngredient;

class Unit extends Model {
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

    public function recipeIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class, 'unitid');
    }
}