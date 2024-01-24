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
                'NIP'=>'111111',
                'name'=>'Putri',
                'email'=>'putri@gmail.com',
                'password'=>bcrypt('guru'),
                'telp'=>'0895360953970',
                'role'=>'guru',
                'jurusan'=>'TJKT',
                'kuota_bimbingan' =>'2',
            ],
            [
                'NIP'=>'222222',
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
                'NIS'=>'111111',
                'name'=>'Kirani',
                'email'=>'kirani@gmail.com',
                'password'=>bcrypt('siswa'),
                'role'=>'siswa',
                'jurusan'=>'TJKT',
                'telp'=>'083452197680',
                'kelas'=>'TJKT 1',

            ],
            [
                'NIS'=>'222222',
                'name'=>'Juli',
                'email'=>'juli@gmail.com',
                'password'=>bcrypt('siswa'),
                'role'=>'siswa',
                'jurusan'=>'DPIB',
                'telp'=>'082546398462',
                'kelas'=>'DPIB 1',
            ],
            [
                'NIS'=>'333333',
                'name'=>'Andini',
                'email'=>'andini@gmail.com',
                'password'=>bcrypt('siswa'),
                'role'=>'siswa',
                'jurusan'=>'TJKT',
                'telp'=>'082546398462',
                'kelas'=>'TJKT 1',
            ],

            //admin
            [
                'no_admin'=>'111111',
                'name'=>'Galih',
                'email'=>'galih@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
            ],
            [
                'no_admin'=>'222222',
                'name'=>'Bayu',
                'email'=>'bayu@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'jurusan'=>'DPIB',
            ],
        ];
        foreach($userData as $key => $val){
            User::create($val);
        } 
    }
}
