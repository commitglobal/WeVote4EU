<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TermsPageTest extends TestCase
{
    public function test_it_redirects_to_the_default_locale(): void
    {
        $this->get('/terms')
            ->assertRedirect('/' . config('app.fallback_locale') . '/terms');
    }

    #[DataProvider('languages')]
    public function test_it_can_view_the_terms_page_in(string $language)
    {
        $this->get("/{$language}/terms")
            ->assertOk()
            ->assertSeeText(__('terms.title'))
            ->assertDontSee('terms.title');
    }
}
