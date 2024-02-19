@extends('admin.layout')
@section('dataguruedit')

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Temukan tombol "Reset" berdasarkan ID
            var resetButton2 = document.getElementById("resetButton2");

            // Temukan semua input fields berdasarkan ID
            var nilaiInput = document.getElementById("nilai");

            // Tambahkan event listener ke tombol "Reset"
            resetButton2.addEventListener("click", function() {
                // Reset nilai semua input fields
                nilaiInput.value = "{{ $dataBimbingan['siswa']->nilai }}";
            });
        });
    </script>

    <body>
        <div class="Judul mb-4">
            <a href="{{ route('admin.datapembagianbimbingan') }}"><i style="padding-right: 2vh; color: #000000"
                    class="fas fa-chevron-left"></i></a>
            Edit Data Bimbingan
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
        <div class="card shadow" style="margin-top: 50px">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Edit Data
                </p>
            </div>
            <form method="POST" action="{{ route('admin.datapembagianbimbinganedit', $dataBimbingan->id) }}">
                @csrf
                <div class="card-body mt-3 mb-3">
                    <div class="row mr-4 ml-4">
                        <div class="col-6" style="padding-right: 100px">
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">NIS</label>
                                <input type="text" class="form-control" name="NIS" id="NIS"
                                    value="{{ $dataBimbingan->NIS }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Nama Siswa</label>
                                <input type="text" class="form-control" name="name" id="namesiswa"
                                    value="{{ $dataBimbingan->siswa->name }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Jurusan</label>
                                <input type="text" class="form-control" name="jurusan" id="jurusan"
                                    value="{{ isset($dataBimbingan->siswa->jurusan) ? $jurusanMapping[$dataBimbingan->siswa->jurusan] : '' }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Tempat Prakerin</label>
                                <input type="text" class="form-control" name="tempat_prakerin" id="tempat_prakerin"
                                    value="{{ $dataPermohonan->tempat_prakerin }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Nilai</label>
                                @if ($dataBimbingan->status == 'ACC')
                                    <input type="number" class="form-control" pattern="[0-9]+" name="nilai" id="nilai" value="{{ $dataBimbingan['siswa']->nilai }}" max="100">
                                @else
                                    <input type="number" class="form-control" name="nilai" id="nilai" value="{{ $dataBimbingan['siswa']->nilai }}" readonly>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-6" style="padding-left:100px">
                            <div class="row mb-4">
                                <label class="form-label">NIP</label>
                                <input type="text" class="form-control" name="NIP" id="NIP"
                                    value="{{ $dataBimbingan->NIP }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Nama Guru Pembimbing</label>
                                <input type="text" class="form-control" name="name" id="nameguru"
                                    value="{{ $dataBimbingan->guru->name }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <div class="btnedit" style="justify-content: end; display: flex; margin-top: 22vh">
                                    <button type="button" class="btn" id="resetButton2"
                                        style="background-color: #EF4F4F; color: #ffffff">Reset</button>
                                    <button type="submit" class="btn"
                                        style="background-color: #44B158; color: #ffffff; margin-left: 16px;">save
                                        Change</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </body>

@stop
