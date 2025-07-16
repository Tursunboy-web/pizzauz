<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
{
    $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
    $user = Role::create(['name' => 'user', 'guard_name' => 'web']);

    $permissions = ['view orders', 'edit orders', 'manage users'];

    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
    }

    $admin->givePermissionTo(Permission::all());
}
}
