<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('FAQ Content')
                    ->schema([
                        Textarea::make('question')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),
                        Textarea::make('answer')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Settings')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }
}
