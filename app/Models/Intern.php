<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pengguna',
        'foto',
        'unit_id',
        'no_phone',
        'campus_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public function unitListing()
    {
        return $this->belongsTo(UnitListing::class, 'unit_id', 'id');
    }

    public function kampus()
    {
        return $this->belongsTo(Campus::class, 'campus_id', 'id');
    }

    // Di dalam model Intern
    public static function getCountAndLastItemWithNullUnit()
    {
        $count = self::whereNull('unit_id')->count();

        $lastItem = self::whereNull('unit_id')
            ->latest('created_at')
            ->first();

        $lastItemData = $lastItem ? [
            'item' => $lastItem,
            'created_at' => $lastItem->created_at->diffForHumans(), // Pastikan ini adalah string
        ] : null;

        return [
            'count' => $count,
            'lastItem' => $lastItemData,
        ];
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class,  'id_pengguna', 'id_pengguna');
    }
}