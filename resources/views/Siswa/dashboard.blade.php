@extends('siswa.layout')
@section('dashboard')

    <link href="{{ asset('assets/css/siswa/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pastikan Anda memasukkan jQuery -->


    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Mendapatkan URL halaman sebelumnya
            var previousPage = document.referrer;
    
            // Mendapatkan elemen notifikasi dan tombol tutup berdasarkan ID
            var notification = document.getElementById("notification");
            var closeButton = notification.querySelector(".btn-close");
            var notificationStatus = "open"; // Default status "open"
    
            // Mengecek apakah halaman sebelumnya adalah halaman login
            if (previousPage.includes("login")) {
                // Jika halaman sebelumnya adalah halaman login, biarkan status "open"
            } else {
                // Jika halaman sebelumnya bukan halaman login, atur status "closed"
                notificationStatus = "closed";
            }
    
            if (notificationStatus === "open") {
                // Tampilkan notifikasi jika statusnya adalah "open"
                notification.classList.add("d-flex");
                notification.style.display = "block";
            } else {
                // Jika status notifikasi adalah "closed", maka sembunyikan notifikasi
                notification.classList.remove("d-flex");
                notification.style.display = "none";
            }
    
            // Tambahkan event listener ke tombol tutup
            closeButton.addEventListener("click", function () {
                // Menghapus kelas .d-flex dan mengubah properti display menjadi "none"
                notification.classList.remove("d-flex");
                notification.style.display = "none";
                localStorage.setItem("notificationStatus", "closed");
            });
        });
    </script> --}}

    <script>
        $(document).ready(function () {
            var notification = $("#notification");
            var closeButton = notification.find(".btn-close");
            var notificationStatus = localStorage.getItem("notificationStatus") || "open";
    
            if (notificationStatus === "open") {
                notification.addClass("d-flex").show();
            } else {
                notification.removeClass("d-flex").hide();
            }
    
            closeButton.on("click", function () {
                notification.removeClass("d-flex").hide();
                localStorage.setItem("notificationStatus", "closed");
            });
    
            // Event listener untuk menutup notifikasi saat pindah halaman
            $(window).on("beforeunload", function () {
                // Jika notifikasi masih terbuka, tutup dan atur status ke "closed"
                if (notificationStatus === "open") {
                    notification.removeClass("d-flex").hide();
                    localStorage.setItem("notificationStatus", "closed");
                }
            });
        });
    </script>


    {{-- @if (session('notificationStatus') === 'open') --}}
    <div class="cont-1 container-fluid" style="margin-top: 90px">
        <div class="alert alert-success d-flex align-items-center" role="alert" id="notification">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                class="ms-2 bi bi-check-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
            </svg>
            <div style="margin-left: 20px">
                Selamat datang, {{ isset($siswa->name) ? $siswa->name : '' }} di Sistem Informasi Prakerin!
            </div>

            <button class="btn btn-close" aria-label="Close" data-dismis="alert" style="margin-left: auto;"></button>
        </div>
    </div>
    {{-- @endif --}}
    {{-- <script>
        // Set localStorage saat halaman dimuat
        localStorage.setItem("notificationStatus", "open");
    </script> --}}


    <div class="container-fluid" style="padding-top: 10px">
        <div class="row ms-auto">
            <div class="col-8">
                <div class="row mb-2">
                    <div class="card" style="padding: 0;">
                        <div class="card-body" style="padding: 0;">
                            <div class="row" style="padding: 0 12px;">
                                <div class="col-1 text-center"
                                    style="background-color: #D9D9D9; border-top-left-radius: 5px; border-bottom-left-radius: 5px; display: flex; align-items: center; justify-content: center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#25316D"
                                        class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path
                                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                    </svg>
                                </div>
                                <div class="col-11" style="padding: 16px 16px; font-weight:bold">
                                    {{ isset($permohonan->tanggal_mulai) ? App\Helpers\MyHelpers::getIndonesianDate($permohonan->tanggal_mulai) : 'Belum dijadwalkan' }}
                                    -
                                    {{ isset($permohonan->tanggal_selesai) ? App\Helpers\MyHelpers::getIndonesianDate($permohonan->tanggal_selesai) : 'Belum dijadwalkan' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="card" style="padding: 0;">
                        <div class="card-body" style="padding: 0;">
                            <div class="row" style="padding: 0 12px;">
                                <div class="col-1 text-center"
                                    style="background-color: #D9D9D9; border-top-left-radius: 5px; border-bottom-left-radius: 5px; display: flex; align-items: center; justify-content: center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#25316D"
                                        class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                </div>
                                <div class="col-11" style="padding: 16px 16px;">
                                    Guru Pembimbing: <br>
                                    <b>{{ $guru ? $guru->name : 'Belum dijadwalkan' }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="card" style="padding: 0;">
                        <div class="card-body" style="padding: 0;">
                            <div class="row" style="padding: 0 12px;">
                                <div class="col-1 text-center"
                                    style="background-color: #D9D9D9; border-top-left-radius: 5px; border-bottom-left-radius: 5px; display: flex; align-items: center; justify-content: center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#25316D"
                                        class="bi bi-buildings-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V.5ZM2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-1 2v1H2v-1h1Zm1 0h1v1H4v-1Zm9-10v1h-1V3h1ZM8 5h1v1H8V5Zm1 2v1H8V7h1ZM8 9h1v1H8V9Zm2 0h1v1h-1V9Zm-1 2v1H8v-1h1Zm1 0h1v1h-1v-1Zm3-2v1h-1V9h1Zm-1 2h1v1h-1v-1Zm-2-4h1v1h-1V7Zm3 0v1h-1V7h1Zm-2-2v1h-1V5h1Zm1 0h1v1h-1V5Z" />
                                    </svg>
                                </div>
                                <div class="col-11" style="padding: 16px 16px;">
                                    Tempat Pelaksaan Prakerin: <br>
                                    <b>{{ $permohonan ? $permohonan->tempat_prakerin : 'Belum mengajukan permohonan' }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="card" style="padding: 0;">
                        <div class="card-body" style="padding: 0;">
                            <div class="row" style="padding: 0 12px;">
                                <div class="col-1 text-center"
                                    style="background-color: #D9D9D9; border-top-left-radius: 5px; border-bottom-left-radius: 5px; display: flex; align-items: center; justify-content: center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#25316D"
                                        class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                    </svg>
                                </div>
                                <div class="col-11" style="padding: 16px 16px;">
                                    Status Prakerin: <br>
                                    <b>{{ $siswa->status }}</b> <br> <br>
                                    Status Permohonan: <br>
                                    <b>{{ $permohonan ? $permohonan->status : 'Belum mengajukan' }}</b> <br> <br>
                                    Status Laporan: <br>
                                    <b>
                                        @if ($bimbingan)
                                            @if ($bimbingan->status == 'Revisi')
                                                Perlu Revisi
                                            @elseif ($bimbingan->status == 'ACC')
                                                Telah Disetujui
                                            @else
                                                {{ $bimbingan->status }}
                                            @endif
                                        @else
                                            Belum ada laporan
                                        @endif
                                    </b> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="isi-profil" style="padding-left: 14px; padding-right: 14px; padding-bottom: 12px">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="text-start">
                                        Profil
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    @if (Auth::user()->image)
                                        <figure class="img-profile"
                                            style="background-image: url(data:image/png;base64,{{ base64_encode(Auth::user()->image) }});
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: center;
                                            width: 90px;
                                            height: 120px;">
                                        </figure>
                                    @else
                                        <figure class="img-profile"
                                            style="font-size: 60px;
                                            width: 90px;
                                            height: 120px;
                                            line-height: 120px; /* Sesuaikan dengan tinggi gambar */
                                            text-align: center;
                                            color: #000000;
                                            background-color: #d4d4d4;
                                            overflow: hidden;">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </figure>
                                    @endif
                                </div>

                                <div class="col-8" style="padding-top: 20px; padding-left: 0px;">
                                    {{ isset($siswa->name) ? $siswa->name : '' }}
                                    <br>{{ isset($siswa->name) ? $siswa->NIS : '' }}
                                    <br>{{ isset($siswa->name) ? $siswa->email : '' }}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p class="card-text text-center mt-1">
                            {{ isset($siswa->jurusan)
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
                                : '' }}
                            <br>SMK Negeri 1 Adiwerna
                        </p>
                    </div>
                </div>
                @if ($siswa->status === 'Selesai Prakerin')
                    <div class="card" style="margin-top: 12px; padding: 16px 16px">
                        <p class="card-text text-center mt-1">
                            Nilai Prakerin
                        </p>
                        <p class="card-text text-center mt-1">
                            {{ $siswa->nilai }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="judulcard mb-5 mt-5">
        Informasi
    </div>
    <div class="card-group" style="margin-bottom: 13vh">
        <div class="col-4">
            <div class="card ms-4 shadow">
                <div class="card-body">
                    <p class="card-title">
                        Permohonan Prakerin
                    </p>
                    <p align="justify" class="card-text mt-4">Siswa melakukan Pendaftaran Prakerin melalui menu Permohonan
                        Prakerin dengan mengisi beberapa data untuk menunjang keberjalanan pendaftaran Prakerin.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card ms-4 shadow">
                <div class="card-body">
                    <p class="card-title">
                        Pengisian Jurnal
                    </p>
                    <p align="justify" class="card-text mt-4">Siswa melakukan pengisian jurnal harian dengan mengisi
                        tanggal kegiatan dan keterangan kegiatan yang dilakukan pada hari tersebut.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card ms-4 me-4 shadow">
                <div class="card-body">
                    <p class="card-title">
                        Pengumpulan Laporan
                    </p>
                    <p align="justify" class="card-text mt-4">Siswa melakukan pengumpulan Laporan Akhir Prakerin dalam
                        bentuk link google drive untuk proses bimbingan dengan Guru Pembimbing.</p>
                </div>
            </div>
        </div>
    </div>
@stop
