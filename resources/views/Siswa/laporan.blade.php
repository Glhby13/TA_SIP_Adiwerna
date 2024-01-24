@extends('siswa.layout')
@section('laporan')

    <link href="{{ asset('assets/css/siswa/laporan.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">

    <style>
        /* Ganti warna teks placeholder menjadi merah (contoh) */
        input[readonly]::placeholder {
            color: rgb(194, 194, 194); /* Ganti dengan warna yang Anda inginkan */
        }
    </style>


    <div class="judul">
        <span style="color: #000000">Pengumpulan</span>
        <span style="color :#44B158">Laporan</span>
    </div>

    <div class="container-fluid" style="padding-top: 60px;">
        <div class="row">
            <div class="col-6" style="padding-left : 200px; padding-right: 100px">
                <div class="row mb-4">
                    <label for="Nama" class="form-label">Nama Siswa</label>
                    <div class="text-field">
                        <input class="form-control" style="font-size: 14px;" type="text" placeholder="{{ isset($siswa->name) ? $siswa->name : '' }}"
                            readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="Jurusan" class="form-label">Jurusan</label>
                    <div class="text-field">
                        <input class="form-control" style="font-size: 14px;" type="text"
                            placeholder="{{ isset($siswa->jurusan) ? 
                                (match($siswa->jurusan) {
                                    'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
                                    'TE' => 'Teknik Elektronika',
                                    'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                                    'TK' => 'Teknik Ketenagalistrikan',
                                    'TM' => 'Teknik Mesin',
                                    'TO' => 'Teknik Otomotif',
                                    'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
                                    default => ''
                                }) : ''
                            }}"
                            readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="Laporan" class="form-label">Laporan</label>
                    <div class="text-field">
                        <input class="form-control" style="font-size: 14px;" type="text"
                            placeholder="Masukkan link drive" aria-label="readonly input example">
                        <p style="font-size: 10px; color: gray;">*Kumpulkan dalam bentuk link google drive</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="Laporan" class="form-label">Status Laporan</label>
                    <div class="text-field">
                        <input class="form-control" style="font-size: 14px;" type="text" placeholder=""
                            aria-label="readonly input example" readonly>
                        <p style="font-size: 10px; color: gray;">*Status setelah laporan diperiksa guru pembimbing</p>
                    </div>
                </div>
                <div class="btnlaporan" style="justify-content: start; display: flex">
                    <button type="button" class="btn" style="background-color: #44B158; color: #ffffff;">Submit</button>
                    <button type="button" class="btn"
                        style="background-color: #1F3397; color: #ffffff; margin-left: 16px;">Update</button>

                </div>
            </div>
            <div class="col-6" style="padding-left: 70px; padding-right: 200px">
                {{-- <div class="row mb-4">
                    <label for="date" class="form-label">Date</label>
                    <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                        <input class="form-control" type="text" readonly />
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="keterangan" class="form-label">Keterangan Kegiatan</label>
                    <div class="text-field">
                        <input class="form-control" style="font-size: 14px;" type="text"
                            placeholder="Tuliskan Keterangan Harian Anda" aria-label="readonly input example" readonly>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
@stop
