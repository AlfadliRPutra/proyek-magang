<?php

namespace Database\Seeders;

use App\Models\Kantor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Kantor::insert([
            ['location_office' => '-1.609895,103.596343', 'radius' => '200'],
        ]);
    }
}
