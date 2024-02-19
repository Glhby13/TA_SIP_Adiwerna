@extends('siswa.layout')
@section('jurnal')

    <!-- Tambahkan script Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>

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


    <link href="{{ asset('assets/css/siswa/jurnal.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">

    <style>
        /* Ganti warna teks placeholder menjadi merah (contoh) */
        input[readonly]::placeholder {
            color: rgb(194, 194, 194);
            /* Ganti dengan warna yang Anda inginkan */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan tombol "Reset" berdasarkan ID
            var resetButton = document.getElementById("resetButton");

            // Temukan semua input fields berdasarkan ID
            var date = document.getElementById("date");
            var deskripsi = document.getElementById("deskripsi");

            // Tambahkan event listener ke tombol "Reset"
            resetButton.addEventListener("click", function() {
                // Reset nilai semua input fields
                date.value = "";
                deskripsi.value = "";
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan elemen input tanggal
            var dateInput = document.getElementById("date");

            // Dapatkan tanggal hari ini
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '-' + mm + '-' + yyyy;

            // Inisialisasi Flatpickr dengan format yang diinginkan
            flatpickr(dateInput, {
                dateFormat: "d-m-Y",
                placeholder: "dd-mm-yyyy",
                minDate: today, // Menetapkan tanggal minimum menjadi hari ini
                maxDate: today, // Menetapkan tanggal maksimum menjadi hari ini
                // disableMobile: true // Opsional, untuk mengaktifkan mode non-mobile-friendly
            });
        });
    </script>


    <div class="judul">
        <span style="color: #000000">Pengisian</span>
        <span style="color :#44B158">Jurnal</span>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-floating">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-floating">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-floating">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="container-fluid" style="padding-top: 60px; padding-bottom: 90px">
        <form action="{{ route('submit.jurnal') }}" method="POST">
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
                        <label for="Guru" class="form-label">Guru Pembimbing</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text" placeholder="guru" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-6" style="padding-left: 70px; padding-right: 200px">
                    <div class="row mb-4">
                        <label for="date" class="form-label">Tanggal</label>
                        <div class="field">
                            <input class="form-control" id="date" name="date" type="date"
                                style="font-size: 14px; background-color: unset;" placeholder="dd-mm-yyyy"
                                value="{{ old('date') }}"
                                {{ $siswa->status === 'Selesai Prakerin' ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="deskripsi" class="form-label">Keterangan Kegiatan</label>
                        <div class="text-field">
                            <textarea class="form-control" style="font-size: 14px;" type="text" id="deskripsi" name="deskripsi" 
                                      required {{ $siswa->status === 'Selesai Prakerin' ? 'readonly' : '' }}>{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                    <div class="btnjurnal" style="justify-content: end; display: flex">
                        <button type="button" class="btn" id="resetButton" 
                                style="background-color: #EF4F4F; color: #ffffff" 
                                {{ $siswa->status === 'Selesai Prakerin' ? 'disabled' : '' }}>Reset</button>
                        <button type="submit" class="btn" 
                                style="background-color: #44B158; color: #ffffff; margin-left: 16px;" 
                                {{ $siswa->status === 'Selesai Prakerin' ? 'disabled' : '' }}>Submit</button>
                    </div>
                    <div class="btnshowjurnal" style="justify-content: end; display: flex; margin-top: 3vh;">
                        <a href="{{ route('siswa.jurnaldata') }}"><button type="button" class="btn"
                                style="background-color: #2A356C; color: #ffffff; font-size: 16px; width: 101%;">
                                <i class="fas fa-book mr-3 ml-1"></i>
                                Jurnal Harian</button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
