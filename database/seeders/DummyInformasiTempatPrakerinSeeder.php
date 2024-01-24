<?php

namespace Database\Seeders;

use App\Models\InformasiTempatPrakerin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyInformasiTempatPrakerinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_perusahaan' => 'Perusahaan A',
                'deskripsi' => 'Perusahaan yang bergerak di bidang teknik jaringan komputer dan telekomunikasi.',
                'posisi' => 'Network Engineer, Web Developer, UI/UX Designer',
                'jurusan' => 'TJKT',
                'persyaratan' => 'Pendidikan minimal S1 Teknik Jaringan Komputer, pengalaman kerja di bidang jaringan.',
                'email' => 'perusahaanA@example.com',
                'telp' => '081234567890',
                'alamat' => 'Jl. Contoh No. 123',
            ],
            [
                'nama_perusahaan' => 'Perusahaan B',
                'deskripsi' => 'Perusahaan terkemuka di industri telekomunikasi, menyediakan solusi terbaik untuk pelanggan.',
                'posisi' => 'Telecommunication Specialist, Backend Developer',
                'jurusan' => 'TJKT',
                'persyaratan' => 'Pendidikan minimal D3 Telekomunikasi, memiliki pengetahuan dalam teknologi telekomunikasi.',
                'email' => 'perusahaanB@example.com',
                'telp' => '081234567891',
                'alamat' => 'Jl. Contoh No. 456',
            ],
        ];

        foreach ($data as $item) {
            InformasiTempatPrakerin::create($item);
        }
    }
}
