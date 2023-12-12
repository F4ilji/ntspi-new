<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class  RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);
        $permission_read = Permission::create(['name' => 'read posts']);
        $permission_create = Permission::create(['name' => 'create posts']);
        $permission_edit = Permission::create(['name' => 'edit posts']);
        $permission_delete = Permission::create(['name' => 'delete posts']);

        $permission_admin = [
            $permission_create,
            $permission_read,
            $permission_edit,
            $permission_delete,
        ];

        $role_admin->syncPermissions($permission_admin);
        $role_user->givePermissionTo($permission_read);
    }
}
