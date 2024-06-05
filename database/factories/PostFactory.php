<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Country;
use App\Models\Author;
use App\Models\ElectionDay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => Author::factory(),
            'election_day_id' => ElectionDay::factory(),

            'title' => fake()->sentence(),
            'content' => collect(fake()->paragraphs(3))
                ->map(fn (string $paragraph) => "<p>{$paragraph}</p>")
                ->join(''),
            'country' => fake()->randomElement(Country::values()),
            'published_at' => fake()->boolean(95) ? fake()->dateTimeThisYear() : null,
            'embeds' => [],
        ];
    }
}
