<?php

declare(strict_types=1);

namespace App\View\Components\Site;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Header extends Component
{
    public Collection $alternateUrls;

    public function __construct()
    {
        $this->alternateUrls = $this->getAlternateUrls();
    }

    public function render(): View
    {
        return view('components.site.header');
    }

    private function getAlternateUrls(): Collection
    {
        $route = Route::currentRouteName();
        $parameters = request()->route()->parameters();

        $locales = collect(app('languages'));

        return locales()
            ->mapWithKeys(fn (array $config, string $locale) => [
                $locale => [
                    'url' => route($route, array_merge($parameters, ['locale' => $locale])),
                    'label' => $locales->get($locale)['nativeName'],
                ],
            ])
            ->filter();
    }
}
