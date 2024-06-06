<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Enums\ExpertLink;
use App\Models\Expert;
use App\Models\Institution;
use Illuminate\Support\Facades\Vite;
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
        if (request()->boolean('alt')) {
            return Institution::query()
                ->where('enabled', true)
                ->orderBy('order')
                ->get()
                ->map(fn (Institution $institution) => [
                    'name' => $institution->name,
                    'logo' => $institution->getFirstMediaUrl('logo'),
                    'url' => $institution->url,
                ])
                ->all();
        }

        return [
            [
                'name' => 'Expert Forum (EFOR)',
                'logo' => Vite::asset('resources/images/partners/EFOR.png'),
                'url' => 'https://expertforum.ro/en/',
            ],
            [
                'name' => 'Gender Concerns International',
                'logo' => Vite::asset('resources/images/partners/Gender-Concerns-International.png'),
                'url' => 'https://www.genderconcerns.org/',
            ],
            [
                'name' => 'European Platform for Democratic Elections (EPDE)',
                'logo' => Vite::asset('resources/images/partners/EPDE.png'),
                'url' => 'https://epde.org/',
            ],
            [
                'name' => 'Institute for Public Environment Development (IPED)',
                'logo' => Vite::asset('resources/images/partners/IPED.png'),
                'url' => 'https://iped.bg/en/',
            ],
            [
                'name' => 'Inter Alia',
                'logo' => Vite::asset('resources/images/partners/Inter-Alia.png'),
                'url' => 'https://interaliaproject.com/',
            ],
            [
                'name' => 'Political Accountability Foundation (PAF)',
                'logo' => Vite::asset('resources/images/partners/PAF.png'),
                'url' => 'https://odpowiedzialnapolityka.pl/',
            ],
            [
                'name' => 'European Exchange',
                'logo' => Vite::asset('resources/images/partners/European-Exchange.png'),
                'url' => 'https://european-exchange.org/',
            ],
            [
                'name' => 'Danes je nov dan',
                'logo' => Vite::asset('resources/images/partners/Danes-je-nov-dan.png'),
                'url' => 'https://danesjenovdan.si/',
            ],
            [
                'name' => 'Committee for the Defence of Democracy (CDD)',
                'logo' => Vite::asset('resources/images/partners/KOD.png'),
                'url' => 'https://ruchkod.pl/',
            ],
            [
                'name' => 'Croatian Youth Network',
                'logo' => Vite::asset('resources/images/partners/MMH.png'),
                'url' => 'https://www.mmh.hr/',
            ],
            [
                'name' => 'Memo 98',
                'logo' => Vite::asset('resources/images/partners/MEMO98.png'),
                'url' => 'https://memo98.sk/',
            ],
            [
                'name' => 'Fórum 50 %',
                'logo' => Vite::asset('resources/images/partners/Forum-50.png'),
                'url' => 'https://padesatprocent.cz/cz/',
            ],
        ];
    }

    protected function getExperts(): array
    {
        if (request()->boolean('alt')) {
            return Expert::query()
                ->where('enabled', true)
                ->orderBy('order')
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

        return [
            [
                'name' => 'Maria Krause',
                'country' => __('countries.ro'),
                'avatar' => Vite::asset('resources/images/experts/Maria-Krause.jpg'),
                'links' => [

                ],
            ],
            [
                'name' => 'Christoforos Christoforou',
                'country' => __('countries.cy'),
                'avatar' => Vite::asset('resources/images/experts/Christoforos-Christoforou.png'),
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
                'country' => __('countries.nl'),
                'avatar' => Vite::asset('resources/images/experts/Sabra-Bano.jpg'),
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
