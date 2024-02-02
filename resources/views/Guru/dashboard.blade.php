@extends('guru.layout')
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

    <div class="alert alert-success d-flex align-items-center" role="alert" id="notification">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="ms-2 bi bi-check-circle"
            viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path
                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
        </svg>
        <div style="margin-left: 20px">
            Selamat datang, {{ isset($guru->name) ? $guru->name : '' }} di Sistem Informasi Prakerin!
        </div>

        <button class="btn btn-close" aria-label="Close" data-dismis="alert" style="margin-left: auto;"></button>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('guru.siswabimbingan') }}" class="card-link">
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
                        <p class="keterangan">Siswa Bimbingan</p>
                        <div class="circle1">
                            <p class="data"><p class="data">{{ count($dataBimbingans) }}</p></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
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
                    <p class="keterangan">Laporan Belum Diperiksa</p>
                    <div class="circle2">
                        <p class="data">{{ count(array_filter($dataBimbingans, function($data) {
                            return $data['bimbingan']['status'] === 'Belum Diperiksa';
                        })) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card3 shadow">
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
                    <p class="keterangan">Laporan Revisi</p>
                    <div class="circle3">
                        <p class="data">{{ count(array_filter($dataBimbingans, function($data) {
                            return $data['bimbingan']['status'] === 'Revisi';
                        })) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card4 shadow">
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
                    <p class="keterangan">Laporan ACC</p>
                    <div class="circle4">
                        <p class="data">{{ count(array_filter($dataBimbingans, function($data) {
                            return $data['bimbingan']['status'] === 'ACC';
                        })) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #F4DDDD">
            <p class="sub-judul m-0">
                Data Bimbingan
            </p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>No. Telp Siswa</th>
                            <th>Tempat Prakerin</th>
                            <th>Alamat Tempat Prakerin</th>
                            <th>No. Telp Tempat Prakerin</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataBimbingans as $data)
                            <tr>
                                <td>{{ $data['siswa']->NIS }}</td>
                                <td>{{ $data['siswa']->name }}</td>
                                <td>{{ $data['siswa']->kelas }}</td>
                                <td>{{ $data['siswa']->telp }}</td>
                                <td>{{ $data['permohonan']->tempat_prakerin }}</td>
                                <td>{{ $data['permohonan']->alamat_tempat_prakerin }}</td>
                                <td>{{ $data['permohonan']->telp_tempat_prakerin }}</td>
                                <td>{{ $data['bimbingan']->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#dataTable').DataTable({
            "columnDefs": [{
                "orderable": false, "targets": [ ]
            }]
        });
    </script>
@endsection
