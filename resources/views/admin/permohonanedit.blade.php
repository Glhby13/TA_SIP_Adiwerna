@extends('admin.layout')
@section('permohonanedit')

<!-- Tambahkan script Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>

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
        var tempatprakerinInput = document.getElementById("tempat_prakerin");
        var alamattempatprakerinInput = document.getElementById("alamat_tempat_prakerin");
        var emailtempatprakerinInput = document.getElementById("email_tempat_prakerin");
        var telptempatprakerinInput = document.getElementById("telp_tempat_prakerin");
        var mulaiInput = document.getElementById("tanggal_mulai");
        var selesaiInput = document.getElementById("tanggal_selesai");

        // Tambahkan event listener ke tombol "Reset"
        resetButton2.addEventListener("click", function() {
            // Reset nilai semua input fields
            tempatprakerinInput.value = "{{ $dataPermohonan->tempat_prakerin }}";
            alamattempatprakerinInput.value = "{{ $dataPermohonan->alamat_tempat_prakerin }}";
            emailtempatprakerinInput.value = "{{ $dataPermohonan->email_tempat_prakerin }}";
            telptempatprakerinInput.value = "{{ $dataPermohonan->telp_tempat_prakerin }}";
            mulaiInput.value = "{{ $dataPermohonan->tanggal_mulai ? \Carbon\Carbon::parse($dataPermohonan->tanggal_mulai)->format('d-m-Y') : '' }}";
            selesaiInput.value = "{{ $dataPermohonan->tanggal_selesai ? \Carbon\Carbon::parse($dataPermohonan->tanggal_selesai)->format('d-m-Y') : '' }}";
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Temukan elemen input tanggal
        var mulaiInput = document.getElementById("tanggal_mulai");
        var selesaiInput = document.getElementById("tanggal_selesai");

        // Inisialisasi Flatpickr untuk input tanggal mulai
        flatpickr(mulaiInput, {
            dateFormat: "d-m-Y",
            placeholder: "dd-mm-yyyy",
            onClose: function (selectedDates, dateStr, instance) {
                // Setelah memilih tanggal mulai, batasi tanggal selesai
                if (selectedDates.length > 0) {
                    flatpickr(selesaiInput, {
                        dateFormat: "d-m-Y",
                        placeholder: "dd-mm-yyyy",
                        minDate: selectedDates[0],
                    });
                }
            },
        });

        // Inisialisasi Flatpickr untuk input tanggal selesai
        flatpickr(selesaiInput, {
            dateFormat: "d-m-Y",
            placeholder: "dd-mm-yyyy",
            // Tambahkan opsi untuk membatasi tanggal selesai jika tanggal mulai sudah diisi
            minDate: mulaiInput.value ? mulaiInput.value : null,
        });
    });
</script>


    <body>
        <div class="Judul mb-4">
            <a href="{{ route('admin.permohonan') }}"><i style="padding-right: 2vh; color: #000000"
                    class="fas fa-chevron-left"></i></a>
            Edit Data Permohonan
        </div>
        <div class="card shadow" style="margin-top: 50px">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Edit Data
                </p>
            </div>
            <form method="POST" action="{{ route('admin.permohonanedit', $dataPermohonan->id) }}">
                @csrf
                <div class="card-body mt-3 mb-3">
                    <div class="row mr-4 ml-4">
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
                        <div class="col-6" style="padding-right: 100px">
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">NIS</label>
                                <input type="text" class="form-control" name="NIS" id="NIS"
                                    value="{{ $dataPermohonan->NIS }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Nama
                                    Siswa</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $dataPermohonan->siswa->name }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Jurusan</label>
                                <input type="text" class="form-control" name="jurusan" id="jurusan"
                                    value="{{ isset($dataPermohonan->siswa->jurusan) ? $jurusanMapping[$dataPermohonan->siswa->jurusan] : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-6" style="padding-left:100px">
                            <div class="row mb-4">
                                <label class="form-label">Tempat Prakerin</label>
                                <input type="text" class="form-control" name="tempat_prakerin" id="tempat_prakerin"
                                    value="{{ $dataPermohonan->tempat_prakerin }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Alamat Tempat Prakerin</label>
                                <input type="text" class="form-control" name="alamat_tempat_prakerin" id="alamat_tempat_prakerin"
                                    value="{{ $dataPermohonan->alamat_tempat_prakerin }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Email Tempat Prakerin</label>
                                <input type="text" class="form-control" name="email_tempat_prakerin" id="email_tempat_prakerin"
                                    value="{{ $dataPermohonan->email_tempat_prakerin }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">No. Telp Tempat Prakerin</label>
                                <input type="text" class="form-control" name="telp_tempat_prakerin" id="telp_tempat_prakerin"
                                    value="{{ $dataPermohonan->telp_tempat_prakerin }}" pattern="[0-9]+" title="Hanya masukkan angka">
                            </div>
                            <div class="row mb-4">
                                <label for="date" class="form-label">Tanggal Mulai</label>
                                <input class="form-control" id="tanggal_mulai" name="tanggal_mulai" type="text" style="font-size: 14px; max-width:97%; margin-left:1.5%; background-color:unset;" 
                                placeholder="dd-mm-yyyy" value="{{ $dataPermohonan->tanggal_mulai ? \Carbon\Carbon::parse($dataPermohonan->tanggal_mulai)->format('d-m-Y') : '' }}">
                            </div>
                            <div class="row mb-4">
                                <label for="date" class="form-label">Tanggal Selesai</label>
                                <input class="form-control" id="tanggal_selesai" name="tanggal_selesai" type="text" style="font-size: 14px; max-width:97%; margin-left:1.5%; background-color:unset;" 
                                placeholder="dd-mm-yyyy" value="{{ $dataPermohonan->tanggal_selesai ? \Carbon\Carbon::parse($dataPermohonan->tanggal_selesai)->format('d-m-Y') : '' }}">
                            </div>
                            
                            <div class="btnedit" style="justify-content: end; display: flex">
                                <button type="button" class="btn" id="resetButton2"
                                    style="background-color: #EF4F4F; color: #ffffff">Reset</button>
                                <button type="submit" class="btn"
                                    style="background-color: #44B158; color: #ffffff; margin-left: 16px;">save
                                    Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>

@stop
