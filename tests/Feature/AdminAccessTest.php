<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_accessing_dashboard(): void
    {
        $response = $this->get($this->adminUrl('/dashboard'));

        $response->assertRedirect($this->adminUrl('/login'));
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_resource(): void
    {
        $response = $this->get($this->adminUrl('/projects'));

        $response->assertRedirect($this->adminUrl('/login'));
    }

    public function test_authenticated_verified_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get($this->adminUrl('/dashboard'));

        $response->assertOk();
    }
}
