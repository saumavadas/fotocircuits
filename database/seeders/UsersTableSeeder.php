<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Mr Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
//            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    
        Role::create(['name' => 'Staff']);
        Role::create(['name' => 'OfficeAdmin']);
        Role::create(['name' => 'Seller']);
        Role::create(['name' => 'Customer']);
    }
}
