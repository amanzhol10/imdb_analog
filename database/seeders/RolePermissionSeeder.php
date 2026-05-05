<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create movies', 'edit movies', 'delete movies',
            'create reviews', 'edit reviews', 'delete reviews',
            'manage users', 'view analytics'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        
        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['create movies', 'edit movies', 'delete movies', 'edit reviews', 'delete reviews']);

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo(['create movies', 'edit movies', 'create reviews']);

        $writer = Role::create(['name' => 'writer']);
        $writer->givePermissionTo(['create reviews', 'edit reviews']);
    }
}