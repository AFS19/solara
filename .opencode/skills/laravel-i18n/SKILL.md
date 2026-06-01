---
name: laravel-i18n
description: "Laravel localization - __(), trans_choice(), lang files, JSON translations, pluralization, middleware, formatting. Use when implementing translations."
license: MIT
metadata:
  author: laravel
---

# Laravel Internationalization

## Documentation

Use `search-docs` for Laravel localization patterns. Use `context7_query-docs` with library `laravel/framework` for API specifics.

## Overview

| Feature | PHP Files | JSON Files |
|---------|-----------|------------|
| Keys | Short (`messages.welcome`) | Full text |
| Nesting | Supported | Flat only |
| Best for | Structured translations | Large apps |

## Critical Rules

1. **Never concatenate strings** - Use `:placeholder` replacements
2. **Always handle zero** in pluralization
3. **Group by feature** - `auth.login.title`, `auth.login.button`
4. **Extract strings early** - No hardcoded text in views
5. **Validate locales** - Use enum or whitelist

## Decision Guide

```
Translation task?
├── Basic string → __('key')
├── With variables → __('key', ['name' => $value])
├── Pluralization → trans_choice('key', $count)
├── In Blade → @lang('key') or {{ __('key') }}
├── Locale detection → Middleware
├── Format date/money → LocalizationService
└── Package strings → trans('package::key')
```

## Quick Reference

```php
// Basic translation
__('messages.welcome')

// With replacement
__('Hello :name', ['name' => 'John'])

// Pluralization
trans_choice('messages.items', $count)

// Runtime locale
App::setLocale('fr');
App::currentLocale();  // 'fr'
```

## Best Practices

### DO
- Use `:placeholder` for dynamic values
- Handle zero case in pluralization
- Group keys by feature module
- Use Locale enum for type safety
- Set Carbon locale in middleware

### DON'T
- Concatenate translated strings
- Hardcode text in views
- Accept any locale without validation
- Create DB-based translations (use files)

## Translation Files

### PHP Lang Files

`lang/en/messages.php`:
```php
<?php

return [
    'welcome' => 'Welcome to our application',
    'goodbye' => 'Goodbye, :name',
    'items' => '{0} No items|{1} One item|[2,*] :count items',
];
```

### JSON Lang Files

`lang/en.json`:
```json
{
    "Welcome to our application": "Welcome to our application",
    "Goodbye, :name": "Goodbye, :name",
    "No items|One item|:count items": "No items|One item|:count items"
}
```

## Blade Translations

```blade
{{ __('messages.welcome') }}

@lang('messages.welcome')

{{ __('Hello :name', ['name' => $user->name]) }}
```

## Pluralization

```php
trans_choice('messages.items', 0);   // No items
trans_choice('messages.items', 1);   // One item
trans_choice('messages.items', 5);   // 5 items
```

Lang file with zero handling:
```php
'items' => '{0} No items|{1} One item|[2,*] :count items',
```

## Middleware

`app/Http/Middleware/SetLocale.php`:
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (in_array($locale, config('app.available_locales', ['en']), true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
```

Register in `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \App\Http\Middleware\SetLocale::class,
    ]);
})
```

## Locale-Aware Routes

```php
Route::middleware(['web', 'setLocale'])->prefix('{locale}')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
```

## Locale Enum

```php
<?php

namespace App\Enums;

enum Locale: string
{
    case English = 'en';
    case French = 'fr';
    case Spanish = 'es';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
```

## Localization Service

```php
<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class LocalizationService
{
    public function setLocale(string $locale): void
    {
        App::setLocale($locale);
        Carbon::setLocale($locale);
    }

    public function formatCurrency(float $amount, string $currency = 'USD'): string
    {
        return Number::currency($amount, $currency);
    }

    public function formatDate(Carbon $date, string $format = 'short'): string
    {
        return match ($format) {
            'short' => $date->isoFormat('L'),
            'long' => $date->isoFormat('LL'),
            'full' => $date->isoFormat('LLLL'),
            default => $date->isoFormat($format),
        };
    }
}
```

## Queued Jobs

`Context::add('locale', $locale)` propagates to queued jobs automatically in Laravel 13. No manual retrieval needed in most cases.

```php
// In middleware
Context::add('locale', App::currentLocale());

// In job (if needed explicitly)
public function handle(): void
{
    $locale = Context::get('locale', config('app.locale'));
    App::setLocale($locale);

    // Send localized notification...
}
```

## Package Translations

```php
// Override vendor translations
php artisan vendor:publish --tag=lang

// In code
trans('package::messages.welcome')
```

## Validation

```php
// Translate validation attributes
'attributes' => [
    'email' => 'email address',
],

// In lang/en/validation.php
```

## Checklist

- [ ] All user-facing text uses `__()` or `@lang()`
- [ ] Zero case handled in pluralization
- [ ] Locale validated against whitelist/enum
- [ ] Carbon locale set in middleware
- [ ] Translation files grouped by feature
- [ ] No string concatenation in views
- [ ] Package translations published if overridden
