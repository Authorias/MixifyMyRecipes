<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Unit;

class RecipeIngredient extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeIngredientFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'recipeid',
        'ingredientid',
        'unitid',
        'quantity',
    ];

    protected $table = 'recipeingredients';

    public $timestamps = true;

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class, 'ingredientid');
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class, 'recipeid');
    }

    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class, 'id', 'unitid');
    }
}