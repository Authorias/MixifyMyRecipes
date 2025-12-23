<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\RecipeType;

class RecipeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeType::factory()->create([
            'name' => 'Voorgerecht (Koud)',
        ]);

        RecipeType::factory()->create([
            'name' => 'Voorgerecht (Warm)',
        ]);

        RecipeType::factory()->create([
            'name' => 'Hoofdgerecht',
        ]);

        RecipeType::factory()->create([
            'name' => 'Nagerecht (Koud)',
        ]);

        RecipeType::factory()->create([
            'name' => 'Nagerecht (Warm)',
        ]);

        RecipeType::factory()->create([
            'name' => 'Soep (Koud)',
        ]);

        RecipeType::factory()->create([
            'name' => 'Soep (Warm)',
        ]);

        RecipeType::factory()->create([
            'name' => 'Kaas',
        ]);
    }
}