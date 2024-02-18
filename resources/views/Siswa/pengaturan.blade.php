@extends ('siswa.layout')
@section('pengaturan')
    <link href="{{ asset('assets/css/siswa/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/siswa/pengaturan.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    


    <div class="judul mb-5">
        <span style="color: #000000">Edit</span>
        <span style="color :#44B158">Profil</span>
    </div>

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
            // Temukan tombol "Reset" berdasarkan ID
            var resetButton = document.getElementById("resetButton");

            // Temukan semua input fields berdasarkan ID
            var telpInput = document.getElementById("telp");
            var emailInput = document.getElementById("email");
            // var password_confirmationInput = document.getElementById("password_confirmation");

            // Tambahkan event listener ke tombol "Reset"
            resetButton.addEventListener("click", function() {
                // Reset nilai semua input fields
                telpInput.value = "{{ $siswa->telp }}";
                emailInput.value = "{{ $siswa->email }}";
            });
        });
    </script>
    

    <!-- Script untuk Avatar Preview -->
    <script>
        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                        $('#imagePreview').removeAttr('data-initial');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Pastikan #imageUpload ada di dalam form sebelum menambahkan event listener
            $("#imageUpload").change(function() {
                readURL(this);
            });
        });
    </script>

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



    <form action="{{ route('edit.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid" style="padding-top: 20px; margin-bottom: 90px">
            <div class="row">
                <div class="col-4">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="oldImage" value="{{ asset($siswa->image) }}">
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            @if ($siswa->image)
                                <div id="imagePreview" class="rounded-circle avatar"
                                    style="background-image: url(data:image/png;base64,{{ base64_encode(Auth::user()->image) }}); 
                                    height: 180px; width: 180px;">
                                </div>
                            @else
                                <div id="imagePreview" class="rounded-circle avatar avatar font-weight-bold"
                                    style="background-image: url(''); font-size: 60px; height: 180px; width: 180px;"
                                    data-initial="{{ $siswa->name[0] }}"></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-4" style="padding-right: 70px">
                    <div class="row mb-4">
                        <label for="Nama" class="form-label">Nama Lengkap</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                placeholder="{{ isset($siswa->name) ? $siswa->name : '' }}"
                                aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="NIS" class="form-label">NIS</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                placeholder="{{ isset($siswa->NIS) ? $siswa->NIS : '' }}"
                                aria-label="readonly input example" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="Jurusan" class="form-label">Jurusan</label>
                        <div class="text-field">
                            <input class="form-control" style="font-size: 14px;" type="text"
                                placeholder="{{ isset($siswa->jurusan)
                                    ? match ($siswa->jurusan) {
                                        'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
                                        'TE' => 'Teknik Elektronika',
                                        'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                                        'TK' => 'Teknik Ketenagalistrikan',
                                        'TM' => 'Teknik Mesin',
                                        'TKRO' => 'Teknik Kendaraan Ringan dan Otomotif',
                                        'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
                                        default => '',
                                    }
                                    : '' }}"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="padding-right: 70px">
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


                    <div class="row mb-4">
                        <label for="No. Telp" class="form-label">No. Telp</label>
                        <div class="text-field">
                            <input name="telp" class="form-control" style="font-size: 14px" type="text" id="telp"
                                placeholder="Masukkan No. Telepon" value="{{ $siswa->telp }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="text-field">
                            <input name="email" class="form-control" style="font-size: 14px" type="text" id="email"
                                placeholder="Masukkan Email" value="{{ $siswa->email }}">
                        </div>
                    </div>
                    <div class="btnpermohonan" style="justify-content: end; display: flex; padding-top:5vh">
                        <button type="button" class="btn" id="resetButton"
                            style="background-color: #EF4F4F; color: #ffffff">Reset</button>
                        <button type="submit" name="submit" class="btn custom-button"
                            style="background-color: #44B158; color: #ffffff; margin-left: 10px">Save Change</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection

{{-- @section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                    $('#imagePreview').removeAttr('data-initial');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>

    <script>
        function limitInputLength(element, maxLength) {
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }
    </script>
@endsection --}}
