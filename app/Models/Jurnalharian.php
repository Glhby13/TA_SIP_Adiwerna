<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Jurnalharian extends Model
{
    protected $table = 'jurnalharians';

    protected $fillable = [
        'NIS', // Kolom NIS dari tabel users
        'tanggal',
        'deskripsi',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'NIS', 'NIS');
    }
}
