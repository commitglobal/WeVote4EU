<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;

class Partners extends Component
{
    public function render()
    {
        seo()
            ->title(__('partners.title'))
            ->description(__('partners.intro_1'));

        return view('livewire.pages.partners', [
            'partners' => $this->getPartners(),
            'experts' => $this->getExperts(),
        ]);
    }

    protected function getPartners(): array
    {
        return [
            [
                'name' => 'Partner A',
                'logo' => 'placeholder.svg',
                'url' => 'https://example.com',
            ],
            [
                'name' => 'Partner B',
                'logo' => 'placeholder.svg',
                'url' => 'https://example.org',
            ],
            [
                'name' => 'Partner C',
                'logo' => 'placeholder.svg',
                'url' => 'https://example.net',
            ],
            [
                'name' => 'Partner D',
                'logo' => 'placeholder.svg',
                'url' => 'https://example.com',
            ],
            [
                'name' => 'Partner E',
                'logo' => 'placeholder.svg',
            ],
        ];
    }

    protected function getExperts(): array
    {
        return [
            [
                'name' => 'Expert A',
                'title' => 'Electoral expert',
                'avatar' => 'placeholder.jpg',
                'links' => [
                    'ri-facebook-fill' => '#',
                    'ri-twitter-x-fill' => '#',
                ],
            ],
            [
                'name' => 'Expert B',
                'title' => 'Electoral expert',
                'avatar' => 'placeholder.jpg',
                'links' => [

                ],
            ],
            [
                'name' => 'Expert C',
                'title' => 'Electoral expert',
                'avatar' => 'placeholder.jpg',
                'links' => [

                ],
            ],
        ];
    }
}
