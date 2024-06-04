<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Livewire\Wireable;

readonly class NewsFeedItemMedia implements Wireable
{
    public function __construct(
        public string $name,
        public string $url,
        public string $thumb,
    ) {
        //
    }

    public function toLivewire(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'thumbs' => $this->thumb,
        ];
    }

    public static function fromLivewire($value): static
    {
        return new static(...$value);
    }
}
