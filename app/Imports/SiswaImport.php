<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd("test");
        // Sesuaikan atribut berikut dengan struktur file Excel
        return new User([
            'NIS' => $row['nis'],
            'name' => $row['nama'],
            'jurusan' => $row['jurusan'],
            'kelas' => $row['kelas'],
            'telp' => $row['telp'],
            'email' => $row['email'],
            'role' => 'siswa', // Set role secara eksplisit menjadi 'siswa'
        ]);
    }


    // public function model(array $row)
    // {
    //     // Cek apakah kolom 'nip' ada dalam array $row
    //     $nip = isset($row['nip']) ? $row['nip'] : null;

    //     // Cek apakah kolom 'nis' ada dalam array $row
    //     $nis = isset($row['nis']) ? $row['nis'] : null;

    //     // Tentukan role berdasarkan ketersediaan 'nip' atau 'nis'
    //     $role = $nip !== null ? 'guru' : ($nis !== null ? 'siswa' : null);

    //     // Cek apakah role valid
    //     if ($role === null) {
    //         // Jika tidak valid, Anda dapat menangani atau melewatinya
    //         // Contoh: skip baris yang tidak memiliki role yang valid
    //         return null;
    //     }

    //     // Sesuaikan atribut berikut dengan struktur file Excel
    //     return new User([
    //         'NIS' => $nis,
    //         'NIP' => $nip,
    //         'name' => $row['nama'],
    //         'jurusan' => $row['jurusan'],
    //         'kelas' => $row['kelas'],
    //         'telp' => $row['telp'],
    //         'email' => $row['email'],
    //         'role' => $role, // Tentukan role sesuai dengan pengecekan di atas
    //     ]);
    // }
}
