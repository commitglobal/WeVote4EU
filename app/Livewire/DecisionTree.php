<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\File;
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
        $file = resource_path("trees/{$this->country}.json");

        if (! File::exists($file)) {
            return null;
        }

        return collect(File::json($file));
    }
}
