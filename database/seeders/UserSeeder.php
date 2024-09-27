<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $SuperAdmin = User::create([
            'name' => 'Super Admin',
            'id_pengguna' => '12345678',
            'email' => 'superadmin@unja.ac.id',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),

        ]);
        $SuperAdmin->assignRole('super-admin');

        $admin = User::create([
            'name' => 'Admin',
            'id_pengguna' => '12768976',
            'email' => 'admin@unja.ac.id',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');
    }
}
