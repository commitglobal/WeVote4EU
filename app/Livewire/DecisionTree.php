<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\File;
use Livewire\Component;

class DecisionTree extends Component
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
        $file = resource_path("trees/{$this->country}.json");

        return view('livewire.decision-tree', [
            'items' => collect(
                File::exists($file)
                    ? collect(File::json($file))
                    : null
            ),
        ]);
    }
}
