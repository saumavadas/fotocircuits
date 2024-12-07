<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user_access',
            'user_create',
            'user_edit',
            'user_delete',
            'role_access',
            'role_create',
            'role_edit',
            'role_delete',
            'permission_access',
            'permission_create',
            'permission_edit',
            'permission_delete',
            'categories_access',
            'categories_create',
            'categories_edit',
            'categories_delete',
            'media_access',
            'media_create',
            'media_edit',
            'media_delete',
            'frontend_access'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
