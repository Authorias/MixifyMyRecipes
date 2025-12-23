<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Recipe;

class RecipeType extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeTypeFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    protected $table = 'recipetypes';

    public $timestamps = true;

    public function recipes() : HasMany
    {
        return $this->hasMany(Recipe::class, 'recipetypeid');
    }
}