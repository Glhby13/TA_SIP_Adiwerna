@extends('guru.layout')
@section('siswabimbingan')

    {{-- <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

    <body>
        <div class="Judul mb-4">Data Siswa Bimbingan</div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Data Siswa Bimbingan
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tempat Prakerin</th>
                                <th>Jumlah Hari Jurnal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($dataBimbingans as $data)
                            <tr>
                                <td>{{ $data['siswa']->NIS }}</td>
                                <td>{{ $data['siswa']->name }}</td>
                                <td>{{ $data['permohonan']->tempat_prakerin }}</td>
                                <td>{{ $data['jurnalCount'] }}</td>
                                <td>
                                    <a href="{{ route('guru.jurnaldata', $data['siswa']->NIS) }}">
                                        <button type="button" class="btn" style="background-color: #fe5a48; color: #ffffff; font-size: 16px;">
                                            Lihat
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

@stop

@section('script')
    <script>
        $('#dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": 4
            }]
        });
    </script>
@endsection
