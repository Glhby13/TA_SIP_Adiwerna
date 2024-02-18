<?php

namespace Database\Seeders;

use App\Models\Kegiatanprakerin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyKegiatanPrakerinSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kegiatan' => 'Survey Tempat Prakerin',
                'deskripsi' => 'Survey tempat prakerin secara yang dilakukan oleh siswa secara mandiri.
                Kegiatan ini dilakukan oleh siswa sebelum mengajukan permohonan prakerin',
            ],
            [
                'nama_kegiatan' => 'Pelaksanaan Prakerin',
                'deskripsi' => 'Pelaksanaan prakerin yang dilakukan oleh siswa SMK N 1 Adiwerna di perusahaan mitra sekolah.
                Prakerin dilaksanakan selama maksimal 6 bulan. Siswa dapat menentukan durasi prakerin masing-masing.',
            ],
            [
                'nama_kegiatan' => 'Pembekalan Prakerin',
                'deskripsi' => 'Pembekalan diberikan kepada semua siswa yang akan melaksanakan prakerin.
                Sebelum memulai kegiatan prakerin, siswa diberi pembekalan oleh sekolah sebagai persiapan sebelum ke perusahaan/industri. ',
            ],
            [
                'nama_kegiatan' => 'Monitoring Prakerin',
                'deskripsi' => 'Guru pembimbing datang ke lokasi prakerin siswa untuk memonitoring perkembangan siswa selama prakerin.
                Pelaksanaan kunjungan dilakukan beberapa kali selama periode prakerin. ',
            ],
        ];

        foreach ($data as $item) {
            Kegiatanprakerin::create($item);
        }
    }
}