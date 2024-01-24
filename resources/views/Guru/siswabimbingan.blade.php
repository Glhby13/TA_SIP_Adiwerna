@extends('guru.layout')
@section('siswabimbingan')

    {{-- <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

    <body>
        <div class="Judul mb-4">Data Siswa Bimbingan</div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Data Siswa Bimbingan
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
                                <th>No. Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>121</td>
                                <td>Putri Almaas Auliasari</td>
                                <td>PT EPSON</td>
                                <td>085456544569</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>122</td>
                                <td>Galih Bayu Prakoso</td>
                                <td>PT CISCO</td>
                                <td>086912364589</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>123</td>
                                <td>Kirani Juli Andini</td>
                                <td>PT ANIMASI MULTIMEDIA</td>
                                <td>086712364589</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>124</td>
                                <td>Aleeya Auzara Himmatana</td>
                                <td>CV ALANA JAYA</td>
                                <td>082345617569</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>125</td>
                                <td>Putri Almira Ainurrizqi</td>
                                <td>CV ROEMAH KOMPUTER</td>
                                <td>082145783245</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
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
                "targets": 4
            }]
        });
    </script>
@endsection
