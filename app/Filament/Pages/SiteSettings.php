<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use UnitEnum;

class SiteSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static string $settings = GeneralSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Site Information')
                    ->schema([
                        TextInput::make('site_name')
                            ->required(),
                        TextInput::make('tagline')
                            ->required(),
                    ]),
                Section::make('Hero Section')
                    ->schema([
                        TextInput::make('hero_headline')
                            ->required(),
                        Textarea::make('hero_subtext')
                            ->required(),
                        TextInput::make('hero_cta_text')
                            ->required(),
                        TextInput::make('hero_cta_url')
                            ->required(),
                    ]),
                Section::make('Social Links')
                    ->schema([
                        KeyValue::make('social_links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL')
                            ->helperText('Add social media links (e.g., twitter, github, linkedin)'),
                    ]),
            ]);
    }
}
