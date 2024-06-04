<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Livewire\Wireable;

readonly class NewsFeedItem implements Wireable
{
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
        public Carbon $publishedAt,
        public NewsFeedItemAuthor $author,
        public array $embeds = [],
        public array $media = [],
    ) {
        //
    }

    public function toLivewire(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'publishedAt' => $this->publishedAt,
            'author' => $this->author,
            'embeds' => $this->embeds,
            'media' => $this->media,
        ];
    }

    public static function fromLivewire($value): static
    {
        return new static(...$value);
    }
}
