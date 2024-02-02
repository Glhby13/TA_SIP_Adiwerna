<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Permohonan extends Model
{
    protected $table = 'permohonans';

    protected $fillable = [
        'NIS', // Kolom NIS dari tabel users
        'tempat_prakerin',
        'alamat_tempat_prakerin',
        'email_tempat_prakerin',
        'telp_tempat_prakerin',
        'balasan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'NIS', 'NIS');
    }
}
