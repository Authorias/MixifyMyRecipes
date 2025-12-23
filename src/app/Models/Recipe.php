<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\IngredientRecipe;
use App\Models\RecipeMenu;
use App\Models\RecipeType;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'tags',
        'type',
        'numberofpeople',
        'preparation',
        'preparationtime',
        'createdby',
    ];

    protected $table = 'recipes';

    public $timestamps = true;

    public function type(): HasOne
    {
        return $this->hasOne(RecipeType::class, 'id', 'recipetypeid');
    }

    public function ingredientRecipes(): HasMany
    {
        return $this->hasMany(IngredientRecipe::class, 'recipeid');
    }

    public function recipieMenus(): HasMany
    {
        return $this->hasMany(RecipeMenu::class, 'recipeid');
    }
}