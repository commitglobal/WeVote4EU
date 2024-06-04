<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Livewire\Wireable;

readonly class NewsFeedItemAuthor implements Wireable
{
    public function __construct(
        public string $name,
        public string $avatar,
    ) {
        //
    }

    public function toLivewire(): array
    {
        return [
            'name' => $this->name,
            'avatar' => $this->avatar,
        ];
    }

    public static function fromLivewire($value): static
    {
        return new static(...$value);
    }
}
