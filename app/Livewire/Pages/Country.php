<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Vite;
use Livewire\Component;

class Country extends Component
{
    public string $country;

    public ?string $step = null;

    public function mount(string $country, ?string $step = null)
    {
        $this->country = $country;
        $this->step = $step;
    }

    public function render()
    {
        $country = $this->loadCountry();

        abort_unless($country, 404);

        seo()
            ->title(__("countries.{$country['code']}"))
            ->image(Vite::asset("resources/images/cards/{$country['code']}.png"));

        return view('livewire.pages.country', [
            'code' => $country['code'],
            'date' => $this->formatDate($country),
            'languages' => collect(app('languages'))
                ->reject(fn ($config, $code) => ! \in_array($code, $country['languages'])),
            'items' => collect(data_get($country, 'steps')),
        ]);
    }

    protected function loadCountry(): ?Collection
    {
        $file = resource_path("trees/{$this->country}.json");

        if (! File::exists($file)) {
            return null;
        }

        return collect(File::json($file));
    }

    protected function formatDate(Collection $country): string
    {
        $dates = collect($country->get('dates', []))
            ->filter()
            ->map(fn ($date) => CarbonImmutable::parse($date));

        if (\count($dates) === 1) {
            return $dates->first()->isoFormat('D MMMM YYYY');
        }

        return \sprintf('%s–%s', $dates->first()->isoFormat('D'), $dates->last()->isoFormat('D MMMM YYYY'));
    }
}
