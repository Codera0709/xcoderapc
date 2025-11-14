<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalyticsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guest cannot access analytics page.
     */
    public function test_guest_cannot_access_analytics_page(): void
    {
        $response = $this->get('/analytics');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated user can access analytics page.
     */
    public function test_authenticated_user_can_access_analytics_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/analytics');

        $response->assertStatus(200);
    }
}
