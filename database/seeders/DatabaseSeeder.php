<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ElectionDay;
use App\Models\Post;
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

        $electionDays = ElectionDay::factory()
            ->count(4)
            ->create();

        User::factory()
            ->count(10)
            ->create()
            ->each(function (User $user) use ($electionDays) {
                Post::factory()
                    ->count(5)
                    ->recycle($user)
                    ->recycle($electionDays->random())
                    ->create();
            });
    }
}
