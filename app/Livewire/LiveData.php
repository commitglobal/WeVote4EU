<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class LiveData extends Component
{
    public function render()
    {
        return view('livewire.live-data', [
            'counters' => [
                'observers' => 10,
                'polling_stations' => 100,
                'started_forms' => 50,
                'questions_answered' => 1000,
                'flagged_answers' => 10,
            ],
        ]);
    }
}
