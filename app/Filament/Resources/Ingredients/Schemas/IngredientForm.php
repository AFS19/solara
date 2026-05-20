<?php

namespace App\Filament\Resources\Ingredients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IngredientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ingredient Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('benefit')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Display Settings')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('icon')
                                    ->options([
                                        'heroicon-o-shield-check' => 'Shield Check',
                                        'heroicon-o-droplet' => 'Droplet',
                                        'heroicon-o-sparkles' => 'Sparkles',
                                        'heroicon-o-sun' => 'Sun',
                                        'heroicon-o-leaf' => 'Leaf',
                                        'heroicon-o-heart' => 'Heart',
                                        'heroicon-o-star' => 'Star',
                                    ])
                                    ->native(false),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
