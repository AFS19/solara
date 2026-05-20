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
        $skinTypes = ['oily', 'dry', 'sensitive', 'combination', 'all'];

        return [
            'author_name' => fake()->name(),
            'skin_type' => fake()->randomElement($skinTypes),
            'quote' => fake()->paragraph(),
            'rating' => fake()->numberBetween(4, 5),
            'avatar' => null,
            'is_active' => true,
        ];
    }
}
