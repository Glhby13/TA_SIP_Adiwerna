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
                'nama_perusahaan' => 'Telkom Akses',
                'deskripsi' => 'Perusahaan yang bergerak di bidang jaringan telekomunikasi.',
                'posisi' => 'Network Engineer, Teknisi Fiber Optik, Admin Gudang',
                'jurusan' => 'TJKT',
                'persyaratan' => 'Mampu mengkonfigurasi perangkat jaringan, Menguasai MS. Excel',
                'email' => 'info@telkomakses.co.id',
                'telp' => '0882-1735-9523',
                'alamat' => 'PT Telkom Akses Jl. Letjen S. Parman No.Kav 8, RT.1/RW.7, Tomang,
                Kec. Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11440',
            ],
            [
                'nama_perusahaan' => 'PLN',
                'deskripsi' => 'Badan usaha milik negara Indonesia yang bergerak di bidang ketenagalistrikan.',
                'posisi' => 'Manajemen Energi, Operasi Pembangkitan',
                'jurusan' => 'TE',
                'persyaratan' => 'Memiliki kemampuan komunikasi yang baik dan mampu bekerja dalam tim, 
                Bersedia mengikuti program prakerin dengan waktu yang telah ditentukan',
                'email' => 'pln123@pln.co.id',
                'telp' => '(021) 7261875',
                'alamat' => ' Jl. Trunojoyo Blok M 1 - no.135 JAKARTA 12160.',
            ],
        ];

        foreach ($data as $item) {
            InformasiTempatPrakerin::create($item);
        }
    }
}
