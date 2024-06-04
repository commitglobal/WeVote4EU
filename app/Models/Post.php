<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\Publishable;
use App\Enums\Country;
use App\Events\AnnouncePost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Publishable;

    protected $fillable = [
        'title',
        'content',
        'embeds',
        'author_id',
        'country',
        'election_day_id',
    ];

    protected function casts(): array
    {
        return [
            'country' => Country::class,
            'embeds' => 'collection',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->fit(Fit::Crop, 200, 200)
                    ->keepOriginalImageFormat()
                    ->optimize()
                    ->extractVideoFrameAtSecond(20);
            });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function electionDay(): BelongsTo
    {
        return $this->belongsTo(ElectionDay::class);
    }

    protected static function booted(): void
    {
        static::created(function (Post $post) {
            if ($post->published_at?->isPast()) {
                AnnouncePost::dispatch($post->id);
            }
        });

        static::updated(function (Post $post) {
            if ($post->isDirty('published_at') && $post->published_at?->isPast()) {
                AnnouncePost::dispatch($post->id);
            }
        });

        static::deleted(function (Post $post) {
            AnnouncePost::dispatch($post->id);
        });
    }
}
