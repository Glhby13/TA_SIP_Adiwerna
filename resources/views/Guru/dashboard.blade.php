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

    <div class="card shadow mb-4 " style="background-color: #EEF5FF">
        <div class="card-body mb-1">
            <p style="line-height: 1"><b>SELAMAT DATANG, {{ isset($guru->name) ? $guru->name : '' }}!</b></p>
            <p class="mb-1" style="line-height: 1;">Anda login sebagai Guru Pembimbing program keahlian {{ $jurusanmapping[$guru->jurusan] }}</p>
        </div>
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
                            <p class="data">
                            <p class="data">{{ count($dataBimbingans) }}</p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('guru.pengumpulanlaporan', ['tab' => 'belumdiperiksa']) }}" class="card-link">
                <div class="card2 shadow">
                    <div class="card-body">
                        <p class="keterangan">Laporan Belum Diperiksa</p>
                        <div class="circle2">
                            <p class="data">
                                {{ count(
                                    array_filter($dataBimbingans, function ($data) {
                                        return $data['bimbingan']['status'] === 'Sudah Mengumpulkan';
                                    }),
                                ) }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('guru.pengumpulanlaporan', ['tab' => 'revisi']) }}" class="card-link">
                <div class="card3 shadow">
                    <div class="card-body">
                        <p class="keterangan">Laporan Perlu Revisi</p>
                        <div class="circle3">
                            <p class="data">
                                {{ count(
                                    array_filter($dataBimbingans, function ($data) {
                                        return $data['bimbingan']['status'] === 'Revisi';
                                    }),
                                ) }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('guru.pengumpulanlaporan', ['tab' => 'acc']) }}" class="card-link">
                <div class="card4 shadow">
                    <div class="card-body">
                        <p class="keterangan">Laporan Telah Disetujui</p>
                        <div class="circle4">
                            <p class="data">
                                {{ count(
                                    array_filter($dataBimbingans, function ($data) {
                                        return $data['bimbingan']['status'] === 'ACC';
                                    }),
                                ) }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #e5e5e5">
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
                                <td>
                                    @if ($data['bimbingan']->status === 'Sudah Mengumpulkan')
                                        Belum Diperiksa
                                    @elseif ($data['bimbingan']->status === 'Belum Mengumpulkan')
                                        Siswa belum mengumpulkan
                                    @elseif ($data['bimbingan']->status === 'Revisi')
                                        Perlu Revisi
                                    @elseif ($data['bimbingan']->status === 'ACC')
                                        Telah Disetujui
                                    @else
                                        {{ $data['bimbingan']->status }}
                                    @endif
                                </td>
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
                "orderable": false,
                "targets": []
            }]
        });
    </script>
@endsection
