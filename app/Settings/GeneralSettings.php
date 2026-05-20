<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $brand_name;

    public ?string $brand_tagline;

    public string $hero_headline;

    public ?string $hero_subtext;

    public string $hero_cta_text;

    public string $hero_cta_url;

    public string $primary_color;

    public string $accent_color;

    /** @var array<string, string> */
    public array $social_links;

    public static function group(): string
    {
        return 'general';
    }
}
