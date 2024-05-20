<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public ?string $country = null;

    public ?string $step = null;

    public function mount(?string $country = null, ?string $step = null)
    {
        $this->country = $country;
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
