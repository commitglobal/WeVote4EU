<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatKey;
use App\Events\UpdateStats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Number;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'enabled',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'key' => StatKey::class,
            'value' => 'integer',
            'enabled' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key->value,
            'label' => $this->key->label(),
            'value' => Number::format($this->value, locale: App::getLocale()),
        ];
    }

    protected static function booted(): void
    {
        static::created(function (self $stat) {
            UpdateStats::dispatch();
        });

        static::updated(function (self $stat) {
            UpdateStats::dispatch();
        });

        static::deleted(function (self $stat) {
            UpdateStats::dispatch();
        });
    }
}
