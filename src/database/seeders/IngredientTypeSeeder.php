<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\IngredientType;

class IngredientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IngredientType::factory()->create([
            'name' => 'Groente',
        ]);        

        IngredientType::factory()->create([
            'name' => 'Fruit',
        ]);        

        IngredientType::factory()->create([
            'name' => 'Zuivel',
        ]);        

        IngredientType::factory()->create([
            'name' => 'Vlees',
        ]);        

        IngredientType::factory()->create([
            'name' => 'Vis',
        ]);        

        IngredientType::factory()->create([
            'name' => 'Kruiden & Specerijen',
        ]);

        IngredientType::factory()->create([
            'name' => 'Noten & Zaden',
        ]);

        IngredientType::factory()->create([
            'name' => 'Dranken (Alcohol)',
        ]);

        IngredientType::factory()->create([
            'name' => 'Dranken (Non alcohol)',
        ]);
    }
}