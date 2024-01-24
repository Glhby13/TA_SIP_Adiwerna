@extends('siswa.layout')
@section('laporan')

    <link href="{{ asset('assets/css/siswa/pengaturan.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">

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
                z-index: 1080;
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

    <div class="judul">
        <span style="color: #000000">Ganti</span>
        <span style="color :#44B158">Password</span>
    </div>


    @if (session('message'))
    <div class="alert alert-success alert-floating">
        {{ session('message') }}
    </div>
    @endif

    <form action="{{ route('change.password') }}" method="POST" id="password-change-form">
        @csrf
        <div class="container-fluid" style="padding-top: 60px;">
            <div class="row">
                <div class="col-6" style="padding-left : 200px; padding-right: 100px">
                    <div class="row mb-4">
                        <label for="current_password" class="form-label">Current Password</label>
                        <div class="text-field">
                            <input name="current_password" class="form-control" style="font-size: 14px" type="text"
                                id="current_password" placeholder="Masukkan password saat ini">
                            @error('current_password')
                                <div style="color: red; font-size: 12px">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="password" class="form-label">New Password</label>
                        <div class="text-field">
                            <input name="password" class="form-control" style="font-size: 14px" type="text"
                                id="password" placeholder="Masukkan password baru">
                            @error('password')
                                <div style="color: red; font-size: 12px">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="password_confirmation" class="form-label">Confirm New
                            Password</label>
                        <div class="text-field">
                            <input name="password_confirmation" class="form-control" style="font-size: 14px" type="text"
                                id="password_confirmation" placeholder="Konfirmasi password baru">
                            @error('password_confirmation')
                                <div style="color: red; font-size: 12px">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                    <div class="modal-footer" style="border-top: 0">
                        <button type="submit" class="btn"
                            style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save Change</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
