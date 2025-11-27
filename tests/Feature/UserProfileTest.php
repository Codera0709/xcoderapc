<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_their_profile()
    {
        $user = User::factory()->create();
        $profile = UserProfile::create([
            'user_id' => $user->id,
            'bio' => 'Test Bio',
            'username' => 'testuser',
        ]);

        Sanctum::actingAs($user);
        $response = $this->getJson('/api/profile');

        $response->assertStatus(200)
            ->assertJsonPath('user.profile.bio', 'Test Bio')
            ->assertJsonPath('user.profile.username', 'testuser');
    }

    public function test_user_can_update_their_profile()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
        $response = $this->putJson('/api/profile', [
            'bio' => 'Updated Bio',
            'username' => 'updateduser',
            'theme' => 'dark',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('message', 'Profile updated successfully.')
            ->assertJsonPath('user.profile.bio', 'Updated Bio')
            ->assertJsonPath('user.profile.theme', 'dark');

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
            'bio' => 'Updated Bio',
            'username' => 'updateduser',
            'theme' => 'dark',
        ]);
    }

    public function test_profile_update_validation()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
        $response = $this->putJson('/api/profile', [
            'username' => 'invalid user name', // alpha_dash
            'theme' => 'invalid_theme', // in:light,dark,auto
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['username', 'theme']);
    }

    public function test_username_must_be_unique()
    {
        $user1 = User::factory()->create();
        UserProfile::create(['user_id' => $user1->id, 'username' => 'taken']);

        $user2 = User::factory()->create();

        Sanctum::actingAs($user2);
        $response = $this->putJson('/api/profile', [
            'username' => 'taken',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['username']);
    }
}
