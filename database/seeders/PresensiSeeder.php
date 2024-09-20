<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Define the start and end dates for the week
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        // Fetch all users with the role 'intern'
        $internUsers = User::role('intern')->get();

        foreach ($internUsers as $user) {
            // Iterate through each day of the week
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                // Randomize whether the user is present on this day
                if (rand(0, 1)) { // 50% chance of creating a record
                    Presensi::create([
                        'id_pengguna' => $user->id_pengguna,
                        'date_attendance' => $date->format('Y-m-d'),
                        'in_hour' => $faker->dateTimeBetween('07:20:00', '09:30:00')->format('H:i:s'),
                        'out_hour' => $faker->dateTimeBetween('14:30:00', '17:50:00')->format('H:i:s'),
                        'foto_in' => $faker->imageUrl(640, 480, 'cats', true, 'Faker', 'png'),
                        'foto_out' => $faker->imageUrl(640, 480, 'cats', true, 'Faker', 'png'),
                        'location_in' => $faker->latitude() . ',' . $faker->longitude(),
                        'location_out' => $faker->latitude() . ',' . $faker->longitude(),
                    ]);
                }
            }
        }
    }
}
