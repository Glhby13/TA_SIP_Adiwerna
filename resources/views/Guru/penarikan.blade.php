@extends('guru.layout')
@section('penarikan')

    <body>

        <div class="Judul mb-4">Surat Penarikan</div>

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
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>No. Telp Siswa</th>
                                <th>Tempat Prakerin</th>
                                <th>No. Telp Tempat Prakerin</th>
                                <th>Action</th>
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
                                    <td>{{ $data['permohonan']->telp_tempat_prakerin }}</td>
                                    <td style="display: flex; justify-content: center; align-item:center;">
                                        <a href="{{ route('guru.suratpenarikan', $data['bimbingan']->id) }}"><button
                                                type="button" class="btn" style="color: #000000;">
                                                <i class="fa-solid fa-print" style="color: #000000"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="cetakitem">
                    <button type="button" class="btn mt-3"
                        style="background-color: #4f4e4c; color: #ffffff; font-size: 16px;" data-toggle="modal"
                        data-target="#modalCetakitem">Print Item</button>

                    <div class="modal fade" id="modalCetakitem" role="dialog" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body"
                                    style="display: flex; align-items:center; justify-content:center; text-align:center; ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                        style="color:#44B158" fill="currentColor" class="bi bi-check2-circle"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                        <path
                                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                    </svg>
                                </div>
                                <p
                                    style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
                                    Data berhasil dipulihkan</p>
                                <div class="modalfoot  mb-3"
                                    style="display:flex; justify-content: center; align-items:center;">
                                    <button type="button" class="btn" data-dismiss="modal"
                                        style="background-color: #A4A6B9; color: #ffffff; font-size: 16px;">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </body>
@stop



@section('script')
    <script>
        $('#dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 5]
            }]
        });
    </script>
@endsection
