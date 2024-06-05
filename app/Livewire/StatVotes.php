<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Stat;
use Livewire\Attributes\Computed;
use Livewire\Component;

class StatVotes extends Component
{
    protected $listeners = [
        'echo:stats,UpdateStats' => '$refresh',
    ];

    #[Computed]
    public function stat(): ?array
    {
        return Stat::query()
            ->where('enabled', true)
            ->where('key', 'votes')
            ->first()
            ?->toArray();
    }
}
