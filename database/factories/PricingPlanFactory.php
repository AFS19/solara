<?php

namespace Database\Factories;

use App\Models\PricingPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PricingPlan>
 */
class PricingPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Starter', 'Pro', 'Enterprise']),
            'price' => fake()->randomElement([9.99, 29.99, 99.99]),
            'billing_cycle' => fake()->randomElement(['month', 'year']),
            'features' => fake()->randomElements(
                ['Unlimited users', 'API access', 'Priority support', 'Custom integrations', 'Analytics'],
                fake()->numberBetween(2, 5)
            ),
            'cta_label' => 'Get Started',
            'cta_url' => '/register',
            'is_featured' => fake()->boolean(33),
        ];
    }
}
