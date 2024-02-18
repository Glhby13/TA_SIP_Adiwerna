@extends('siswa.layout')
@section('laporan')

    <link href="{{ asset('assets/css/siswa/laporan.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">

    <style>
        /* Ganti warna teks placeholder menjadi merah (contoh) */
        input[readonly]::placeholder {
            color: rgb(194, 194, 194);
            /* Ganti dengan warna yang Anda inginkan */
        }
    </style>

    <div class="judul">
        <span style="color: #000000">Pengumpulan</span>
        <span style="color :#44B158">Laporan</span>
    </div>

    <div class="container-fluid" style="padding-top: 60px;">
        <form action="{{ route('submit.laporan') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6" style="padding-left : 200px; padding-right: 100px">
                    <div class="row mb-4">
                        <label for="Nama" class="form-label">Nama Siswa</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                placeholder="{{ isset($siswa->name) ? $siswa->name : '' }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="Jurusan" class="form-label">Jurusan</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                placeholder="{{ isset($siswa->jurusan)
                                    ? match ($siswa->jurusan) {
                                        'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
                                        'TE' => 'Teknik Elektronika',
                                        'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                                        'TK' => 'Teknik Ketenagalistrikan',
                                        'TM' => 'Teknik Mesin',
                                        'TKRO' => 'Teknik Kendaraan Ringan dan Otomotif',
                                        'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
                                        default => '',
                                    }
                                    : '' }}"
                                readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="Laporan" class="form-label">Laporan</label>
                        <div class="text-field">
                            @if (in_array($bimbinganSiswa->status, ['Sudah Mengumpulkan', 'ACC']))
                                <input class="form-control" style="font-size: 14px;" type="text"
                                    placeholder="{{ $bimbinganSiswa->laporan ?: 'Masukkan link drive' }}"
                                    aria-label="readonly input example" id="laporan" name="laporan" readonly>
                            @else
                                <input class="form-control" style="font-size: 14px;" type="text"
                                    placeholder="{{ $bimbinganSiswa->laporan ?: 'Masukkan link drive' }}"
                                    aria-label="readonly input example" id="laporan" name="laporan">
                            @endif
                            <p style="font-size: 10px; color: gray;">*Kumpulkan dalam bentuk link google drive</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="status" class="form-label">Status Laporan</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text" placeholder=""
                                aria-label="readonly input example" value="{{ $bimbinganSiswa->status }}" readonly>
                            {{-- <p style="font-size: 10px; color: gray;">*Status setelah laporan diperiksa guru pembimbing</p> --}}
                        </div>
                    </div>
                    <div class="btnlaporan mb-5" style="justify-content: start; display: flex; ">
                        @if ($bimbinganSiswa->status == 'Belum Mengumpulkan')
                            <!-- Tombol Submit -->
                            <button type="submit" name="action" value="submit" class="btn"
                                style="background-color: #44B158; color: #ffffff;">Submit</button>
                        @elseif ($bimbinganSiswa->status == 'Revisi')
                            <!-- Tombol Update -->
                            <button type="submit" name="action" value="update" class="btn"
                                style="background-color: #2a356c; color: #ffffff;">Update</button>
                        @endif
                    </div>
                </div>
                @if ($bimbinganSiswa->jumlah_revisi > 0)
                    <div class="col-6" style="padding-left: 70px; padding-right: 200px">
                        <div class="row mb-4">
                            <label for="Tempatprakerin" class="form-label">Jumlah Revisi</label>
                            <div class="text-field">
                                <input class="form-control" style="font-size: 14px;" type="text"
                                    value="{{ $bimbinganSiswa->jumlah_revisi }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="" class="form-label">Catatan Revisi</label>
                            <div class="text-field">
                                <textarea class="form-control" style="font-size: 14px;" type="text"
                                    readonly>{{ $bimbinganSiswa->catatan_revisi }}</textarea>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
@stop
