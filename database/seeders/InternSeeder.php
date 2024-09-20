<?php

namespace Database\Seeders;

use App\Models\Intern;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users using the User factory
        $users = User::factory()->count(50)->create(); // Adjust the count as needed

        // Loop through each user
        foreach ($users as $user) {
            // Check if the user has any roles
            if ($user->roles->isEmpty()) {
                // If no roles are assigned, assign the 'intern' role
                $user->assignRole('intern');
            }

            // Check if id_pengguna already exists in the interns table
            if (!Intern::where('id_pengguna', $user->id_pengguna)->exists()) {
                // If not, create a new entry
                Intern::create([
                    'id_pengguna' => $user->id_pengguna, // or adjust as needed
                    'unit_id' => rand(1, 7), // Using a random number from 1-7
                    'no_phone' => fake()->phoneNumber(), // or appropriate data
                    'campus_id' => rand(1, 5), // or appropriate data
                ]);
            }
        }
    }
}
