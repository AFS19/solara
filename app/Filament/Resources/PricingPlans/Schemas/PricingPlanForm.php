<?php

namespace App\Filament\Resources\PricingPlans\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PricingPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Pricing Plan Details'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('price')
                            ->label(__('Price'))
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        TextInput::make('billing_cycle')
                            ->label(__('Billing Cycle'))
                            ->required(),
                        TagsInput::make('features')
                            ->label(__('Features'))
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('cta_label')
                            ->label(__('CTA Label'))
                            ->required()
                            ->default('Get Started'),
                        TextInput::make('cta_url')
                            ->label(__('CTA URL'))
                            ->url()
                            ->default(null),
                        Toggle::make('is_featured')
                            ->label(__('Is Featured'))
                            ->required(),
                    ]),
            ]);
    }
}
