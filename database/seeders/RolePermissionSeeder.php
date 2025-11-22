<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Settings
            'view settings',
            'edit settings',
            
            // Reports
            'view reports',
            'create reports',
            'export reports',
            
            // Analytics
            'view analytics',
            
            // System
            'manage roles',
            'manage permissions',
            'view logs',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // SuperAdmin - Full access
        $superAdmin = Role::create(['name' => 'SuperAdmin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - Most access except system management
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view settings',
            'edit settings',
            'view reports',
            'create reports',
            'export reports',
            'view analytics',
            'view logs',
        ]);

        // Employee - Limited access
        $employee = Role::create(['name' => 'Employee']);
        $employee->givePermissionTo([
            'view users',
            'view settings',
            'view reports',
            'create reports',
            'view analytics',
        ]);

        // Public - Read-only access
        $public = Role::create(['name' => 'Public']);
        $public->givePermissionTo([
            'view reports',
            'view analytics',
        ]);

        // Guest - Minimal access
        $guest = Role::create(['name' => 'Guest']);
        $guest->givePermissionTo([
            'view reports',
        ]);

        $this->command->info('Roles and permissions created successfully!');
    }
}
