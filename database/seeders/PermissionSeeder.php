<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
Use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::UpdateOrCreate(
            [
                'name' => 'admin',
            ],
            ['name' => 'admin'],
        );

        $role_mahasiswa = Role::UpdateOrCreate(
            [
                'name' => 'mahasiswa',
            ],
            ['name' => 'mahasiswa'],
        );

        $permission = Permission::UpdateOrCreate(
            [
                'name' => 'view_dashboard',
            ],
            ['name' => 'view_dashboard'],
        );

        $permission2 = Permission::UpdateOrCreate(
            [
                'name' => 'view_index',
            ],
            ['name' => 'view_index'],
        );

        $role_mahasiswa->givePermissionTo($permission);
        $role_admin->givePermissionTo($permission2);

        $user = User::find(33);

        $user->assignRole('mahasiswa');

    }
}
