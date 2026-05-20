<?php

namespace App\Models;

use Database\Factories\PricingPlanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    /** @use HasFactory<PricingPlanFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'billing_cycle',
        'features',
        'cta_label',
        'cta_url',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'features' => 'array',
            'is_featured' => 'boolean',
        ];
    }
}
