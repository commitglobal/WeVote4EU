<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PartnersPageTest extends TestCase
{
    public function test_it_redirects_to_the_default_locale(): void
    {
        $this->get('/partners')
            ->assertRedirect('/' . config('app.fallback_locale') . '/partners');
    }

    #[DataProvider('languages')]
    public function test_it_can_view_the_partners_page_in(string $language)
    {
        $this->get("/{$language}/partners")
            ->assertOk()
            ->assertSeeText(__('partners.title'))
            ->assertDontSee('partners.title');
    }
}
