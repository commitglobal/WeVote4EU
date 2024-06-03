<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    public function test_it_redirects_to_the_default_locale(): void
    {
        $this->get('/about')
            ->assertRedirect('/' . config('app.fallback_locale') . '/about');
    }

    #[DataProvider('languages')]
    public function test_it_can_view_the_about_page_in(string $language)
    {
        $this->get("/{$language}/about")
            ->assertOk()
            ->assertSeeText(__('about.title'))
            ->assertDontSee('about.title');
    }
}
