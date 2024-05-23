<?php

declare(strict_types=1);

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_it_redirects_to_the_default_locale(): void
    {
        $this->get('/')
            ->assertRedirect('/' . config('app.fallback_locale'));
    }

    #[DataProvider('languages')]
    public function test_it_can_view_the_home_page_in(string $language)
    {
        $this->get("/{$language}")
            ->assertStatus(200);
    }
}
