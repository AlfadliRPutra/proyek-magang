<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_name'
    ];

    public function interns()
    {
        return $this->hasMany(Intern::class, 'unit_id', 'id');
    }
}
