<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class NewsFeedUpdater extends Component
{
    public bool $banner = false;

    protected $listeners = [
        'echo:newsfeed,AnnouncePost' => 'showBanner',
        'reload' => '$refresh',
    ];

    public function showBanner(): void
    {
        $this->banner = true;
    }

    public function render()
    {
        return view('livewire.news-feed-updater');
    }

    public function reload(): void
    {
        $this->dispatch('reload');
        $this->banner = false;
    }
}
