<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd("test");
        // Sesuaikan atribut berikut dengan struktur file Excel
        return new User([
            'NIP' => $row['nip'],
            'name' => $row['nama'],
            'jurusan' => $row['jurusan'],
            'kuota_bimbingan' => $row['kuota'],
            'telp' => $row['telp'],
            'email' => $row['email'],
            'role' => 'guru', // Set role secara eksplisit menjadi 'siswa'
        ]);
    }
}
