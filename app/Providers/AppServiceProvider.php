<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerCountries();
        $this->registerLanguages();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected function registerCountries(): void
    {
        $this->app->singleton(
            'countries',
            fn () => collect([
                'at' => 'austria',
                'be' => 'belgium',
                'bg' => 'bulgaria',
                'hr' => 'croatia',
                'cy' => 'cyprus',
                'cz' => 'czechia',
                'dk' => 'denmark',
                'ee' => 'estonia',
                'fi' => 'finland',
                'fr' => 'france',
                'de' => 'germany',
                'gr' => 'greece',
                'hu' => 'hungary',
                'ie' => 'ireland',
                'it' => 'italy',
                'lv' => 'latvia',
                'lt' => 'lithuania',
                'lu' => 'luxembourg',
                'mt' => 'malta',
                'nl' => 'netherlands',
                'pl' => 'poland',
                'pt' => 'portugal',
                'ro' => 'romania',
                'sk' => 'slovakia',
                'si' => 'slovenia',
                'es' => 'spain',
                'se' => 'sweden',
            ])
                ->map(fn (string $name, string $code) => [
                    'name' => $name,
                    'label' => __("countries.{$code}"),
                ])
                ->sortBy('label')
        );
    }

    protected function registerLanguages(): void
    {
        $this->app->singleton('languages', fn () => [
            'bg' => [
                'name' => 'Bulgarian',
                'nativeName' => 'Български',
                'enabled' => true,
            ],
            'hr' => [
                'name' => 'Croatian',
                'nativeName' => 'Hrvatski',
                'enabled' => true,
            ],
            'cs' => [
                'name' => 'Czech',
                'nativeName' => 'Čeština',
                'enabled' => true,
            ],
            'da' => [
                'name' => 'Danish',
                'nativeName' => 'Dansk',
                'enabled' => true,
            ],
            'nl' => [
                'name' => 'Dutch',
                'nativeName' => 'Nederlands',
                'enabled' => true,
            ],
            'en' => [
                'name' => 'English',
                'nativeName' => 'English',
                'enabled' => true,
            ],
            'et' => [
                'name' => 'Estonian',
                'nativeName' => 'Eesti',
                'enabled' => true,
            ],
            'fi' => [
                'name' => 'Finnish',
                'nativeName' => 'Suomi',
                'enabled' => true,
            ],
            'fr' => [
                'name' => 'French',
                'nativeName' => 'Français',
                'enabled' => true,
            ],
            'de' => [
                'name' => 'German',
                'nativeName' => 'Deutsch',
                'enabled' => true,
            ],
            'el' => [
                'name' => 'Greek',
                'nativeName' => 'Ελληνικά',
                'enabled' => true,
            ],
            'hu' => [
                'name' => 'Hungarian',
                'nativeName' => 'Magyar',
                'enabled' => true,
            ],
            'ga' => [
                'name' => 'Irish',
                'nativeName' => 'Gaeilge',
                'enabled' => true,
            ],
            'it' => [
                'name' => 'Italian',
                'nativeName' => 'Italiano',
                'enabled' => true,
            ],
            'lv' => [
                'name' => 'Latvian',
                'nativeName' => 'Latviešu',
                'enabled' => true,
            ],
            'lt' => [
                'name' => 'Lithuanian',
                'nativeName' => 'Lietuvių',
                'enabled' => true,
            ],
            'mt' => [
                'name' => 'Maltese',
                'nativeName' => 'Malti',
                'enabled' => true,
            ],
            'pl' => [
                'name' => 'Polish',
                'nativeName' => 'Polski',
                'enabled' => true,
            ],
            'pt' => [
                'name' => 'Portuguese',
                'nativeName' => 'Português',
                'enabled' => true,
            ],
            'ro' => [
                'name' => 'Romanian',
                'nativeName' => 'Română',
                'enabled' => true,
            ],
            'sk' => [
                'name' => 'Slovak',
                'nativeName' => 'Slovenčina',
                'enabled' => true,
            ],
            'sl' => [
                'name' => 'Slovene',
                'nativeName' => 'Slovenščina',
                'enabled' => true,
            ],
            'es' => [
                'name' => 'Spanish',
                'nativeName' => 'Español',
                'enabled' => true,
            ],
            'sv' => [
                'name' => 'Swedish',
                'nativeName' => 'Svenska',
                'enabled' => true,
            ],
        ]);
    }
}
