<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public string $tagline;

    public string $hero_headline;

    public string $hero_subtext;

    public string $hero_cta_text;

    public string $hero_cta_url;

    /** @var array<string, string> */
    public array $social_links;

    public static function group(): string
    {
        return 'general';
    }
}
