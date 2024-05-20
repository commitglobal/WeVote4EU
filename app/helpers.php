<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

if (! function_exists('locales')) {
    function locales(): Collection
    {
        return collect(app('languages'))
            ->reject(fn (array $language) => ! $language['enabled']);
    }
}

if (! function_exists('currentLocale')) {
    function currentLocale(): ?array
    {
        return collect(app('languages'))
            ->get(App::getLocale());
    }
}

if (! function_exists('localizedRoute')) {
    function localizedRoute($name, array $parameters = [], ?string $locale = null, bool $absolute = true): string
    {
        $parameters['locale'] = $locale ?? App::getLocale();

        return route($name, $parameters, $absolute);
    }
}
