<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\IngredientType;
use App\Models\IngredientRecipe;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'ingredienttypeid',
    ];

    protected $table = 'ingredients';

    public $timestamps = true;

    public function ingredientType(): HasOne
    {
        return $this->hasOne(IngredientType::class, 'id', 'ingredienttypeid');
    }
    
    public function ingredientRecipes(): HasMany
    {
        return $this->hasMany(IngredientRecipe::class);
    }
}