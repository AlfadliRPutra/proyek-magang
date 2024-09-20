<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';

    protected $fillable = [
        'id_pengguna',
        'date_attendance',
        'in_hour',
        'out_hour',
        'foto_in',
        'foto_out',
        'location_in',
        'location_out',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }
}