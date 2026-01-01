<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeMenu>
 */
class MenuRecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menuid' => fake()->randomNumber(),
            'recipieid' => fake()->randomNumber(),
            'position' => fake()->numberBetween(1, 100),
        ];
    }
}