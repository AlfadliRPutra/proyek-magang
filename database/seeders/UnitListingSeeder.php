<?php

namespace Database\Seeders;

use App\Models\UnitListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UnitListing::insert([
            ['unit_name' => 'Shared Services & General Support'],
            ['unit_name' => 'Telkom Daerah Jambi'],
            ['unit_name' => 'Regional Solution & Operation'],
            ['unit_name' => 'BGES, MBB, FBB Access, & SVC OPS'],
            ['unit_name' => 'ACC Optima, Maintenance, QE, & Daman'],
            ['unit_name' => 'ARNET'],
            ['unit_name' => 'Telkom Property'],
        ]);
    }
}
