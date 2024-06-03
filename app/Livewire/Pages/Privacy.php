<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;

class Privacy extends Component
{
    public function render()
    {
        seo()
            ->title(__('privacy.title'))
            ->description(__('privacy.intro_1'));

        return view('livewire.pages.privacy');
    }
}
