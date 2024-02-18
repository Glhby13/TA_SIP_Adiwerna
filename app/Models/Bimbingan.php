<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bimbingan extends Model
{
    use SoftDeletes;

    protected $table = 'bimbingans';

    protected $fillable = [
        'NIP',
        'NIS',
        'laporan',
        'status',
        'jumlah_revisi',
        'catatan_revisi',
    ];

    /**
     * Get the guru associated with the bimbingan.
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'NIP', 'NIP');
    }

    /**
     * Get the siswa associated with the bimbingan.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'NIS', 'NIS');
    }
}
