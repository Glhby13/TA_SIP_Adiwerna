@extends('admin.layout')
@section('dataguru')


    {{-- <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

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
            var resetButton2 = document.getElementById("resetButton");

            // Temukan semua input fields berdasarkan ID
            var nisInput = document.getElementById("NIS");
            var nameInput = document.getElementById("name");
            var jurusanInput = document.getElementById("jurusan");
            var kelasInput = document.getElementById("kelas");
            var telpInput = document.getElementById("telp");
            var emailInput = document.getElementById("email");
            var statusInput = document.getElementById("status");
            // var password_confirmationInput = document.getElementById("password_confirmation");

            // Tambahkan event listener ke tombol "Reset"
            resetButton2.addEventListener("click", function() {
                // Reset nilai semua input fields
                nisInput.value = " ";
                nameInput.value = " ";
                jurusanInput.selectedIndex = 0;
                kelasInput.value = " ";
                telpInput.value = " ";
                emailInput.value = " ";
                statusInput.selectedIndex = 0;
                // password_confirmationInput.value = "";
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var selectAllCheckbox = $('#select-all');
            var checkboxes = $('.form-check-input');
            
            var dataTable = $('#dataTable');

            selectAllCheckbox.change(function () {
                checkboxes.prop('checked', $(this).prop('checked'));
                toggleDeleteButton();
                toggleEditDeleteButtons();
                updateSelectedIds();
            });

            checkboxes.change(function () {
                toggleDeleteButton();
                toggleEditDeleteButtons();
                updateSelectedIds();
                updateSelectAllCheckbox();
            });

            function toggleDeleteButton() {
                var anyChecked = checkboxes.is(':checked');
                $('#deleteButton').prop('disabled', !anyChecked);
            }

            function toggleEditDeleteButtons() {
                checkboxes.each(function () {
                    var isChecked = $(this).prop('checked');
                    var row = $(this).closest('tr');
                    row.find('.edit-button, .delete-button').prop('disabled', isChecked);
                });
            }

            function updateSelectedIds() {
                var selectedIds = [];

                checkboxes.each(function () {
                    if ($(this).prop('checked') && $(this).val() !== 'select-all') {
                        selectedIds.push($(this).val());
                    }
                });

                $('[name="selectedIds[]"]').remove();

                selectedIds.forEach(function (id) {
                    var input = $('<input>').attr({
                        type: 'hidden',
                        name: 'selectedIds[]',
                        value: id
                    });
                    $('#deleteForm').append(input);
                });
            }

            // Disable edit and delete buttons by default
            $('.edit-button, .delete-button').prop('disabled', false);

            // Enable/disable edit and delete buttons based on checkbox status
            checkboxes.change(function () {
                toggleEditDeleteButtons();
                updateSelectAllCheckbox();
            });

            // Menangani event draw.dt
            dataTable.on('draw.dt', function () {
                checkboxes = $('.form-check-input'); // Perbarui checkboxes setelah tabel ditarik ulang
                checkboxes.change(function () {
                    toggleDeleteButton();
                    toggleEditDeleteButtons();
                    updateSelectedIds();
                    updateSelectAllCheckbox();
                });
            });

            // Update status "Select All" checkbox
            function updateSelectAllCheckbox() {
                var allChecked = checkboxes.length === checkboxes.filter(':checked').length;
                selectAllCheckbox.prop('checked', allChecked);
            }
        });
    </script>



    <body>
        <div class="Judul">Data Siswa</div>
        <button type="button" class="btn btn-primary mt-2 mb-4" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus mr-2 ml-1"></i>
            Tambah Data
        </button>
        <button type="button" class="btn btn-primary mt-2 mb-4" data-toggle="modal" data-target="#modalTambahFileSiswa">
            <i class="fas fa-plus mr-2 ml-1"></i>
            Unggah File
        </button>
        <a href="{{ route('admin.trashsiswaview') }}"><button type="button" class="btn mt-2 mb-4 ml-2"
            style="background-color: #fe5a48; color: #ffffff; font-size: 16px;">
            <i class="fas fa-trash mr-2 ml-1"></i>
            Trash</button></a>
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
        <!-- Awal Modal -->
        <div class="modal fade" id="modalTambah" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" id="staticBackdropLabel"
                            style="color: #000000; font-size: 20px; font-weight: 700;">Form Tambah Data Siswa</p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <form method="POST" action="{{ route('admin.tambahdatasiswa') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">NIS</label>
                                <input type="text" class="form-control" name="NIS" id="NIS" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Nama Siswa</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Jurusan</label>
                                <select class="form-control" name="jurusan" id="jurusan">
                                    <option value="" selected disabled>-- Pilih Jurusan --</option>
                                    @if (Auth::user()->jurusan)
                                        <option value="{{ Auth::user()->jurusan }}">{{ $jurusanMapping[Auth::user()->jurusan] }}</option>
                                    @else
                                        @foreach ($jurusanMapping as $key => $jurusan)
                                            <option value="{{ $key }}">{{ $jurusan }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: #000000;">Kelas</label>
                                <input type="text" class="form-control" name="kelas" id="kelas" required>
                            </div>
                            <div class="mb-3" style="color: #000000;">
                                <label class="form-label">No. Telp</label>
                                <input type="text" class="form-control" name="telp" id="telp" required>
                            </div>
                            <div class="mb-3" style="color: #000000;">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3" style="color: #000000;">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="" selected disabled>-- Pilih Status --</option>
                                    <option value="Belum Mendaftar">Belum Mendaftar</option>
                                    <option value="Sudah Mendaftar">Sudah Mendaftar</option>
                                    <option value="Sedang Prakerin">Sedang Prakerin</option>
                                    <option value="Selesai Prakerin">Selesai Prakerin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" id="resetButton"
                                style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Reset</button>
                            <button type="submit" class="btn"
                                style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal -->

        <!-- Modal Tambah File -->
        <div class="modal fade" id="modalTambahFileSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahFileLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" id="staticBackdropLabel"
                            style="color: #000000; font-size: 20px; font-weight: 700;">Tambah File Data Siswa</p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk mengunggah file Excel -->
                        <form action="{{ route('admin.tambahfiledatasiswa') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="excelFile">Pilih File Excel:</label>
                                <input type="file" class="form-control" id="excelFile" name="excelFileSiswa" accept=".xls,.xlsx" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
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
                                <th class="text-center" orderable="false" style="cursor: unset">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="select-all" id="select-all">
                                        <label class="form-check-label" for="select-all"></label>
                                    </div>
                                </th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $data)
                                <tr>
                                    <td class="text-center">
                                        <div class="form-check" style="padding-left: 0; margin-left: 30px;">
                                            <input class="form-check-input" type="checkbox" value="{{ $data->id }}" id="select-item-{{ $data->id }}">
                                            <label class="form-check-label" for="selectitem"></label>
                                        </div>
                                    </td>
                                    <td><?= $data['NIS'] ?></td>
                                    <td><?= $data['name'] ?></td>
                                    <td style="width: 200px;">{{ $jurusanMapping[$data['jurusan']] }}</td>
                                    <td><?= $data['kelas'] ?></td>
                                    <td style="width: 150px;"><?= $data['telp'] ?></td>
                                    <td style="width: 180px;"><?= $data['email'] ?></td>
                                    <td style="width: 140px;"><?= $data['status'] ?></td>
                                    <td style="width: 90px;">
                                        <div class="editdata">
                                            <button id="edit" type="button" class="btn edit-button">
                                                <a href="{{ route('admin.datasiswaeditview', $data->id) }}"><i
                                                        class="far fa-edit" style="color: #000000"></i></a>
                                            </button>
                                            <button id="delete" type="button" class="btn delete-button" style="color: #000000" data-toggle="modal"
                                            data-target="#modalHapus{{ $data->id }}">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
    
                                            <div class="modal fade"  id="modalHapus{{ $data->id }}" role="dialog" tabindex="-1"
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
                                                        <form method="POST" action="{{ route('admin.datasiswasoftdelete', $data->id) }}">
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
                        {{-- <tfoot>
                            <tr>
                                <th></th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <div class="terpilih">                
                    <form id="deleteForm" method="POST" action="{{ route('admin.softdeleteSelectedSiswa') }}">
                        @csrf
                        <input type="hidden" name="action" value="delete">
                        @foreach($siswa as $data)
                            <input type="hidden" name="selectedIds[]" class="selected-item" value="{{ $data->id }}">
                        @endforeach
                        <button id="deleteButton" type="submit" class="btn mt-3 ml-2" style="background-color: #EF4F4F; 
                        color: #ffffff; font-size: 16px;" disabled>Delete Item</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

@stop

@section('script')
    <script>
        $('#dataTable').DataTable({
            "columnDefs": [{
                "orderable": false, "targets": [0, 8]
            }]
        });
    </script>
@endsection
