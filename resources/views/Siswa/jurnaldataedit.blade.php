@extends('siswa.layout')
@section('jurnaldataedit')

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

    .back-icon{
        position: absolute;
        font-size: 36px;
        top: 100px;
        padding-left: 15px;
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
            color: rgb(194, 194, 194); /* Ganti dengan warna yang Anda inginkan */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Temukan tombol "Reset" berdasarkan ID
            var resetButton = document.getElementById("resetButton");

            // Temukan semua input fields berdasarkan ID\
            var deskripsi = document.getElementById("deskripsi");

            // Tambahkan event listener ke tombol "Reset"
            resetButton.addEventListener("click", function () {
                deskripsi.value = "{{ $jurnal->deskripsi }}";
            });
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Temukan elemen input tanggal
        var dateInput = document.getElementById("date");

        // Inisialisasi Flatpickr dengan format yang diinginkan
        flatpickr(dateInput, {
            dateFormat: "d-m-Y",
            placeholder: "dd-mm-yyyy",
        });
    });
</script>


    <div class="judul">
        <span style="color: #000000">Edit</span>
        <span style="color :#44B158">Jurnal</span>
    </div>
    <div class="back-icon">
        <a href="{{ route('siswa.jurnaldata') }}" style="float: left; margin-left: 200px; color: #000000">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
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
        <form action="{{ route('siswa.jurnaldataedit', ['id' => $jurnal->id]) }}" method="POST">
            @csrf
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
                        <label for="Guru" class="form-label">Guru Pembimbing</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text" placeholder="guru"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="col-6" style="padding-left: 70px; padding-right: 200px">
                    <div class="row mb-4">
                        <label for="date" class="form-label">Tanggal</label>
                        <input class="form-control" id="date" name="date" type="text" style="font-size: 14px; max-width:97%; margin-left:1.5%; background-color:unset;" 
                        placeholder="{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d-m-Y') }}" readonly>
                    </div>
                                    
                    <div class="row mb-4">
                        <label for="deskripsi" class="form-label">Keterangan Kegiatan</label>
                        <div class="text-field">
                            <textarea  class="form-control" style="font-size: 14px;" type="text" 
                                id="deskripsi" name="deskripsi" required>{{ $jurnal->deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="btnjurnal" style="justify-content: end; display: flex">
                        <button type="button" class="btn" id="resetButton" style="background-color: #EF4F4F; color: #ffffff">Reset</button>
                        <button type="submit" class="btn"
                            style="background-color: #44B158; color: #ffffff; margin-left: 16px;">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
