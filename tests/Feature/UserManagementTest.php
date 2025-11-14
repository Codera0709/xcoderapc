<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that authenticated user can view users page.
     */
    public function test_authenticated_user_can_view_users_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/users');

        $response->assertStatus(200);
    }

    /**
     * Test that authenticated user can create a new user.
     */
    public function test_authenticated_user_can_create_user(): void
    {
        $adminUser = User::factory()->create();
        $this->actingAs($adminUser);

        $response = $this->post('/users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'role' => 'viewer',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/users');
        
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'name' => 'John Doe',
            'role' => 'viewer',
        ]);
    }

    /**
     * Test that authenticated user can update a user.
     */
    public function test_authenticated_user_can_update_user(): void
    {
        $adminUser = User::factory()->create();
        $this->actingAs($adminUser);

        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'role' => 'viewer',
        ]);

        $response = $this->put("/users/{$user->id}", [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'janesmith@example.com',
            'role' => 'editor',
        ]);

        $response->assertRedirect('/users');
        
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'role' => 'editor',
        ]);
    }

    /**
     * Test that authenticated user can delete a user.
     */
    public function test_authenticated_user_can_delete_user(): void
    {
        $adminUser = User::factory()->create();
        $this->actingAs($adminUser);

        $user = User::factory()->create();
        
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);

        $response = $this->delete("/users/{$user->id}");

        $response->assertRedirect('/users');
        
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * Test validation for user creation.
     */
    public function test_validation_for_user_creation(): void
    {
        $adminUser = User::factory()->create();
        $this->actingAs($adminUser);

        $response = $this->post('/users', [
            'first_name' => '', // required
            'last_name' => '', // required
            'email' => 'invalid-email', // invalid email
            'role' => 'invalid-role', // not in list
            'password' => '123', // too short
            'password_confirmation' => 'different', // does not match
        ]);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'role', 'password']);
    }
}
