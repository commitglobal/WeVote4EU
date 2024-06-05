<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Stat;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LiveData extends Component
{
    protected $listeners = [
        'echo:stats,UpdateStats' => '$refresh',
    ];

    #[Computed]
    public function stats(): array
    {
        return Stat::query()
            ->where('enabled', true)
            ->whereNot('key', 'votes')
            ->orderBy('order')
            ->get()
            ->toArray();
    }

    #[Computed]
    protected function count(): int
    {
        return \count($this->stats);
    }

    public function gridColumns(): string
    {
        return match ($this->count()) {
            1 => 'sm:grid-cols-1',
            2, 4 => 'sm:grid-cols-2',
            3 => 'sm:grid-cols-3',
            default => 'sm:grid-cols-6',
        };
    }
}
