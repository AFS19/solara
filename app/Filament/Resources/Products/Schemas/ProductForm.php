<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Product Details'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('slug')
                            ->label(__('Slug'))
                            ->required(),
                        Textarea::make('description')
                            ->label(__('Description'))
                            ->default(null)
                            ->columnSpanFull(),
                        TextInput::make('price')
                            ->label(__('Price'))
                            ->numeric()
                            ->default(null)
                            ->prefix('$'),
                        FileUpload::make('image')
                            ->label(__('Image'))
                            ->image()
                            ->visibility('public'),
                        Toggle::make('is_active')
                            ->label(__('Is Active'))
                            ->required(),
                        Toggle::make('is_featured')
                            ->label(__('Is Featured'))
                            ->required(),
                    ]),
            ]);
    }
}
