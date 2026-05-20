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
        $ingredients = [
            ['name' => 'Zinc Oxide', 'benefit' => 'Mineral sun protection that sits on skin surface, reflecting UV rays without irritation.', 'icon' => 'heroicon-o-shield-check'],
            ['name' => 'Hyaluronic Acid', 'benefit' => 'Deep hydration that plumps skin and reduces appearance of fine lines.', 'icon' => 'heroicon-o-droplet'],
            ['name' => 'Niacinamide', 'benefit' => 'Brightens skin tone, minimizes pores, and strengthens skin barrier.', 'icon' => 'heroicon-o-sparkles'],
            ['name' => 'Vitamin E', 'benefit' => 'Powerful antioxidant that protects against free radical damage.', 'icon' => 'heroicon-o-sun'],
            ['name' => 'Aloe Vera', 'benefit' => 'Soothes and calms irritated skin while providing lightweight moisture.', 'icon' => 'heroicon-o-leaf'],
        ];

        $ingredient = fake()->randomElement($ingredients);

        return [
            'name' => $ingredient['name'],
            'benefit' => $ingredient['benefit'],
            'icon' => $ingredient['icon'],
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}
