@extends('admin.layout')
@section('dashboard')

    <script>
        $(document).ready(function() {
            // Mendapatkan URL halaman sebelumnya
            var previousPage = document.referrer;

            // Mendapatkan elemen notifikasi dan tombol tutup berdasarkan ID
            var notification = $("#notification");
            var closeButton = notification.find(".btn-close");
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
                notification.addClass("d-flex").show();
            } else {
                // Jika status notifikasi adalah "closed", maka sembunyikan notifikasi
                notification.removeClass("d-flex").hide();
                localStorage.setItem("notificationStatus", "closed");
            }

            // Tambahkan event listener ke tombol tutup
            closeButton.on("click", function() {
                // Menghapus kelas .d-flex dan mengubah properti display menjadi "none"
                notification.removeClass("d-flex").hide();
                localStorage.setItem("notificationStatus", "closed");
            });
        });
    </script>

    {{-- <div class="alert alert-success d-flex align-items-center" role="alert" id="notification">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="ms-2 bi bi-check-circle"
            viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path
                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
        </svg>
        <div style="margin-left: 20px">
            Selamat datang, Admin di Sistem Informasi Prakerin!
        </div>

        <button class="btn btn-close" aria-label="Close" data-dismis="alert" style="margin-left: auto;"></button>
    </div> --}}

    <div class="card shadow mb-4 " style="background-color: #EEF5FF">
        <div class="card-body mb-1">
            <p style="line-height: 1"><b>SELAMAT DATANG, {{ isset($admin->name) ? $admin->name : '' }}!</b></p>
    
            @if ($admin->jurusan)
                <p class="mb-1" style="line-height: 1;">Anda login sebagai {{ isset($admin->name) ? $admin->name : '' }}
                    program keahlian {{ $jurusanmapping[$admin->jurusan] }}</p>
            @else
                <p class="mb-1" style="line-height: 1;">Anda login sebagai {{ isset($admin->name) ? $admin->name : '' }}</p>
            @endif
        </div>
    </div>
    

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            {{-- <a href="{{ route('guru.siswabimbingan') }}" class="card-link"> --}}
            <div class="card1 shadow">
                <div class="card-body">
                    {{-- <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div> --}}
                    <p class="keterangan">Jumlah Siswa</p>
                    <div class="circle1">
                        <p class="data">{{ $jumlahSiswa }}</p>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <a href="{{ route('admin.dataguru') }}" class="card-link">
                <div class="card2 shadow">
                    <div class="card-body">
                        {{-- <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div> --}}
                        <p class="keterangan">Jumlah Guru Pembimbing</p>
                        <div class="circle2">
                            <p class="data">{{ $jumlahGuruPembimbing }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        {{-- <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('admin.permohonan') }}" class="card-link">
                <div class="card3 shadow">
                    <div class="card-body">
                        <p class="keterangan">Jumlah Permohonan Prakerin</p>
                        <div class="circle3">
                            <p class="data">{{ $jumlahPermohonan }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>

    <!-- DataTales Example -->
    {{-- <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #F4DDDD">
            <p class="sub-judul m-0">
                Penjelasan Fitur
            </p>
        </div>
        <div class="card-body mr-5 ml-2">
            <p class=" mb-2">Terdapat beberapa fitur yang ada pada admin, yaitu :</p>
            <ul style="list-style-type: decimal; font-weight: bold">
                <li class="mb-1">Dashboard</li>
                <p style="font-weight: 500;">Dashboard merupakan tampilan utama dari admin, berisikan tentang jumlah
                    data dari masing-masing fitur</p>
                <li>Permohonan Prakerin</li>
                <p style="font-weight: 500; text-align: justify">Fitur Permohonan Prakerin berisikan tentang list data siswa
                    yang mengajukan
                    prakerin, untuk bisa diproses seperti cetak surat permohonan, ubah status permohonan, dan edit data
                    permohonan. </p>
            </ul>
        </div>
    </div> --}}
    <div class="row mb-3">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Prakerin Siswa</h6>
                </div>
                <div class="card-body">
                    @foreach ($jumlahStatusPrakerinSiswa as $status => $jumlah)
                        <h4 class="small font-weight-bold">{{ $status }} <span class="float-right">{{ $jumlah }}
                                Siswa</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar @if ($status === 'Belum Mendaftar') bg-danger @elseif($status === 'Sudah Mendaftar') bg-warning @elseif($status === 'Selesai Prakerin') bg-info @endif"
                                role="progressbar" style="width: {{ ($jumlah / $jumlahSiswa) * 100 }}%"
                                aria-valuenow="{{ ($jumlah / $jumlahSiswa) * 100 }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Permohonan Siswa</h6>
                </div>
                <div class="card-body">
                    @foreach ($jumlahStatusPermohonanSiswa as $status => $jumlah)
                        <h4 class="small font-weight-bold">{{ $status }} <span class="float-right">{{ $jumlah }} Siswa</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar
                                @if ($status === 'Mengajukan') bg-danger
                                @elseif($status === 'Diterima') bg-warning
                                @endif"
                                role="progressbar" style="width: {{ ($jumlah / $jumlahSiswa) * 100 }}%"
                                aria-valuenow="{{ ($jumlah / $jumlahSiswa) * 100 }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
    @if (Auth::user()->jurusan !== null)
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kuota Guru</h6>
                </div>
                <div class="card-body">
                    @foreach ($guru as $guruItem)
                    <h4 class="small font-weight-bold">{{ $guruItem->name }} 
                        <span class="float-right">
                            {{ $jumlahBimbinganGuru[$guruItem->NIP] }} / {{ $guruItem->kuota_bimbingan }} Siswa
                        </span>
                    </h4>
                        <div class="progress mb-4">
                            @php
                                $percentage = ($jumlahBimbinganGuru[$guruItem->NIP] / $guruItem->kuota_bimbingan) * 100;
                            @endphp
                            <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%; background-color: #2F9599"
                                aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif



@stop
