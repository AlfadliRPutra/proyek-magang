<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $campuses = [
            [
                'nama' => 'Universitas Jambi',
                'alamat' => 'Jl. Jambi-Ma. Bulian Km. 15 Mendalo Darat, Jambi',
                'kota' => 'Jambi',
                'provinsi' => 'Jambi',
                'kode_pos' => '36361',
            ],
            [
                'nama' => 'Universitas Islam Negeri Sultan Thaha Saifuddin Jambi',
                'alamat' => 'Jl. Arif Rahman Hakim, Telanaipura',
                'kota' => 'Jambi',
                'provinsi' => 'Jambi',
                'kode_pos' => '36361',
            ],
            [
                'nama' => 'Politeknik Jambi',
                'alamat' => 'Jl. Jambi-Muara Bulian KM 11',
                'kota' => 'Jambi',
                'provinsi' => 'Jambi',
                'kode_pos' => '36134',
            ],
            [
                'nama' => 'Universitas Batanghari',
                'alamat' => 'Jl. Slamet Riyadi No. 2, Broni',
                'kota' => 'Jambi',
                'provinsi' => 'Jambi',
                'kode_pos' => '36122',
            ],
            [
                'nama' => 'STIKes Harapan Ibu Jambi',
                'alamat' => 'Jl. H. Adam Malik No.01',
                'kota' => 'Jambi',
                'provinsi' => 'Jambi',
                'kode_pos' => '36137',
            ],
        ];

        foreach ($campuses as $campus) {
            Campus::create($campus);
        }
    }
}
