<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call([
            RolePermissionSeeder::class,
            PersonSeeder::class,
        ]);

        // Create default users with roles
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);
        $superAdmin->assignRole('SuperAdmin');

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('Admin');

        $employee = User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
        ]);
        $employee->assignRole('Employee');

        $public = User::factory()->create([
            'name' => 'Public User',
            'email' => 'public@example.com',
        ]);
        $public->assignRole('Public');

        $guest = User::factory()->create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
        ]);
        $guest->assignRole('Guest');
    }
}
