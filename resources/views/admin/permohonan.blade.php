@extends('admin.layout')
@section('permohonan')

    <style>
        .alert-floating {
            position: fixed;
            max-width: 100%;
            /* Set maksimum lebar notifikasi sesuai lebar parent */
            width: auto;
            /* Biarkan lebar menyesuaikan isi notifikasi */
            top: 11vh;
            right: 7vh;
            z-index: 1050;
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


    <body>
        <div class="Judul">Permohonan Prakerin</div>
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
        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="margin-top: 4vh">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    List Data
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Tempat Prakerin</th>
                                <th>Balasan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPermohonan as $data)
                                <tr>
                                    <td>{{ $data->NIS }}</td>
                                    <td>{{ $data->siswa->name }}</td>
                                    <td style="width: 200px;">
                                        {{ isset($data->siswa->jurusan) ? $jurusanMapping[$data->siswa->jurusan] : '' }}
                                    </td>
                                    <td>{{ $data->tempat_prakerin }}</td>
                                    <td style="max-width: 200px;">
                                        <a href="{{ $data['balasan'] ?? '#' }}"
                                            target="_blank">{{ $data['balasan'] ?? ' ' }}</a>
                                    </td>
                                    <td><?= $data['status'] ?></td>
                                    <td style="min-width: 140px; max-width: 140px; width: 140px;">
                                        <div class="editdata">
                                            <button id="edit" type="button" class="btn edit-button"
                                                style="color: #000000">
                                                <a href="{{ route('admin.permohonaneditview', $data->id) }}"><i
                                                        class="far fa-edit" style="color: #000000"></i></a>
                                            </button>
                                            <button id="cetak" type="button" class="btn edit-button"
                                                style="color: #000000">
                                                <a href="{{ route('admin.suratpermohonan', $data->id) }}"><i
                                                        class="fa-solid fa-print" style="color: #000000"></i></a>
                                            </button>
                                            <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                                data-target="#modalStatus{{ $data->id }}">
                                                <i class="fa-solid fa-arrows-rotate"></i>
                                            </button>
                                            {{-- <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                        data-target="#modalHapus{{ $data->id }}">
                                            <i class="far fa-trash-alt"></i>
                                        </button> --}}

                                            <div class="modal fade" id="modalStatus{{ $data->id }}" role="dialog"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">

                                                        <form method="POST"
                                                            action="{{ route('status.permohonan', $data->id) }}">
                                                            @csrf
                                                            <p
                                                                style="display: flex; align-items:center; justify-content:center; 
                                                    text-align:center; font-weight:600; font-size:20px; margin-top: 1rem;">
                                                                Ubah status permohonan prakerin siswa</p>
                                                            <div class="modalfoot mt-3 mb-3"
                                                                style="display:flex; justify-content: center; align-items:center;">
                                                                <button type="submit" class="btn ml-2" name="btnMengajukan"
                                                                    style="background-color: #efaa4f; color: #ffffff; font-size: 16px; 
                                                        font-family: Poppins;">Mengajukan</button>
                                                                <button type="submit" class="btn ml-2" name="btnDiterima"
                                                                    style="background-color: #44B158; color: #ffffff; font-size: 16px; 
                                                        font-family: Poppins;">Diterima</button>
                                                                <button type="button" class="btn ml-2"
                                                                    style="background-color: #ff0000; 
                                                        color: #ffffff; font-size: 16px; 
                                                        font-family: Poppins;"
                                                                    data-toggle="modal"data-target="#modalHapus{{ $data->id }}">Ditolak
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="modalHapus{{ $data->id }}" role="dialog"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body"
                                                            style="display: flex; align-items:center; justify-content:center; text-align:center; ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="50"
                                                                height="50" style="color:#EF4F4F" fill="currentColor"
                                                                class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                <path
                                                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                                            </svg>
                                                        </div>
                                                        <form method="POST"
                                                            action="{{ route('hapus.permohonan', $data->id) }}">
                                                            @csrf
                                                            <p
                                                                style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
                                                                Apakah Anda yakin ingin menghapus data?</p>
                                                            <div class="modalfoot mt-3 mb-3"
                                                                style="display:flex; justify-content: center; align-items:center;">
                                                                <button type="button" class="btn mr-2" data-dismiss="modal"
                                                                    style="background-color: #EF4F4F; color: #ffffff; font-size: 16px; font-family: Poppins;">Tidak</button>
                                                                <button type="submit" class="btn ml-2"
                                                                    style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Ya,
                                                                    Hapus Saja!</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                "targets": 6
            }]
        });
    </script>
@endsection
