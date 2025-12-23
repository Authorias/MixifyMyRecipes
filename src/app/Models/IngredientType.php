<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IngredientType extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientTypeFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    protected $table = 'ingredienttypes';

    public $timestamps = true;

    public function ingredients() : HasMany
    {
        return $this->hasMany(Ingredient::class, 'ingredienttypeid');
    }
}