<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::create(['name' => 'tambah-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'hapus-user']);
        Permission::create(['name' => 'lihat-user']);

        Permission::create(['name' => 'tambah-event']);
        Permission::create(['name' => 'edit-event']);
        Permission::create(['name' => 'hapus-event']);
        Permission::create(['name' => 'lihat-event']);

        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'intern']);

        $roleSuperAdmin = Role::findByName('super-admin');
        $roleSuperAdmin->givePermissionTo('tambah-user');
        $roleSuperAdmin->givePermissionTo('edit-user');
        $roleSuperAdmin->givePermissionTo('hapus-user');
        $roleSuperAdmin->givePermissionTo('lihat-user');

        $roleAdmin = Role::findByName('admin');
        $roleSuperAdmin->givePermissionTo('lihat-user');

        $roleIntern = Role::findByName('intern');
        $roleSuperAdmin->givePermissionTo('lihat-user');
    }
}