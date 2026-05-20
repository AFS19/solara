<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.brand_name', 'Solara');
        $this->migrator->add('general.brand_tagline', 'Premium Sun Protection');
        $this->migrator->add('general.hero_headline', 'Protect Your Skin with Confidence');
        $this->migrator->add('general.hero_subtext', 'Advanced sunscreen formulas for every skin type. Dermatologist tested, reef safe, and made for daily wear.');
        $this->migrator->add('general.hero_cta_text', 'Shop Now');
        $this->migrator->add('general.hero_cta_url', '#products');
        $this->migrator->add('general.primary_color', '#f59e0b');
        $this->migrator->add('general.accent_color', '#38bdf8');
        $this->migrator->add('general.social_links', [
            'instagram' => '',
            'tiktok' => '',
            'facebook' => '',
        ]);
    }
};
