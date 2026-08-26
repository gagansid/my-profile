<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_is_reachable_when_site_is_public(): void
    {
        SiteSetting::current()->update(['is_site_public' => true]);

        $response = $this->get($this->publicUrl('/'));

        $response->assertOk();
    }

    public function test_maintenance_page_is_shown_when_site_is_not_public(): void
    {
        SiteSetting::current()->update([
            'is_site_public' => false,
            'maintenance_message' => 'Sedang dalam perbaikan.',
        ]);

        $response = $this->get($this->publicUrl('/'));

        $response->assertStatus(503);
        $response->assertSee('Sedang dalam perbaikan.');
    }

    public function test_admin_panel_stays_reachable_when_site_is_not_public(): void
    {
        SiteSetting::current()->update(['is_site_public' => false]);

        $response = $this->get($this->adminUrl('/login'));

        $response->assertOk();
    }
}
