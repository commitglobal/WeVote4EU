<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PagesTest extends TestCase
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

    #[DataProvider('languages')]
    public function test_it_can_view_the_about_page_in(string $language)
    {
        $this->get("/{$language}/about")
            ->assertStatus(200);
    }

    #[DataProvider('languages')]
    public function test_it_can_view_the_privacy_page_in(string $language)
    {
        $this->get("/{$language}/privacy")
            ->assertStatus(200);
    }

    #[DataProvider('languages')]
    public function test_it_can_view_the_terms_page_in(string $language)
    {
        $this->get("/{$language}/terms")
            ->assertStatus(200);
    }
}
