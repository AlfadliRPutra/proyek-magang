<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    protected $fillable = [
        'id_pengguna',
        'date_izin',
        'status',
        'keterangan',
        'status_approved',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public static function countUnapproved()
    {
        return self::where('status_approved', 0)->count();
    }

    public static function getLastCreatedTime()
    {
        $lastEntry = self::where('status_approved', 0)
            ->latest()
            ->first();

        return $lastEntry ? $lastEntry->created_at->diffForHumans() : null;
    }

    /**
     * Get the total count of "izin" (absences) for a specific date.
     *
     * @param string $date
     * @return int
     */
    public static function getTotalIzin($date)
    {
        return self::where('date_izin', $date)
            ->where('status', 'i')
            ->where('status_approved', 1)
            ->count();
    }

    /**
     * Get the total count of "sakit" (sick leave) for a specific date.
     *
     * @param string $date
     * @return int
     */
    public static function getTotalSakit($date)
    {
        return self::where('date_izin', $date)
            ->where('status', 's')
            ->where('status_approved', 1)
            ->count();
    }
}
