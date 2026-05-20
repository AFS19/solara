<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faqs = [
            [
                'question' => 'How often should I reapply sunscreen?',
                'answer' => 'Reapply every 2 hours when outdoors, or immediately after swimming, sweating, or towel drying.',
            ],
            [
                'question' => 'Is this sunscreen safe for sensitive skin?',
                'answer' => 'Yes, our mineral-based formula is dermatologist-tested and free from common irritants like fragrances and parabens.',
            ],
            [
                'question' => 'Will this sunscreen leave a white cast?',
                'answer' => 'Our advanced mineral formula rubs in clear on all skin tones without the traditional white cast.',
            ],
            [
                'question' => 'Is this sunscreen reef-safe?',
                'answer' => 'Absolutely. We use non-nano zinc oxide that is 100% reef-safe and ocean-friendly.',
            ],
            [
                'question' => 'Can I wear this under makeup?',
                'answer' => 'Yes, our lightweight formula creates a perfect primer base that sits well under makeup without pilling.',
            ],
        ];

        $faq = fake()->randomElement($faqs);

        return [
            'question' => $faq['question'],
            'answer' => $faq['answer'],
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}
