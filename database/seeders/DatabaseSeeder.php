<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\StatKey;
use App\Models\Author;
use App\Models\ElectionDay;
use App\Models\Expert;
use App\Models\Institution;
use App\Models\Post;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(['email' => 'admin@example.com'])
            ->admin()
            ->create();

        Institution::factory()
            ->count(12)
            ->create();

        Expert::factory()
            ->count(3)
            ->create();

        $electionDays = ElectionDay::factory()
            ->count(4)
            ->create();

        Stat::factory()
            ->count(\count(StatKey::values()))
            ->create();

        Author::factory()
            ->count(10)
            ->create()
            ->each(function (Author $author) use ($electionDays) {
                Post::factory()
                    ->count(5)
                    ->recycle($author)
                    ->recycle($electionDays->random())
                    ->create();
            });
    }
}
