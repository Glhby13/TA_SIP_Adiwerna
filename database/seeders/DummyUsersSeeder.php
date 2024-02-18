<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            //guru
            [
                'NIP'=>'guruTJKT1',
                'name'=>'Putri',
                'email'=>'putri@gmail.com',
                'password'=>bcrypt('guru'),
                'telp'=>'0895360953970',
                'role'=>'guru',
                'jurusan'=>'TJKT',
                'kuota_bimbingan' =>'2',
            ],
            [
                'NIP'=>'guruDPIB1',
                'name'=>'Almaas',
                'email'=>'almaas@gmail.com',
                'password'=>bcrypt('guru'),
                'telp'=>'0895360953970',
                'role'=>'guru',
                'jurusan' => 'DPIB',
                'kuota_bimbingan' =>'5',
            ],

            //siswa
            [
                'NIS'=>'siswaTJKT1',
                'name'=>'Kirani',
                'email'=>'kirani@gmail.com',
                'password'=>bcrypt('siswa'),
                'role'=>'siswa',
                'jurusan'=>'TJKT',
                'telp'=>'083452197680',
                'kelas'=>'TJKT 1',

            ],
            [
                'NIS'=>'siswaDPIB2',
                'name'=>'Juli',
                'email'=>'juli@gmail.com',
                'password'=>bcrypt('siswa'),
                'role'=>'siswa',
                'jurusan'=>'DPIB',
                'telp'=>'082546398462',
                'kelas'=>'DPIB 1',
            ],
            [
                'NIS'=>'siswaTJKT2',
                'name'=>'Andini',
                'email'=>'andini@gmail.com',
                'password'=>bcrypt('siswa'),
                'role'=>'siswa',
                'jurusan'=>'TJKT',
                'telp'=>'082546398462',
                'kelas'=>'TJKT 2',
            ],

            //admin
            [
                'no_admin'=>'superadmin',
                'name'=>'Super Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
            ],
            [
                'no_admin'=>'adminDPIB',
                'name'=>'Admin DPIB',
                'email'=>'admindpib@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'DPIB',
            ],
            [
                'no_admin'=>'adminTE',
                'name'=>'Admin TE',
                'email'=>'adminte@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'TE',
            ],
            [
                'no_admin'=>'adminTJKT',
                'name'=>'Admin TJKT',
                'email'=>'admintjkt@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'TJKT',
            ],
            [
                'no_admin'=>'adminTK',
                'name'=>'Admin TK',
                'email'=>'adminttk@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'TK',
            ],
            [
                'no_admin'=>'adminTM',
                'name'=>'Admin TM',
                'email'=>'admintm@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'TM',
            ],
            [
                'no_admin'=>'adminTKRO',
                'name'=>'Admin TKRO',
                'email'=>'admintkro@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'TKRO',
            ],
            [
                'no_admin'=>'adminTPFL',
                'name'=>'Admin TPFL',
                'email'=>'admintpfl@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'TPFL',
            ],
        ];
        foreach($userData as $key => $val){
            User::create($val);
        } 
    }
}
