<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public ?string $country = null;

    public function mount(?string $country = null)
    {
        $this->country = $country;
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
