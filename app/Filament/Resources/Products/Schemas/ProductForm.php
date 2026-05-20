<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('tagline')
                                    ->maxLength(255),
                            ]),
                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Product Details')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('spf_value')
                                    ->options([
                                        '15' => 'SPF 15',
                                        '30' => 'SPF 30',
                                        '50' => 'SPF 50',
                                        '50+' => 'SPF 50+',
                                    ]),
                                Select::make('skin_type')
                                    ->options([
                                        'all' => 'All Skin Types',
                                        'sensitive' => 'Sensitive',
                                        'oily' => 'Oily',
                                        'dry' => 'Dry',
                                        'combination' => 'Combination',
                                    ]),
                                ColorPicker::make('color_hex')
                                    ->label('Product Color'),
                            ]),
                    ]),

                Section::make('Media & Assets')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('products/images')
                            ->columnSpan(1),
                        FileUpload::make('model_file')
                            ->label('3D Model (GLTF)')
                            ->directory('products/models')
                            ->acceptedFileTypes(['.gltf', '.glb'])
                            ->columnSpan(1),
                    ])->columns(2),

                Section::make('Display Settings')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label('Featured Product'),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }
}
