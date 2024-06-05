<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function nameWithTitle(): Attribute
    {
        return Attribute::make(
            get: fn () => collect([
                $this->name, $this->title,
            ])
                ->filter()
                ->join(' // ')
        );
    }
}
