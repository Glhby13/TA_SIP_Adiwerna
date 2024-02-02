@extends('guru.layout')
@section('pengumpulanlaporan')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

    <body>
        <div class="Judul mb-4">Pengumpulan Laporan Prakerin</div>
        <ul id="tabs" class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a href="#belumdiperiksa" data-target="#belumdiperiksa" data-toggle="tab" class="nav-link active">Belum
                    Diperiksa</a>
            </li>
            <li class="nav-item">
                <a href="#revisi" data-target="#revisi" data-toggle="tab" class="nav-link ">Revisi</a>
            </li>
            <li class="nav-item">
                <a href="#sudahdirevisi" data-target="#sudahdirevisi" data-toggle="tab" class="nav-link ">Sudah Direvisi</a>
            </li>
            <li class="nav-item">
                <a href="#acc" data-target="#acc" data-toggle="tab" class="nav-link ">ACC</a>
            </li>
        </ul>
        <div id="tabscontent" class="tab-content tab-border rounded">
            <div id="belumdiperiksa" class="tab-pane fade show active">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <p class="sub-judul m-0">
                            Laporan Belum Diperiksa
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableBelumDiperiksa" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tempat Prakerin</th>
                                        <th>Link Laporan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBimbingans as $data)
                                        @if ($data['bimbingan']->status == 'Sudah Mengumpulkan')
                                            <tr>
                                                <td>{{ $data['siswa']->NIS }}</td>
                                                <td>{{ $data['siswa']->name }}</td>
                                                <td>{{ $data['siswa']->kelas }}</td>
                                                <td>{{ $data['permohonan']->tempat_prakerin }}</td>
                                                <td>
                                                    <a href="{{ $data['bimbingan']->laporan }}" target="_blank">
                                                        {{ $data['bimbingan']->laporan }}
                                                    </a>
                                                </td>
                                                <td style="min-width: 140px; max-width: 140px; width: 140px;">
                                                    <div class="editdata">
                                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                                        data-target="#modalStatus{{ $data['bimbingan']->id }}">
                                                        <i class="far fa-edit" style="color: #000000"></i>
                                                        </button>
                                                        <div class="modal fade"  id="modalStatus{{ $data['bimbingan']->id }}" role="dialog" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    
                                                                    <form method="POST" action="{{ route('status.laporan', $data['bimbingan']->id) }}">
                                                                        @csrf
                                                                    <p style="display: flex; align-items:center; justify-content:center; 
                                                                    text-align:center; font-weight:600; font-size:20px; margin-top: 1rem;">
                                                                        Ubah status laporan prakerin siswa</p>
                                                                    <div class="modalfoot mt-3 mb-3"
                                                                        style="display:flex; justify-content: center; align-items:center;">
                                                                        <button type="submit" class="btn ml-2" name="btnRevisi"
                                                                        style="background-color: #efaa4f; color: #ffffff; font-size: 16px; 
                                                                        font-family: Poppins;">Revisi</button>
                                                                    <button type="submit" class="btn ml-2" name="btnACC"
                                                                        style="background-color: #44B158; color: #ffffff; font-size: 16px; 
                                                                        font-family: Poppins;">ACC</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="revisi" class="tab-pane fade">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <p class="sub-judul m-0">
                            Laporan Revisi
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableRevisi" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tempat Prakerin</th>
                                        <th>Link Laporan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBimbingans as $data)
                                        @if ($data['bimbingan']->status == 'Revisi')
                                            <tr>
                                                <td>{{ $data['siswa']->NIS }}</td>
                                                <td>{{ $data['siswa']->name }}</td>
                                                <td>{{ $data['siswa']->kelas }}</td>
                                                <td>{{ $data['permohonan']->tempat_prakerin }}</td>
                                                <td>
                                                    <a href="{{ $data['bimbingan']->laporan }}" target="_blank">
                                                        {{ $data['bimbingan']->laporan }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sudahdirevisi" class="tab-pane fade">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <p class="sub-judul m-0">
                            Laporan Sudah Direvisi
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableSudahDirevisi" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tempat Prakerin</th>
                                        <th>Link Laporan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBimbingans as $data)
                                        @if ($data['bimbingan']->status == 'Sudah Revisi')
                                            <tr>
                                                <td>{{ $data['siswa']->NIS }}</td>
                                                <td>{{ $data['siswa']->name }}</td>
                                                <td>{{ $data['siswa']->kelas }}</td>
                                                <td>{{ $data['permohonan']->tempat_prakerin }}</td>
                                                <td>
                                                    <a href="{{ $data['bimbingan']->laporan }}" target="_blank">
                                                        {{ $data['bimbingan']->laporan }}
                                                    </a>
                                                </td>
                                                <td style="min-width: 140px; max-width: 140px; width: 140px;">
                                                    <div class="editdata">
                                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                                        data-target="#modalStatus{{ $data['bimbingan']->id }}">
                                                        <i class="far fa-edit" style="color: #000000"></i>
                                                        </button>
                                                        <div class="modal fade"  id="modalStatus{{ $data['bimbingan']->id }}" role="dialog" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    
                                                                    <form method="POST" action="{{ route('status.laporan', $data['bimbingan']->id) }}">
                                                                        @csrf
                                                                    <p style="display: flex; align-items:center; justify-content:center; 
                                                                    text-align:center; font-weight:600; font-size:20px; margin-top: 1rem;">
                                                                        Ubah status laporan prakerin siswa</p>
                                                                    <div class="modalfoot mt-3 mb-3"
                                                                        style="display:flex; justify-content: center; align-items:center;">
                                                                        <button type="submit" class="btn ml-2" name="btnRevisi"
                                                                        style="background-color: #efaa4f; color: #ffffff; font-size: 16px; 
                                                                        font-family: Poppins;">Revisi</button>
                                                                    <button type="submit" class="btn ml-2" name="btnACC"
                                                                        style="background-color: #44B158; color: #ffffff; font-size: 16px; 
                                                                        font-family: Poppins;">ACC</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="acc" class="tab-pane fade">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <p class="sub-judul m-0">
                            Laporan ACC
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableACC" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tempat Prakerin</th>
                                        <th>Link Laporan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBimbingans as $data)
                                        @if ($data['bimbingan']->status == 'ACC')
                                            <tr>
                                                <td>{{ $data['siswa']->NIS }}</td>
                                                <td>{{ $data['siswa']->name }}</td>
                                                <td>{{ $data['siswa']->kelas }}</td>
                                                <td>{{ $data['permohonan']->tempat_prakerin }}</td>
                                                <td>
                                                    <a href="{{ $data['bimbingan']->laporan }}" target="_blank">
                                                        {{ $data['bimbingan']->laporan }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            function initializeDataTable(tabId) {
                $('#' + tabId).find('table').DataTable();
                $('#' + tabId).find('table').show();
            }

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
                // Sembunyikan tabel-tabel yang tidak aktif
                $('#tabscontent .tab-pane').not($(e.target.hash)).find('.table').DataTable().destroy();
                $('#tabscontent .tab-pane').not($(e.target.hash)).find('.table').hide();

                // Inisialisasi DataTable pada tabel yang aktif
                var targetTableId = $(e.target).attr('href').replace('#', '');
                initializeDataTable(targetTableId);
            });

            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#tabs a[href="' + activeTab + '"]').tab('show');
                initializeDataTable(activeTab.replace('#', ''));
            }

            // Inisialisasi DataTable pada tabel yang aktif saat pertama kali halaman dimuat
            var initialTab = $('#tabs .nav-link.active').attr('href').replace('#', '');
            initializeDataTable(initialTab);
        });
    </script>
@endsection

