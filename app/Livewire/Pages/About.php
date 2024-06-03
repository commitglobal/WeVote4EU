<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        seo()
            ->title(__('about.title'))
            ->description(__('about.intro_1'));

        return view('livewire.pages.about');
    }
}
