@extends ('siswa.layout')
@section('permohonan')

    <link href="{{ asset('assets/css/siswa/permohonan.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">

    <div class="judul">
        <span style="color: #000000">Permohonan</span>
        <span style="color :#44B158">Prakerin</span>
    </div>

    <style>
        /* Ganti warna teks placeholder menjadi merah (contoh) */
        input[readonly]::placeholder {
            color: rgb(194, 194, 194);
            /* Ganti dengan warna yang Anda inginkan */
        }
    </style>

    <style>
        .alert-floating {
            position: fixed;
            max-width: 100%;
            /* Set maksimum lebar notifikasi sesuai lebar parent */
            width: auto;
            /* Biarkan lebar menyesuaikan isi notifikasi */
            top: 11vh;
            right: 7vh;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan tombol "Reset" berdasarkan ID
            var resetButton = document.getElementById("resetButton");

            // Temukan semua input fields berdasarkan ID
            var tempatPrakerinInput = document.getElementById("tempatPrakerin");
            var alamatPrakerinInput = document.getElementById("alamatPrakerin");
            var emailPrakerinInput = document.getElementById("emailPrakerin");
            var noTelpPrakerinInput = document.getElementById("noTelpPrakerin");
            var durasiInput = document.getElementById("durasi");

            // Tambahkan event listener ke tombol "Reset"
            resetButton.addEventListener("click", function() {
                // Reset nilai semua input fields
                tempatPrakerinInput.value = "";
                alamatPrakerinInput.value = "";
                alamatPrakerinInput.style.height = "100%";
                emailPrakerinInput.value = "";
                noTelpPrakerinInput.value = "";
                durasiInput.value = "";
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan notifikasi
            var alertFloating = document.querySelector('.alert-floating');

            // Tambahkan event listener untuk mendeteksi klik di luar notifikasi
            document.addEventListener("click", function(event) {
                if (event.target !== alertFloating) {
                    alertFloating.style.display =
                        'none'; // Sembunyikan notifikasi jika diklik di luar notifikasi
                }
            });
        });
    </script>

    <div class="container-fluid" style="padding-top: 20px; margin-bottom: 90px">
        <form action="{{ route('submit.permohonan') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6" style="padding-left : 200px; padding-right: 100px">
                    <div class="row mb-4">
                        <div class="teks">
                            Isilah data berikut!
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="Nama" class="form-label">Nama Lengkap</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                placeholder="{{ isset($siswa->name) ? $siswa->name : '' }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="NIS" class="form-label">NIS</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                placeholder="{{ isset($siswa->NIS) ? $siswa->NIS : '' }}" readonly>
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
                        <label for="Tempatprakerin" class="form-label">Tempat Prakerin</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                value="{{ old('tempatPrakerin') }}"
                                placeholder="{{ $siswa->status !== 'Belum Mendaftar' ? $permohonan->tempat_prakerin : 'masukkan nama perusahaan' }}"
                                id="tempatPrakerin" name="tempatPrakerin"
                                {{ $siswa->status !== 'Belum Mendaftar' && $siswa->status !== null ? 'readonly' : '' }}>
                        </div>
                        @error('tempatPrakerin')
                            <div style="color: red; font-size: 12px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <label for="Alamat" class="form-label">Alamat Tempat Prakerin</label>
                        <div class="text-field">
                            <textarea class="form-control" style="font-size: 14px;" type="text" value="{{ old('alamatPrakerin') }}"
                                placeholder="{{ $siswa->status !== 'Belum Mendaftar' ? $permohonan->alamat_tempat_prakerin : 'masukkan alamat perusahaan' }}"
                                id="alamatPrakerin" name="alamatPrakerin"
                                {{ $siswa->status !== 'Belum Mendaftar' && $siswa->status !== null ? 'readonly' : '' }}></textarea>
                        </div>
                        @error('alamatPrakerin')
                            <div style="color: red; font-size: 12px">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6" style="padding-left: 70px; padding-top: 51px; padding-right: 200px">
                    <div class="row mb-4">
                        <label for="email" class="form-label">Email Tempat Prakerin</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                value="{{ old('emailPrakerin') }}"
                                placeholder="{{ $siswa->status !== 'Belum Mendaftar' ? $permohonan->email_tempat_prakerin : 'perusahaan@domain.com' }}"
                                id="emailPrakerin" name="emailPrakerin"
                                {{ $siswa->status !== 'Belum Mendaftar' && $siswa->status !== null ? 'readonly' : '' }}>
                        </div>
                        @error('emailPrakerin')
                            <div style="color: red; font-size: 12px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <label for="nomorkontak" class="form-label">No. Telp Tempat Prakerin</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                value="{{ old('noTelpPrakerin') }}"
                                placeholder="{{ $siswa->status !== 'Belum Mendaftar' ? $permohonan->telp_tempat_prakerin : 'masukkan no.telp perusahaan' }}"
                                id="noTelpPrakerin" name="noTelpPrakerin"
                                {{ $siswa->status !== 'Belum Mendaftar' && $siswa->status !== null ? 'readonly' : '' }}>
                        </div>
                        @error('noTelpPrakerin')
                            <div style="color: red; font-size: 12px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <label for="durasi" class="form-label">Durasi</label>
                        <div class="text-field">
                            <select class="form-select" style="font-size: 14px;" id="durasi" name="durasi"
                                @if ($siswa->status !== 'Belum Mendaftar') disabled @endif>
                                <option value="" disabled selected>- Pilih Durasi -</option>
                                @php
                                    $options = [1, 1.5, 2, 2.5, 3, 4, 5, 6];
                                @endphp
                                @foreach ($options as $option)
                                    <option value="{{ $option }}" @if (old('durasi') == $option || ($siswa->status !== 'Belum Mendaftar' && $permohonan->durasi == $option)) selected @endif>
                                        {{ $option }} bulan
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('durasi')
                            <div style="color: red; font-size: 12px">{{ $message }}</div>
                        @enderror
                    </div>
                    



                    <div class="btnpermohonan" style="justify-content: end; display: flex">
                        @if ($siswa->status === 'Belum Mendaftar' || $siswa->status === null)
                            <button type="button" class="btn" id="resetButton"
                                style="background-color: #EF4F4F; color: #ffffff">Reset</button>
                            <button type="submit" class="btn"
                                style="background-color: #44B158; color: #ffffff; margin-left: 10px">Submit</button>
                        @endif
                    </div>
        </form>
        @if ($siswa->status !== 'Belum Mendaftar' && $permohonan->tanggal_mulai && $permohonan->tanggal_selesai)
        <form action="{{ route('balasan.permohonan') }}" method="POST">
            @csrf
            <div class="row mb-4">
                <label for="balasanPrakerin" class="form-label">Balasan Tempat Prakerin</label>
                <div class="text-field">
                    <input class="form-control" style="font-size: 14px;" type="text"
                        placeholder="{{ $permohonan->balasan ?? 'Masukkan link drive' }}" id="balasanPrakerin" name="balasanPrakerin"
                        {{ $permohonan->balasan ? 'readonly' : '' }}>
                </div>
            </div>
    
            @if (!$permohonan->balasan)
                <div class="btnpermohonan" style="justify-content: end; display: flex">
                    <button type="submit" class="btn"
                        style="background-color: #44B158; color: #ffffff;">Submit</button>
                </div>
            @endif
        </form>
    @endif
    
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-floating">
            {{ session('success') }}
        </div>
    @endif
    </div>
    </div>

@stop
