<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    // Mengizinkan kolom ini untuk diisi massal
    protected $fillable = [
        'description', // Deskripsi goal
        'status',      // Status goal
        'id_pengguna', // Relasi dengan pengguna
    ];

    // Jika ada relasi dengan model User, tambahkan fungsi berikut
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}