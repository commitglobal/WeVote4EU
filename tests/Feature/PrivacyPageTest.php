<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PrivacyPageTest extends TestCase
{
    public function test_it_redirects_to_the_default_locale(): void
    {
        $this->get('/privacy')
            ->assertRedirect('/' . config('app.fallback_locale') . '/privacy');
    }

    #[DataProvider('languages')]
    public function test_it_can_view_the_privacy_page_in(string $language)
    {
        $this->get("/{$language}/privacy")
            ->assertOk()
            ->assertSeeText(__('privacy.title'))
            ->assertDontSee('privacy.title');
    }
}
