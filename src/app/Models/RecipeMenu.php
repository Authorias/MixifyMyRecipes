<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Menu;
use App\Models\Recipe;

class RecipeMenu extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeMenuFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'menuid',
        'recipieid',
        'position',
    ];

    protected $table = 'menurecipes';

    public $timestamps = true;

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menuid');
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class, 'recipeid');
    }
}