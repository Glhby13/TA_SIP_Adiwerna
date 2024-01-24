@extends('admin.layout')
@section('datapembagianbimbingan')

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
        
    .terpilih {
    display: flex; /* Membuat elemen menjadi flex container */
    align-items: center; /* Mengatur seluruh item dalam satu baris secara vertikal di tengah */
    }

    #siswaFormsContainer .alert-danger {
        margin-top: 10px !important;  /* Atur jarak dari elemen di atasnya */
        padding: 10px !important;     /* Atur padding */
        background-color: unset !important;  /* Atur warna latar belakang */
        border: unset !important;  /* Atur border */
        color: #ff0000 !important;     /* Atur warna teks */
        border-radius: .25rem !important;  /* Atur border-radius untuk sudut yang lebih lembut */
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

{{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

<script>
    $(document).ready(function () {
        // Handle perubahan pada dropdown guru
        $('#NIP').on('change', function () {
            var selectedGuru = $(this).find(':selected');
            var kuotaBimbingan = selectedGuru.data('kuota-bimbingan');
            var jurusan = selectedGuru.data('jurusan');
            var nipGuru = selectedGuru.val(); // Tambahkan ini untuk mendapatkan NIP Guru
            var siswaBimbinganCount = {!! json_encode($siswaBimbinganCount) !!};
            

            // Tampilkan jurusan pada bagian bawah nama guru
            $('#jurusanContainer').html('<p>Jurusan: ' + jurusan + '</p>');

            // Hapus semua form siswa sebelumnya
            $('#siswaFormsContainer').empty();

            // Tambahkan form siswa sesuai dengan sisa kuota bimbingan guru
            var sisaKuota = kuotaBimbingan - siswaBimbinganCount[nipGuru];
            for (var i = 1; i <= sisaKuota; i++) {
                var siswaForm = createSiswaForm(i, jurusan);
                $('#siswaFormsContainer').append(siswaForm);
            }
        });

        // Fungsi untuk membuat form siswa
        function createSiswaForm(index, jurusan) {
            var siswaForm = '<div class="mb-3">' +
                '<label class="form-label" style="color: #000000;">Nama Siswa ' + index + '</label>' +
                '<select class="form-control" name="NIS[' + index + ']">' +
                '<option value="" disabled selected>Pilih Nama Siswa</option>';

            // Tambahkan nama siswa dari $siswa yang belum ada di tabel bimbingan
            @foreach($siswa as $siswaItem)
                // Cek apakah NIS siswa sudah ada pada array $siswaBimbingan
                var isSiswaSelected = {!! json_encode(in_array($siswaItem->siswa->NIS, $siswaBimbingan)) !!};
                if (!isSiswaSelected && '{{ $siswaItem->siswa->jurusan }}' === jurusan) {
                    siswaForm += '<option value="{{ $siswaItem->siswa->NIS }}">{{ $siswaItem->siswa->name }}</option>';
                }
            @endforeach

            siswaForm += '</select></div>';

            return siswaForm;
        }

        // Handle perubahan pada dropdown siswa
        $(document).on('change', 'select[name^="NIS"]', function () {
            // Disable nama siswa yang sudah dipilih pada form siswa lainnya
            $('select[name^="NIS"]').find('option').prop('disabled', false);

            // Loop melalui semua form siswa
            $('select[name^="NIS"]').each(function () {
                // Ambil nilai NIS siswa yang dipilih pada form siswa tersebut
                var selectedNIS = $(this).val();

                // Skip jika form siswa ini kosong
                if (!selectedNIS) {
                    return;
                }

                // Loop kembali untuk men-disable nama siswa yang sudah dipilih pada form siswa lainnya
                $('select[name^="NIS"]').not(this).find('option[value="' + selectedNIS + '"]').prop('disabled', true);
            });
        });

        // Handle klik tombol reset
        $('#resetButton').on('click', function () {
            // Reset nilai pada dropdown guru
            $('#NIP').val('').change();

            // Hapus konten dari jurusanContainer
            $('#jurusanContainer').empty();

            // Disable kembali pilihan "Pilih Nama Siswa" di semua form siswa
            $('select[name^="NIS"]').find('option[value=""]').prop('disabled', true);
        });

        // Handle submit form
$('form').on('submit', function (event) {
    // Periksa tombol yang ditekan
    var submitButton = $(document.activeElement);

    // Jika tombol "Save" ditekan
    if (submitButton.hasClass('save-button')) {
        var isAtLeastOneSiswaSelected = false; // Gunakan variabel untuk melacak apakah setidaknya satu siswa dipilih

        // Loop melalui semua form siswa
        $('#siswaFormsContainer select[name^="NIS"]').each(function () {
            // Ambil nilai NIS siswa yang dipilih pada form siswa tersebut
            var selectedNIS = $(this).val();

            if (selectedNIS) {
                isAtLeastOneSiswaSelected = true; // Set variabel menjadi true jika setidaknya satu siswa dipilih
                return false; // Keluar dari loop karena sudah ada setidaknya satu siswa yang dipilih
            }
        });

        if (!isAtLeastOneSiswaSelected) {
            // Tampilkan pesan kesalahan jika tidak ada siswa yang dipilih
            if ($('#siswaFormsContainer .alert-danger').length === 0) {
                $('#siswaFormsContainer').append('<div class="alert alert-danger">*Pilih minimal satu siswa.</div>');
            }

            event.preventDefault(); // Mencegah formulir dikirim jika validasi gagal
        } else {
            // Hapus pesan kesalahan jika setidaknya satu siswa dipilih
            $('#siswaFormsContainer .alert-danger').remove();
        }
    }
});


    });
</script>


<div class="Judul">Data Pembagian Bimbingan</div>
<button type="button" class="btn btn-primary mt-2 mb-4" data-toggle="modal" data-target="#modalTambah">
    <i class="fas fa-plus mr-2 ml-1"></i>
    Tambah Data
</button>

{{-- <script>
    $(document).ready(function () {
        // Reset form saat modal dibuka
        $('#modalTambah').on('show.bs.modal', function (event) {
            // Reset dropdown guru dan siswa
            $('#NIP').val('').trigger('change');
            $('#siswaFormsContainer').empty();
            $('#jurusanContainer').empty();
        });

        // Handle perubahan pada dropdown guru
        $('#NIP').on('change', function () {
                var selectedGuru = $(this).find(':selected');
                var kuotaBimbingan = selectedGuru.data('kuota-bimbingan');
                var jurusan = selectedGuru.data('jurusan');
                var siswaBimbinganCount = selectedGuru.data('siswa-bimbingan-count') || 0; // Jumlah siswa yang sudah dibimbing

                // Tampilkan jurusan pada bagian bawah nama guru
                $('#jurusanContainer').html('<p>Jurusan: ' + jurusan + '</p>');

                // Hapus semua form siswa sebelumnya
                $('#siswaFormsContainer').empty();

                // Tambahkan form siswa sesuai dengan sisa kuota bimbingan guru
                var sisaKuota = kuotaBimbingan - siswaBimbinganCount;
                for (var i = 1; i <= sisaKuota; i++) {
                    var siswaForm = createSiswaForm(i, jurusan);
                    $('#siswaFormsContainer').append(siswaForm);
                }
            });

        // Handle reset button
        $('#resetButton').on('click', function () {
            // Reset dropdown guru dan siswa
            $('#NIP').val('').trigger('change');
        });

        // Fungsi untuk membuat form siswa
        function createSiswaForm(index) {
            var siswaForm = '<div class="mb-3">' +
                '<label class="form-label" style="color: #000000;">Nama Siswa ' + index + '</label>' +
                '<select class="form-control" name="NIS[' + index + ']">' +
                '<option value="" disabled selected>Pilih Nama Siswa</option>';

            // Tambahkan nama siswa dari $siswa yang belum ada di tabel bimbingan
            @foreach($siswa as $siswaItem)
                if (!@in_array($siswaItem->NIS, $siswaBimbingan)) {
                    siswaForm += '<option value="{{ $siswaItem->NIS }}">{{ $siswaItem->nama_siswa }}</option>';
                }
            @endforeach

            siswaForm += '</select></div>';

            return siswaForm;
        }
    });
</script> --}}


<!-- Awal Modal -->
<div class="modal fade" id="modalTambah" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="staticBackdropLabel"
                    style="color: #000000; font-size: 20px; font-weight: 700;">Form Tambah Data Pembagian Bimbingan</p>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.tambahdatapembagianbimbingan') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" style="color: #000000;">Nama Guru Pembimbing</label>
                        <select class="form-control" name="NIP" id="NIP" required>
                            <option value="" disabled selected>Pilih Nama Guru Pembimbing</option>
                            @foreach($guru as $guruItem)
                                <?php
                                    // Hitung jumlah siswa yang telah dibimbing oleh guru
                                    $jumlahSiswaBimbingan = $guruItem->bimbingan->count();
                                    $isGuruDisabled = ($jumlahSiswaBimbingan >= $guruItem->kuota_bimbingan) ? 'disabled' : '';
                                ?>
                                {{-- <option value="{{ $guruItem->NIP }}" data-kuota-bimbingan="{{ $guruItem->kuota_bimbingan }}" data-jurusan="{{ $guruItem->jurusan }}" {{ $isGuruDisabled }}>
                                    {{ $guruItem->name }} (Kuota: {{ $guruItem->kuota_bimbingan }} siswa, Dibimbing: {{ $jumlahSiswaBimbingan }} siswa)
                                </option> --}}
                                <option value="{{ $guruItem->NIP }}" data-kuota-bimbingan="{{ $guruItem->kuota_bimbingan }}" data-jurusan="{{ $guruItem->jurusan }}" {{ $isGuruDisabled }}>
                                    {{ $guruItem->name }} (Kuota: {{ $jumlahSiswaBimbingan }}/{{ $guruItem->kuota_bimbingan }} siswa)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="jurusanContainer"></div>
                    <div id="siswaFormsContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" id="resetButton"
                        style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Reset</button>
                    <button type="submit" class="btn save-button"
                        style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal -->


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <p class="sub-judul m-0">
            List Data
        </p>
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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" orderable="false" style="cursor: unset">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="select-all" id="select-all">
                                <label class="form-check-label" for="select-all"></label>
                            </div>
                        </th>
                        <th>Guru Pembimbing</th>
                        <th>Jurusan Guru</th>
                        <th>Siswa</th>
                        <th>NIS</th>
                        <th>Status</th>
                        <th>Nilai</th>
                        <th style="min-width: 100px;">Action</th>
                    </tr>
                </thead>
                    @foreach($dataBimbingan as $bimbingan)
                    <tr>
                        <td class="text-center">
                            <div class="form-check" style="padding-left: 0; margin-left: 30px;">
                                <input class="form-check-input" type="checkbox" value="{{ $bimbingan->id }}" id="select-item-{{ $bimbingan->id }}">
                                <label class="form-check-label" for="selectitem"></label>
                            </div>
                        </td>
                        <td>{{ $bimbingan->guru->name }}</td>
                        <td>{{ isset($bimbingan->guru->jurusan) ? $jurusanGuruMapping[$bimbingan->guru->jurusan] : '' }}</td>
                        <td>{{ $bimbingan->siswa->name }}</td>
                        <td>{{ $bimbingan->NIS }}</td>
                        <td>{{ $bimbingan->status }}</td>
                        <td>{{ $bimbingan->nilai }}</td>
                        <td style="width: 90px;">
                            <div class="editdata">
                                <button id="edit" type="button" class="btn edit-button">
                                    <a href="{{ route('admin.datapembagianbimbinganeditview', $bimbingan->id) }}"><i
                                            class="far fa-edit" style="color: #000000"></i></a>
                                </button>
                                <button id="delete" type="button" class="btn delete-button" style="color: #000000" data-toggle="modal"
                                data-target="#modalHapus{{ $bimbingan->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>

                                <div class="modal fade"  id="modalHapus{{ $bimbingan->id }}" role="dialog" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form method="POST" action="{{ route('admin.datapembagianbimbingandelete', $bimbingan->id) }}">
                                                @csrf
                                            <p style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
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

@section('script')
    <script>
        $('#dataTable').DataTable({
            "columnDefs": [{
                "orderable": false, "targets": [0, 7]
            }]
        });
    </script>
@endsection
