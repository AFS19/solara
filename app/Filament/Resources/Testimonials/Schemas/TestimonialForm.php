<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Testimonial Details'))
                    ->schema([
                        TextInput::make('author_name')
                            ->label(__('Author Name'))
                            ->required(),
                        TextInput::make('company')
                            ->label(__('Company'))
                            ->default(null),
                        Textarea::make('quote')
                            ->label(__('Quote'))
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('avatar')
                            ->label(__('Avatar'))
                            ->default(null),
                        Toggle::make('is_featured')
                            ->label(__('Is Featured'))
                            ->required(),
                    ]),
            ]);
    }
}
