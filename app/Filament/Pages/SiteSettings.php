<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class SiteSettings extends SettingsPage
{
    protected static string $settings = GeneralSettings::class;

    protected static string|array $middleware = ['auth'];

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog8Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Brand Identity')
                    ->schema([
                        TextInput::make('brand_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('brand_tagline')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Hero Section')
                    ->schema([
                        TextInput::make('hero_headline')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('hero_subtext')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('hero_cta_text')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('hero_cta_url')
                            ->required()
                            ->maxLength(255)
                            ->url(),
                    ])
                    ->columns(2),

                Section::make('Design System')
                    ->schema([
                        ColorPicker::make('primary_color')
                            ->required(),
                        ColorPicker::make('accent_color')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Social Links')
                    ->schema([
                        KeyValue::make('social_links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL')
                            ->addable()
                            ->reorderable()
                            ->default([
                                'instagram' => '',
                                'tiktok' => '',
                                'facebook' => '',
                            ]),
                    ]),
            ]);
    }
}
