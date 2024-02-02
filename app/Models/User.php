<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'NIP',
        'NIS',
        'no_admin',
        'name',
        'email',
        'password',
        'role',
        'jurusan',
        'kelas',
        'telp',
        'kuota_bimbingan',
        'status',
        'image',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'deleted_at' => 'datetime',
    ];

    /**
     * Default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => null,
    ];

    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->status = $user->status ?? ($user->role === 'siswa' ? 'Belum Mendaftar' : null);
        });
    }

    public function bimbingan(): HasMany
    {
        return $this->hasMany(Bimbingan::class, 'NIP', 'NIP');
    }

    public function bimbingansiswa()
    {
        return $this->hasOne(Bimbingan::class, 'NIS', 'NIS');
    }

    public function permohonan()
    {
        return $this->hasOne(Permohonan::class, 'NIS', 'NIS');
    }

    public function jurnal(): HasMany
    {
        return $this->hasMany(Jurnalharian::class, 'NIS', 'NIS');
    }
}
