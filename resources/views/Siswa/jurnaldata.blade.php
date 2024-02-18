@extends('siswa.layout')
@section('jurnal')

    <!-- Tambahkan script Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>



    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/vendor/datatables-demo.js') }}"></script>

    <style>
        .alert-floating {
            position: fixed;
            max-width: 100%;
            /* Set maksimum lebar notifikasi sesuai lebar parent */
            width: auto;
            /* Biarkan lebar menyesuaikan isi notifikasi */
            top: 11vh;
            right: 7vh;
        }

        .success-floating {
            position: fixed;
            transform: translate(-50%, -50%);
            z-index: 1050;
            width: 40vh;
            top: 50%;
            left: 50%;
        }

        .back-icon {
            position: absolute;
            font-size: 36px;
            top: 100px;
            padding-left: 15px;
        }

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


    <link href="{{ asset('assets/css/siswa/jurnal.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">

    <style>
        /* Ganti warna teks placeholder menjadi merah (contoh) */
        input[readonly]::placeholder {
            color: rgb(194, 194, 194);
            /* Ganti dengan warna yang Anda inginkan */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan tombol "Reset" berdasarkan ID
            var resetButton = document.getElementById("resetButton");

            // Temukan semua input fields berdasarkan ID
            var date = document.getElementById("date");
            var deskripsi = document.getElementById("deskripsi");

            // Tambahkan event listener ke tombol "Reset"
            resetButton.addEventListener("click", function() {
                // Reset nilai semua input fields
                date.value = "";
                deskripsi.value = "";
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan elemen input tanggal
            var dateInput = document.getElementById("date");

            // Inisialisasi Flatpickr dengan format yang diinginkan
            flatpickr(dateInput, {
                dateFormat: "d-m-Y",
                placeholder: "dd-mm-yyyy",
            });
        });
    </script>


    <div class="judul">
        <span style="color: #000000">Data</span>
        <span style="color :#44B158">Jurnal</span>
    </div>
    <div class="back-icon">
        <a href="{{ route('siswa.jurnal') }}" style="float: left; margin-left: 200px; color: #000000">
            <i class="fas fa-chevron-left" style="font-size: 30px;"></i>
        </a>
    </div>
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
    <div class="container-fluid" style="padding-top: 60px; padding-bottom: 90px">
        <div class="card-body" style="padding-inline: 200px">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-ordering="false">
                    <thead>
                        <tr>
                            <th style="width: 200px; cursor: unset !important;">Tanggal</th>
                            <th data-orderable="false">Kegiatan</th>
                            <th style="width: 90px;" data-orderable="false">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jurnals as $data)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                <td><?= $data['deskripsi'] ?></td>
                                <td style="width: 90px;">
                                    <div class="editdata">
                                        <button id="edit" type="button" class="btn edit-button">
                                            <a href="{{ route('siswa.jurnaldataeditview', $data->id) }}"><i
                                                    class="far fa-edit" style="color: #000000"></i></a>
                                        </button>
                                        <button id="delete" type="button" class="btn delete-button"
                                            style="color: #000000" data-toggle="modal"
                                            data-target="#modalHapus{{ $data->id }}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

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
                                                        action="{{ route('siswa.jurnaldelete', $data->id) }}">
                                                        @csrf
                                                        @method('DELETE')
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
@stop
