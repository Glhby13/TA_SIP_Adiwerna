<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformasiTempatPrakerin extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'informasitempatprakerin';

    protected $fillable = [
        'nama_perusahaan',
        'deskripsi',
        'posisi',
        'jurusan',
        'persyaratan',
        'email',
        'telp',
        'alamat',
        'image',
    ];
}
