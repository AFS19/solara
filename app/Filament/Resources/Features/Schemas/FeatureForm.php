<?php

namespace App\Filament\Resources\Features\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Feature Details'))
                    ->schema([
                        TextInput::make('title')
                            ->label(__('Title'))
                            ->required(),
                        Textarea::make('description')
                            ->label(__('Description'))
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('icon')
                            ->label(__('Icon'))
                            ->default(null),
                        TextInput::make('sort_order')
                            ->label(__('Sort Order'))
                            ->required()
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label(__('Is Active'))
                            ->required(),
                    ]),
            ]);
    }
}
