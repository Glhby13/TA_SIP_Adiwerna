@extends('guru.layout')
@section('jurnaldata')

    {{-- <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}
<style>

    #dataTable th:first-child {
            position: relative;
        }

        #dataTable th:first-child input {
            position: absolute;
            margin: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #dataTable th:first-child::before,
        #dataTable th:first-child::after {
            display: none !important;
            cursor: unset !important;
        }
    
</style>

    <body>
        <div class="Judul mb-4">
            <a href="{{ route('guru.siswabimbingan') }}"><i style="padding-right: 2vh; color: #000000"
                class="fas fa-chevron-left"></i></a>
            Data Siswa Bimbingan
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Data Jurnal Siswa
                </p>
                <p class="sub-judul m-0">
                    Nama : {{ $siswa->name }}
                </p>
                <p class="sub-judul m-0">
                    NIS : {{ $siswa->NIS}}
                </p>
                <p class="sub-judul m-0">
                    Kelas : {{ $siswa->kelas}}
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th data-orderable="false" style="width: 200px; cursor: unset !important;">Tanggal</th>
                                <th data-orderable="false">Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurnals as $data)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                <td><?= $data['deskripsi'] ?></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
@stop

