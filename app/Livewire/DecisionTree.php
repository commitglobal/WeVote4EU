<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DecisionTree extends Component
{
    public ?string $country = null;

    public function mount(?string $country = null)
    {
        $this->country = $country;
    }

    public function render()
    {
        return view('livewire.decision-tree', [
            'items' => $this->getCountry(),
        ]);
    }

    public function getCountry()
    {
        $file = "countries/{$this->country}.json";

        if (! Storage::exists($file)) {
            return null;
        }

        return collect(Storage::json($file));
    }
}
