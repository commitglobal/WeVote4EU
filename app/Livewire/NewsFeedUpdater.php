<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class NewsFeedUpdater extends Component
{
    public bool $visible = false;

    protected $listeners = [
        'echo:newsfeed,UpdateNewsFeed' => 'open',
    ];

    public function open(): void
    {
        $this->visible = true;
    }
}
