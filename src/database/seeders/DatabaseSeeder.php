<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\IngredientTypeSeeder;
use Database\Seeders\RecipeTypeSeeder;
use Database\Seeders\UnitSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UnitSeeder::class,
            RecipeTypeSeeder::class,
            IngredientTypeSeeder::class,
        ]);        
    }
}