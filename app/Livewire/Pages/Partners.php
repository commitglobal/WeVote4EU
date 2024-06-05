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
                'name' => 'European Platform for Democratic Elections (EPDE)',
                'logo' => 'EPDE.png',
                'url' => 'https://epde.org/',
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
                'name' => 'Political Accountability Foundation (PAF)',
                'logo' => 'PAF.png',
                'url' => 'https://odpowiedzialnapolityka.pl/',
            ],
            [
                'name' => 'European Exchange',
                'logo' => 'European-Exchange.png',
                'url' => 'https://european-exchange.org/',
            ],
            [
                'name' => 'Danes je nov dan',
                'logo' => 'Danes-je-nov-dan.png',
                'url' => 'https://danesjenovdan.si/',
            ],
            [
                'name' => 'Committee for the Defence of Democracy (CDD)',
                'logo' => 'KOD.png',
                'url' => 'https://ruchkod.pl/',
            ],
            [
                'name' => 'Croatian Youth Network',
                'logo' => 'MMH.png',
                'url' => 'https://www.mmh.hr/',
            ],
            [
                'name' => 'Memo 98',
                'logo' => 'MEMO98.png',
                'url' => 'https://memo98.sk/',
            ],
            [
                'name' => 'Fórum 50 %',
                'logo' => 'Forum-50.png',
                'url' => 'https://padesatprocent.cz/cz/',
            ],
        ];
    }

    protected function getExperts(): array
    {
        return [
            [
                'name' => 'Maria Krause',
                'title' => __('countries.ro'),
                'avatar' => 'Maria-Krause.jpg',
                'links' => [

                ],
            ],
            [
                'name' => 'Christoforos Christoforou',
                'title' => __('countries.cy'),
                'avatar' => 'Christoforos-Christoforou.png',
                'links' => [
                    [
                        'icon' => 'ri-global-line',
                        'url' => 'https://www.eklektor.org/',
                        'title' => 'Website',
                    ],
                ],
            ],
            [
                'name' => 'Sabra Bano',
                'title' => __('countries.nl'),
                'avatar' => 'Sabra-Bano.jpg',
                'links' => [
                    [
                        'icon' => 'ri-global-line',
                        'url' => 'https://www.genderconcerns.org/director/',
                        'title' => 'Website',
                    ],
                    [
                        'icon' => 'ri-linkedin-box-fill',
                        'url' => 'https://www.linkedin.com/in/sabra-bano-b4995311/',
                        'title' => 'LinkedIn',
                    ],
                    [
                        'icon' => 'ri-global-line',
                        'url' => 'https://genderchampions.com/champions/sabra-bano',
                        'title' => 'Website',
                    ],
                ],
            ],
        ];
    }
}
