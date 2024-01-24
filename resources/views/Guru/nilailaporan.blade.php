@extends('guru.layout')
@section('nilailaporan')

    <body>
        <div class="Judul mb-4">Nilai Laporan</div>
        <!-- Button trigger modal -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Nilai Laporan Prakerin
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tempat Prakerin</th>
                                <th>Status Laporan</th>
                                <th>Nilai Laporan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>121</td>
                                <td>Putri Almaas Auliasari</td>
                                <td>PT EPSON</td>
                                <td>ACC</td>
                                <td>90</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <div class="editdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalEdit">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Awal Modal -->
                                        <div class="modal fade" id="modalEdit" role="dialog" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="modal-title" id="staticBackdropLabel"
                                                            style="color: #000000; font-size: 20px; font-weight: 700;">
                                                            Edit Nilai Laporan</p>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close">

                                                        </button>
                                                    </div>
                                                    <form method="POST" action="">
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    style="color: #000000;"">NIS</label>
                                                                <input type="text" class="form-control" name="tfnis"
                                                                    placeholder="NIS Siswa" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Nama
                                                                    Siswa</label>
                                                                <input type="text" class="form-control" name="tfnama"
                                                                    placeholder="Nama Siswa" readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Tempat
                                                                    Prakerin</label>
                                                                <input type="text" class="form-control"
                                                                    name="tftempatprakerin" placeholder="Tempat Prakerin"
                                                                    readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Status
                                                                    Laporan</label>
                                                                <select class="form-select" name="tfstatuslaporan">
                                                                    <option></option>
                                                                    <option value="Belum Mengumpulkan">Belum Mengumpulkan
                                                                    </option>
                                                                    <option value="Revisi">Revisi</option>
                                                                    <option value="ACC">ACC</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nilai Laporan</label>
                                                                <input type="text" class="form-control" name="tfnilai"
                                                                    placeholder="Edit Nilai Laporan">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn" data-dismiss="modal"
                                                                style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Reset</button>
                                                            <button type="submit" class="btn" name="bsave"
                                                                style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save
                                                                Change</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal -->
                                    </div>

                                    <div class="hapusdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalHapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                        <div class="modal fade" id="modalHapus" role="dialog" tabindex="-1"
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
                                                    <p
                                                        style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
                                                        Apakah Anda yakin ingin menghapus data?</p>
                                                    <div class="modalfoot mt-3 mb-3"
                                                        style="display:flex; justify-content: center; align-items:center;">
                                                        <button type="button" class="btn mr-2" data-dismiss="modal"
                                                            style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Tidak</button>
                                                        <button type="submit" class="btn ml-2"
                                                            style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Ya,
                                                            Hapus Saja!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                            <tr>
                                <td>122</td>
                                <td>Galih Bayu Prakoso</td>
                                <td>PT CISCO</td>
                                <td>Revisi</td>
                                <td> </td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <div class="editdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalEdit">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Awal Modal -->
                                        <div class="modal fade" id="modalEdit" role="dialog" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="modal-title" id="staticBackdropLabel"
                                                            style="color: #000000; font-size: 20px; font-weight: 700;">
                                                            Edit Nilai Laporan</p>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close">

                                                        </button>
                                                    </div>
                                                    <form method="POST" action="">
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    style="color: #000000;"">NIS</label>
                                                                <input type="text" class="form-control" name="tfnis"
                                                                    placeholder="NIS Siswa" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Nama
                                                                    Siswa</label>
                                                                <input type="text" class="form-control" name="tfnama"
                                                                    placeholder="Nama Siswa" readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Tempat
                                                                    Prakerin</label>
                                                                <input type="text" class="form-control"
                                                                    name="tftempatprakerin" placeholder="Tempat Prakerin"
                                                                    readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Status
                                                                    Laporan</label>
                                                                <select class="form-select" name="tfstatuslaporan">
                                                                    <option></option>
                                                                    <option value="Belum Mengumpulkan">Belum Mengumpulkan
                                                                    </option>
                                                                    <option value="Revisi">Revisi</option>
                                                                    <option value="ACC">ACC</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;">Nilai
                                                                    Laporan</label>
                                                                <input type="text" class="form-control" name="tfnilai"
                                                                    placeholder="Edit Nilai Laporan">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn" data-dismiss="modal"
                                                                style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Reset</button>
                                                            <button type="submit" class="btn" name="bsave"
                                                                style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save
                                                                Change</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal -->
                                    </div>

                                    <div class="hapusdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalHapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                        <div class="modal fade" id="modalHapus" role="dialog" tabindex="-1"
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
                                                    <p
                                                        style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
                                                        Apakah Anda yakin ingin menghapus data?</p>
                                                    <div class="modalfoot mt-3 mb-3"
                                                        style="display:flex; justify-content: center; align-items:center;">
                                                        <button type="button" class="btn mr-2" data-dismiss="modal"
                                                            style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Tidak</button>
                                                        <button type="submit" class="btn ml-2"
                                                            style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Ya,
                                                            Hapus Saja!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>123</td>
                                <td>Kirani Juli Andini</td>
                                <td>PT ANIMASI MULTIMEDIA</td>
                                <td>ACC</td>
                                <td>90</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <div class="editdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalEdit">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Awal Modal -->
                                        <div class="modal fade" id="modalEdit" role="dialog" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="modal-title" id="staticBackdropLabel"
                                                            style="color: #000000; font-size: 20px; font-weight: 700;">
                                                            Edit Nilai Laporan</p>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close">

                                                        </button>
                                                    </div>
                                                    <form method="POST" action="">
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    style="color: #000000;"">NIS</label>
                                                                <input type="text" class="form-control" name="tfnis"
                                                                    placeholder="NIS Siswa" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Nama
                                                                    Siswa</label>
                                                                <input type="text" class="form-control" name="tfnama"
                                                                    placeholder="Nama Siswa" readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Tempat
                                                                    Prakerin</label>
                                                                <input type="text" class="form-control"
                                                                    name="tftempatprakerin" placeholder="Tempat Prakerin"
                                                                    readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Status
                                                                    Laporan</label>
                                                                <select class="form-select" name="tfstatuslaporan">
                                                                    <option></option>
                                                                    <option value="Belum Mengumpulkan">Belum Mengumpulkan
                                                                    </option>
                                                                    <option value="Revisi">Revisi</option>
                                                                    <option value="ACC">ACC</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nilai Laporan</label>
                                                                <input type="text" class="form-control" name="tfnilai"
                                                                    placeholder="Edit Nilai Laporan">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn" data-dismiss="modal"
                                                                style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Reset</button>
                                                            <button type="submit" class="btn" name="bsave"
                                                                style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save
                                                                Change</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal -->
                                    </div>

                                    <div class="hapusdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalHapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                        <div class="modal fade" id="modalHapus" role="dialog" tabindex="-1"
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
                                                    <p
                                                        style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
                                                        Apakah Anda yakin ingin menghapus data?</p>
                                                    <div class="modalfoot mt-3 mb-3"
                                                        style="display:flex; justify-content: center; align-items:center;">
                                                        <button type="button" class="btn mr-2" data-dismiss="modal"
                                                            style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Tidak</button>
                                                        <button type="submit" class="btn ml-2"
                                                            style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Ya,
                                                            Hapus Saja!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                            <tr>
                                <td>124</td>
                                <td>Aleeya Auzara Himmatana</td>
                                <td>CV ALANA JAYA</td>
                                <td>Belum Mengumpulkan</td>
                                <td> </td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <div class="editdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalEdit">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Awal Modal -->
                                        <div class="modal fade" id="modalEdit" role="dialog" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="modal-title" id="staticBackdropLabel"
                                                            style="color: #000000; font-size: 20px; font-weight: 700;">
                                                            Edit Nilai Laporan</p>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close">

                                                        </button>
                                                    </div>
                                                    <form method="POST" action="">
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    style="color: #000000;"">NIS</label>
                                                                <input type="text" class="form-control" name="tfnis"
                                                                    placeholder="NIS Siswa" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Nama
                                                                    Siswa</label>
                                                                <input type="text" class="form-control" name="tfnama"
                                                                    placeholder="Nama Siswa" readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Tempat
                                                                    Prakerin</label>
                                                                <input type="text" class="form-control"
                                                                    name="tftempatprakerin" placeholder="Tempat Prakerin"
                                                                    readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Status
                                                                    Laporan</label>
                                                                <select class="form-select" name="tfstatuslaporan">
                                                                    <option></option>
                                                                    <option value="Belum Mengumpulkan">Belum Mengumpulkan
                                                                    </option>
                                                                    <option value="Revisi">Revisi</option>
                                                                    <option value="ACC">ACC</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nilai Laporan</label>
                                                                <input type="text" class="form-control" name="tfnilai"
                                                                    placeholder="Edit Nilai Laporan">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn" data-dismiss="modal"
                                                                style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Reset</button>
                                                            <button type="submit" class="btn" name="bsave"
                                                                style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save
                                                                Change</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal -->
                                    </div>

                                    <div class="hapusdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalHapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                        <div class="modal fade" id="modalHapus" role="dialog" tabindex="-1"
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
                                                    <p
                                                        style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
                                                        Apakah Anda yakin ingin menghapus data?</p>
                                                    <div class="modalfoot mt-3 mb-3"
                                                        style="display:flex; justify-content: center; align-items:center;">
                                                        <button type="button" class="btn mr-2" data-dismiss="modal"
                                                            style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Tidak</button>
                                                        <button type="submit" class="btn ml-2"
                                                            style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Ya,
                                                            Hapus Saja!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                            <tr>
                                <td>125</td>
                                <td>Putri Almira Ainurrizqi</td>
                                <td>CV ROEMAH KOMPUTER</td>
                                <td>Revisi</td>
                                <td> </td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <div class="editdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalEdit">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- Awal Modal -->
                                        <div class="modal fade" id="modalEdit" role="dialog" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="modal-title" id="staticBackdropLabel"
                                                            style="color: #000000; font-size: 20px; font-weight: 700;">
                                                            Edit Nilai Laporan</p>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close">

                                                        </button>
                                                    </div>
                                                    <form method="POST" action="">
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    style="color: #000000;"">NIS</label>
                                                                <input type="text" class="form-control" name="tfnis"
                                                                    placeholder="NIS Siswa" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Nama
                                                                    Siswa</label>
                                                                <input type="text" class="form-control" name="tfnama"
                                                                    placeholder="Nama Siswa" readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Tempat
                                                                    Prakerin</label>
                                                                <input type="text" class="form-control"
                                                                    name="tftempatprakerin" placeholder="Tempat Prakerin"
                                                                    readonly>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" style="color: #000000;"">Status
                                                                    Laporan</label>
                                                                <select class="form-select" name="tfstatuslaporan">
                                                                    <option></option>
                                                                    <option value="Belum Mengumpulkan">Belum Mengumpulkan
                                                                    </option>
                                                                    <option value="Revisi">Revisi</option>
                                                                    <option value="ACC">ACC</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nilai Laporan</label>
                                                                <input type="text" class="form-control" name="tfnilai"
                                                                    placeholder="Edit Nilai Laporan">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn" data-dismiss="modal"
                                                                style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Reset</button>
                                                            <button type="submit" class="btn" name="bsave"
                                                                style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Save
                                                                Change</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal -->
                                    </div>

                                    <div class="hapusdata">
                                        <button type="button" class="btn" style="color: #000000" data-toggle="modal"
                                            data-target="#modalHapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                        <div class="modal fade" id="modalHapus" role="dialog" tabindex="-1"
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
                                                    <p
                                                        style="display: flex; align-items:center; justify-content:center; text-align:center; font-weight:600; font-size:20px">
                                                        Apakah Anda yakin ingin menghapus data?</p>
                                                    <div class="modalfoot mt-3 mb-3"
                                                        style="display:flex; justify-content: center; align-items:center;">
                                                        <button type="button" class="btn mr-2" data-dismiss="modal"
                                                            style="background-color: #EF4F4F; color: #ffffff; font-size: 16px;">Tidak</button>
                                                        <button type="submit" class="btn ml-2"
                                                            style="background-color: #44B158; color: #ffffff; font-size: 16px; font-family: Poppins;">Ya,
                                                            Hapus Saja!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </td>
                            </tr>
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
                "targets": 5
            }]
        });
    </script>
@endsection
