<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;

class Terms extends Component
{
    public function render()
    {
        seo()
            ->title(__('terms.title'))
            ->description(__('terms.intro'));

        return view('livewire.pages.terms');
    }
}
