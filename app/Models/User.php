<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    // protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_pengguna'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_pengguna', 'id_pengguna');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id_pengguna', 'id_pengguna');
    }

    public function interns()
    {
        return $this->hasOne(Intern::class, 'id_pengguna', 'id_pengguna');
    }
    public function hasUserRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }
    /**
     * Get the route name to redirect the user based on their role.
     *
     * @return string
     */
    public function getRedirectRoute(): string
    {
        return match ((int)$this->role_id) {
            1 => 'super-admin.dashboard',
            2 => 'admin.dashboard',
            3 => 'intern.dashboard',
                // Add more roles as needed
            default => throw new \Exception('Invalid role ID'), // No default route
        };
    }
}
