<?php

declare(strict_types=1);

namespace Tests\Feature;

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
            ->assertOk()
            ->assertSeeInOrder([
                __('app.hero.title'),
                __('app.hero.name'),
                __('app.hero.description'),
            ])
            ->assertDontSee([
                'app.hero.title',
                'app.hero.name',
                'app.hero.description',
            ]);
    }
}
