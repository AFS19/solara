<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Reviewer Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('author_name')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('skin_type')
                                    ->options([
                                        'oily' => 'Oily',
                                        'dry' => 'Dry',
                                        'sensitive' => 'Sensitive',
                                        'combination' => 'Combination',
                                        'all' => 'All Skin Types',
                                    ])
                                    ->native(false),
                            ]),
                    ]),

                Section::make('Review Content')
                    ->schema([
                        Textarea::make('quote')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Select::make('rating')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->default(5)
                            ->native(false),
                    ]),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('avatar')
                            ->image()
                            ->directory('testimonials/avatars')
                            ->avatar()
                            ->maxSize(1024),
                    ]),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
