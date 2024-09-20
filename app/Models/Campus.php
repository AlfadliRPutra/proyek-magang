<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Intern::class, 'campus_id', 'id');
    }
}
