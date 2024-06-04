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
                'name' => 'Expert Forum (EFOR)',
                'logo' => 'EFOR.png',
                'url' => 'https://expertforum.ro/en/',
            ],
            [
                'name' => 'Gender Concerns International',
                'logo' => 'Gender-Concerns-International.png',
                'url' => 'https://www.genderconcerns.org/',
            ],
            [
                'name' => 'Institute for Public Environment Development (IPED)',
                'logo' => 'IPED.png',
                'url' => 'https://iped.bg/en/',
            ],
            [
                'name' => 'Inter Alia',
                'logo' => 'Inter-Alia.png',
                'url' => 'https://interaliaproject.com/',
            ],
            [
                'name' => 'Committee for the Defence of Democracy (CDD)',
                'logo' => 'KOD.png',
                'url' => 'https://ruchkod.pl/',
            ],
        ];
    }

    protected function getExperts(): array
    {
        return [
            [
                'name' => 'Maria Krause',
                // 'title' => 'Electoral expert',
                'avatar' => 'placeholder.jpg',
                'links' => [
                    [
                        'icon' => 'ri-linkedin-fill',
                        'url' => '#',
                        'title' => 'LinkedIn',
                    ],
                    [
                        'icon' => 'ri-facebook-fill',
                        'url' => '#',
                        'title' => 'Facebook',
                    ],
                    [
                        'icon' => 'ri-twitter-x-fill',
                        'url' => '#',
                        'title' => 'Twitter',
                    ],
                ],
            ],
            [
                'name' => 'Christoforos Christoforou',
                // 'title' => 'Electoral expert',
                'avatar' => 'placeholder.jpg',
                'links' => [

                ],
            ],
            [
                'name' => 'Sabra Bano',
                // 'title' => 'Electoral expert',
                'avatar' => 'placeholder.jpg',
                'links' => [

                ],
            ],
        ];
    }
}
