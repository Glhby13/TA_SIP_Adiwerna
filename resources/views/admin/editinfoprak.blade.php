@extends('admin.layout')
@section('editinfoprak')

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
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').css('background-image', 'url(' + e.target.result + ')');
                    $('#image-preview').hide();
                    $('#image-preview').fadeIn(650);
                    $('#image-preview').removeAttr('data-initial');

                    // Ganti isi atribut src pada tag img jika image sudah ada di database
                    $('#image-preview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Pastikan #image ada di dalam form sebelum menambahkan event listener
        $("#image").change(function() {
            readURL(this);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Temukan tombol "Reset" berdasarkan ID
        var resetButton = document.getElementById("resetButton");

        // Temukan semua input fields berdasarkan ID
        var namaInput = document.getElementById("nama_perusahaan");
        var deskripsiInput = document.getElementById("deskripsi");
        var posisiInput = document.getElementById("posisi");
        var jurusanInput = document.getElementById("jurusan");
        var persyaratanInput = document.getElementById("persyaratan");
        var emailInput = document.getElementById("email");
        var telpInput = document.getElementById("telp");
        var alamatInput = document.getElementById("alamat");

        // Temukan input file gambar
        var imageInput = document.getElementById("image");

        // Temukan elemen gambar preview
        var imagePreview = document.getElementById("image-preview-img");

        // Simpan URL gambar awal dari database (jika ada)
        var initialImage = "{{ $informasiTempatPrakerin->image }}";


        // Tambahkan event listener ke tombol "Reset"
        resetButton.addEventListener("click", function() {
            // Reset nilai semua input fields
            namaInput.value = "{{ $informasiTempatPrakerin->nama_perusahaan }}";
            deskripsiInput.value = "{{ $informasiTempatPrakerin->deskripsi }}";
            posisiInput.value = "{{ $informasiTempatPrakerin->posisi }}";
            jurusanInput.value = "{{ $informasiTempatPrakerin->jurusan }}";
            persyaratanInput.value = "{{ $informasiTempatPrakerin->persyaratan }}";
            emailInput.value = "{{ $informasiTempatPrakerin->email }}";
            telpInput.value = "{{ $informasiTempatPrakerin->telp }}";
            alamatInput.value = "{{ $informasiTempatPrakerin->alamat }}";

            // Reset nilai input file gambar
            imageInput.value = null;

            // Kembalikan gambar preview ke gambar awal
            if (initialImage) {
                imagePreview.src = "data:image/jpeg;base64," + initialImage;
            } else {
                imagePreview.src = "{{ asset('storage/images/no_image.jpg') }}";
            }

            // Reset nilai data-initial pada gambar preview
            imagePreview.removeAttribute('data-initial');
        });
    });
</script>

    <body>
        <div class="Judul mb-4">
            <a href="{{ route('admin.informasiprakerin') }}"><i style="padding-right: 2vh; color: #000000"
                    class="fas fa-chevron-left"></i></a>
            Edit Informasi Prakerin
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
        <div class="card shadow" style="margin-top: 4vh">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Edit Data
                </p>
            </div>
            <form method="POST" action="{{ route('admin.editinfoprak', $informasiTempatPrakerin->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body mt-3 mb-3">
                    <div class="row mr-4 ml-4">
                        <div class="col-6" style="padding-right: 100px">
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Nama Perusahan</label>
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                value="{{ $informasiTempatPrakerin->nama_perusahaan }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;" for="image">Gambar
                                    <i class="fas fa-upload" style="font-size: 16px; color: #3498db;"></i>
                                </label>
                                <input type="file" class="form-control visually-hidden" name="image" id="image" accept=".png, .jpg, .jpeg">
                                <div class="col-3" style="display:flex;">
                                    <div style="height: 140px; max-width: 100%; overflow: hidden; position: relative;">
                                        <div id="image-preview" style="width: 100%; height: 100%; background-color: #ddd; display: flex; justify-content: center; align-items: center; color: #000; font-size: 24px; border-radius: 8px;">
                                            @if ($informasiTempatPrakerin->image)
                                                <img id="image-preview-img" src="data:image/jpeg;base64,{{ $informasiTempatPrakerin->image }}" 
                                                style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                                            @else
                                            <img id="image-preview-img" src="{{ asset('storage/images/no_image.jpg') }}" 
                                            style="width: 100%; height: 100%; object-fit: cover;" alt="No Image">
                                            @endif
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="border rounded-0 form-control summernote" >{{ $informasiTempatPrakerin->deskripsi }}</textarea>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Posisi</label>
                                <input type="text" class="form-control" name="posisi" id="posisi"
                                value="{{ $informasiTempatPrakerin->posisi }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Jurusan</label>
                                <select class="form-control" name="jurusan" id="jurusan">
                                    <option value="" selected disabled>-- Pilih Jurusan --</option>
                                    @foreach ($jurusanMapping as $key => $jurusan)
                                        <option value="{{ $key }}" @if($informasiTempatPrakerin->jurusan == $key) selected @endif>{{ $jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="col-6" style="padding-left:100px">
                            <div class="row mb-4">
                                <label class="form-label">Persyaratan</label>
                                <textarea name="persyaratan" id="persyaratan" 
                                class="border rounded-0 form-control summernote">{{ $informasiTempatPrakerin->persyaratan }}</textarea>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" 
                                value="{{ $informasiTempatPrakerin->email }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">No. Telp</label>
                                <input type="text" class="form-control" name="telp" id="telp"
                                value="{{ $informasiTempatPrakerin->telp }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Alamat Perusahaan</label>
                                <textarea name="alamat" id="alamat"
                                class="form-control" rows="3">{{ $informasiTempatPrakerin->alamat }}</textarea>
                            </div>
                            <div class="btnedit" style="justify-content: end; display: flex">
                                <button type="button" class="btn" id="resetButton"
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

@section('script')

    <script>
        $('#summernote').summernote({
            // placeholder: 'Deskripsi Perusahaan', 'Persyaratan',
            tabsize: 2,
            height: 100
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endsection
