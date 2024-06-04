<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Livewire\Wireable;

readonly class NewsFeedItemEmbed implements Wireable
{
    public function __construct(
        public string $html,
    ) {
        //
    }

    public function toLivewire(): array
    {
        return [
            'html' => $this->html,
        ];
    }

    public static function fromLivewire($value): static
    {
        return new static(...$value);
    }
}
