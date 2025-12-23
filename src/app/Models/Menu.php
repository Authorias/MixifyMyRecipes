<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\RecipeMenu;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
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
        'createdby',
    ];

    protected $table = 'menus';

    public $timestamps = true;

    public function recipeMenus(): HasMany
    {
        return $this->hasMany(RecipeMenu::class, 'menuid')->orderBy('position');
    }
}