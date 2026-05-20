<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Sunscreen');
        $this->migrator->add('general.tagline', 'Modern SaaS Platform');
        $this->migrator->add('general.hero_headline', 'Build Something Amazing');
        $this->migrator->add('general.hero_subtext', 'The platform for modern teams');
        $this->migrator->add('general.hero_cta_text', 'Get Started');
        $this->migrator->add('general.hero_cta_url', '/register');
        $this->migrator->add('general.social_links', []);
    }
};
