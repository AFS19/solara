<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $spfValues = ['30', '50', '50+'];
        $skinTypes = ['all', 'sensitive', 'oily', 'dry'];
        $colors = ['#f59e0b', '#38bdf8', '#10b981', '#f472b6'];

        return [
            'name' => fake()->words(3, true),
            'tagline' => fake()->sentence(),
            'description' => fake()->paragraphs(2, true),
            'spf_value' => fake()->randomElement($spfValues),
            'skin_type' => fake()->randomElement($skinTypes),
            'image' => null,
            'model_file' => null,
            'color_hex' => fake()->randomElement($colors),
            'is_featured' => fake()->boolean(30),
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
