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
        $this->app->singleton('languages', fn () => [
            'bg' => [
                'name' => 'Bulgarian',
                'nativeName' => 'Български',
                'enabled' => false,
            ],
            'hr' => [
                'name' => 'Croatian',
                'nativeName' => 'Hrvatski',
                'enabled' => false,
            ],
            'cs' => [
                'name' => 'Czech',
                'nativeName' => 'Čeština',
                'enabled' => false,
            ],
            'da' => [
                'name' => 'Danish',
                'nativeName' => 'Dansk',
                'enabled' => false,
            ],
            'nl' => [
                'name' => 'Dutch',
                'nativeName' => 'Nederlands',
                'enabled' => false,
            ],
            'en' => [
                'name' => 'English',
                'nativeName' => 'English',
                'enabled' => true,
            ],
            'et' => [
                'name' => 'Estonian',
                'nativeName' => 'Eesti',
                'enabled' => false,
            ],
            'fi' => [
                'name' => 'Finnish',
                'nativeName' => 'Suomi',
                'enabled' => false,
            ],
            'fr' => [
                'name' => 'French',
                'nativeName' => 'Français',
                'enabled' => false,
            ],
            'de' => [
                'name' => 'German',
                'nativeName' => 'Deutsch',
                'enabled' => false,
            ],
            'el' => [
                'name' => 'Greek',
                'nativeName' => 'Ελληνικά',
                'enabled' => false,
            ],
            'hu' => [
                'name' => 'Hungarian',
                'nativeName' => 'Magyar',
                'enabled' => false,
            ],
            'ga' => [
                'name' => 'Irish',
                'nativeName' => 'Gaeilge',
                'enabled' => false,
            ],
            'it' => [
                'name' => 'Italian',
                'nativeName' => 'Italiano',
                'enabled' => false,
            ],
            'lv' => [
                'name' => 'Latvian',
                'nativeName' => 'Latviešu',
                'enabled' => false,
            ],
            'lt' => [
                'name' => 'Lithuanian',
                'nativeName' => 'Lietuvių',
                'enabled' => false,
            ],
            'mt' => [
                'name' => 'Maltese',
                'nativeName' => 'Malti',
                'enabled' => false,
            ],
            'pl' => [
                'name' => 'Polish',
                'nativeName' => 'polPolskiski',
                'enabled' => false,
            ],
            'pt' => [
                'name' => 'Portuguese',
                'nativeName' => 'Português',
                'enabled' => false,
            ],
            'ro' => [
                'name' => 'Romanian',
                'nativeName' => 'Română',
                'enabled' => false,
            ],
            'sk' => [
                'name' => 'Slovak',
                'nativeName' => 'Slovenčina',
                'enabled' => false,
            ],
            'sl' => [
                'name' => 'Slovene',
                'nativeName' => 'Slovenščina',
                'enabled' => false,
            ],
            'es' => [
                'name' => 'Spanish',
                'nativeName' => 'Español',
                'enabled' => false,
            ],
            'sv' => [
                'name' => 'Swedish',
                'nativeName' => 'Svenska',
                'enabled' => false,
            ],
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
