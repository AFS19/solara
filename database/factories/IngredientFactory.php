<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'benefit' => fake()->sentence(),
            'icon' => null,
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(80),
        ];
    }
}
