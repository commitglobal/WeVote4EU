<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

function locales(): Collection
{
    return collect(app('languages'))
        ->reject(fn (array $language) => ! $language['enabled']);
}

function localizedRoute($name, array $parameters = [], ?string $locale = null, bool $absolute = true): string
{
    $parameters['locale'] = $locale ?? App::getLocale();

    return route($name, $parameters, $absolute);
}
