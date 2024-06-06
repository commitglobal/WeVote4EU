<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expert>
 */
class ExpertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country' => fake()->randomElement(Country::values()),
            'enabled' => fake()->boolean(75),
        ];
    }
}
