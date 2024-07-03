<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Enums\ExpertLink;
use App\Models\Expert;
use App\Models\Institution;
use Illuminate\Support\Str;
use Livewire\Component;

class Partners extends Component
{
    public function render()
    {
        seo()
            ->title(__('partners.title'))
            ->description(__('partners.intro_1'));

        return view('livewire.pages.partners', [
            'institutions' => $this->getInstitutions(),
            'experts' => $this->getExperts(),
        ]);
    }

    protected function getInstitutions(): array
    {
        return Institution::query()
            ->where('enabled', true)
            ->orderBy('order')
            ->with('media')
            ->get()
            ->map(fn (Institution $institution) => [
                'name' => $institution->name,
                'logo' => $institution->getFirstMediaUrl('logo'),
                'url' => $institution->url,
            ])
            ->all();
    }

    protected function getExperts(): array
    {
        return Expert::query()
            ->where('enabled', true)
            ->orderBy('order')
            ->with('media')
            ->get()
            ->map(fn (Expert $expert) => [
                'name' => $expert->name,
                'title' => $expert->title,
                'country' => $expert->country?->label(),
                'avatar' => $expert->getFirstMediaUrl('avatar', 'large'),
                'links' => collect($expert->links)
                    ->map(fn (array $link) => [
                        'url' => $link['url'],
                        'title' => Str::ucfirst($link['type']),
                        'icon' => match (ExpertLink::tryFrom($link['type'])) {
                            ExpertLink::FACEBOOK => 'ri-facebook-box-fill',
                            ExpertLink::LINKEDIN => 'ri-linkedin-box-fill',
                            ExpertLink::TWITTER => 'ri-twitter-x-line',
                            ExpertLink::WEBSITE => 'ri-global-line',
                            default => 'ri-link',
                        },
                    ]),
            ])
            ->all();
    }
}
