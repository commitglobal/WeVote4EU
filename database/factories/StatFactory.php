<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\StatKey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stat>
 */
class StatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->unique()->randomElement(StatKey::values()),
            'value' => fake()->numberBetween(0, 100_000_000),
            'enabled' => fake()->boolean(75),
        ];
    }
}
