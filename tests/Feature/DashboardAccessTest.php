<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guest cannot access dashboard.
     */
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated user can access dashboard.
     */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    /**
     * Test that guest cannot access users page.
     */
    public function test_guest_cannot_access_users_page(): void
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated user can access users page.
     */
    public function test_authenticated_user_can_access_users_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/users');

        $response->assertStatus(200);
    }

    /**
     * Test that authenticated user can access settings page.
     */
    public function test_authenticated_user_can_access_settings_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/settings');

        $response->assertStatus(200);
    }

    /**
     * Test that authenticated user can access reports page.
     */
    public function test_authenticated_user_can_access_reports_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/reports');

        $response->assertStatus(200);
    }
}
