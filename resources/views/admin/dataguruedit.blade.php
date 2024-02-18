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
            var nip2Input = document.getElementById("NIP2");
            var name2Input = document.getElementById("name2");
            var kuota2Input = document.getElementById("kuota_bimbingan2");
            var telp2Input = document.getElementById("telp2");
            var email2Input = document.getElementById("email2");
            // var password_confirmationInput = document.getElementById("password_confirmation");

            // Tambahkan event listener ke tombol "Reset"
            resetButton2.addEventListener("click", function() {
                // Reset nilai semua input fields
                nip2Input.value = "{{ $guru->NIP }}";
                name2Input.value = "{{ $guru->name }}";
                kuota2Input.value = "{{ $guru->kuota_bimbingan }}";
                telp2Input.value = "{{ $guru->telp }}";
                email2Input.value = "{{ $guru->email }}";
                // password_confirmationInput.value = "";
            });
        });
    </script>

    <body>
        <div class="Judul mb-4">
            <a href="{{ route('admin.dataguru') }}"><i style="padding-right: 2vh; color: #000000"
                    class="fas fa-chevron-left"></i></a>
            Edit Data Guru Pembimbing
        </div>
        <div class="card shadow" style="margin-top: 50px">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Edit Data
                </p>
            </div>
            <form method="POST" action="{{ route('admin.dataguruedit', $guru->id) }}">
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
                                <label class="form-label" style="color: #000000;">NIP</label>
                                @if ($bimbingan->isEmpty()) {{-- Check if guru has no data in bimbingan table --}}
                                    <input type="text" class="form-control" name="NIP" id="NIP2" value="{{ $guru->NIP }}">
                                @else
                                    <input type="text" class="form-control" name="NIP" id="NIP2" value="{{ $guru->NIP }}" readonly>
                                @endif
                            </div>                                                  
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Nama
                                    Guru Pembimbing</label>
                                <input type="text" class="form-control" name="name" id="name2"
                                    value="{{ $guru->name }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Kuota Bimbingan</label>
                                <input type="text" class="form-control" pattern="[0-9]+" name="kuota_bimbingan" id="kuota_bimbingan2"
                                    value="{{ $guru->kuota_bimbingan }}">
                            </div>
                        </div>
                        <div class="col-6" style="padding-left:100px">
                            <div class="row mb-4">
                                <label class="form-label">No. Telp</label>
                                <input type="text" class="form-control" name="telp" id="telp2"
                                    value="{{ $guru->telp }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email2"
                                    value="{{ $guru->email }}">
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
