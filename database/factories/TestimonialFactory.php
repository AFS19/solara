<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skinTypes = ['all', 'sensitive', 'oily', 'dry'];

        return [
            'author_name' => fake()->name(),
            'skin_type' => fake()->randomElement($skinTypes),
            'quote' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
            'avatar' => null,
            'is_active' => fake()->boolean(80),
        ];
    }
}
