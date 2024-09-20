<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengirim_id',
        'nama',
        'jenis',
        'file',
        'status',
        'hasil_file',
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id', 'id_pengguna');
    }
}
