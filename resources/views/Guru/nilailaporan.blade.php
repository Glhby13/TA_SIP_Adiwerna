@extends('guru.layout')
@section('nilailaporan')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Temukan tombol "Reset" berdasarkan ID
        var resetButton2 = document.getElementById("resetButton");

        // Temukan semua input fields berdasarkan ID
        var nilaiInput = document.getElementById("nilai");

        // Tambahkan event listener ke tombol "Reset"
        resetButton2.addEventListener("click", function() {
            // Reset nilai semua input fields
            nilaiInput.value = " ";
        });
    });
</script>

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
                                <th>Kelas</th>
                                <th>Tempat Prakerin</th>
                                <th>Link Laporan</th>
                                <th>Nilai Laporan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataBimbingans as $data)
                                @if ($data['bimbingan']->status == 'ACC')
                                    <tr>
                                        <td>{{ $data['siswa']->NIS }}</td>
                                        <td>{{ $data['siswa']->name }}</td>
                                        <td>{{ $data['siswa']->kelas }}</td>
                                        <td>{{ $data['permohonan']->tempat_prakerin }}</td>
                                        <td>
                                            <a href="{{ $data['bimbingan']->laporan }}" target="_blank">
                                                {{ $data['bimbingan']->laporan }}
                                            </a>
                                        </td>
                                        <td>{{ $data['bimbingan']->nilai }}</td>
                                        <td>
                                            <div class="editdata">
                                                <button type="button" class="btn ml-2" data-toggle="modal"data-target="#modalNilai{{ $data['bimbingan']->id }}">
                                                    <i class="far fa-edit" style="color: #000000"></i>
                                                </button>
        
                                                {{-- <div class="modal fade"  id="modalNilai{{ $data['bimbingan']->id }}" role="dialog" tabindex="-1"
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
                                                            <form method="POST" action="{{ route('hapus.permohonan', $data['bimbingan']->id) }}">
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
                                                </div> --}}

                                                        <!-- Awal Modal -->
                                                <div class="modal fade" id="modalNilai{{ $data['bimbingan']->id }}" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <p class="modal-title" id="staticBackdropLabel"
                                                                    style="color: #000000; font-size: 20px; font-weight: 700;">Form Tambah Data Guru Pembimbing</p>
                                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ route('nilai.laporan', $data['bimbingan']->id) }}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" style="color: #000000;">NIS</label>
                                                                        <input type="text" class="form-control" name="NIS" id="NIS" value="{{ $data['siswa']->NIS }}" readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" style="color: #000000;">Nama Siswa</label>
                                                                        <input type="text" class="form-control" name="name" id="name" value="{{ $data['siswa']->name }}" readonly>
                                                                    </div>
                                                                    <div class="mb-3" style="color: #000000;">
                                                                        <label class="form-label">Nilai Laporan</label>
                                                                        <input type="text" class="form-control" pattern="[0-9]+" name="nilai" id="nilai" placeholder="{{ $data['bimbingan']->nilai }}" required>
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
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
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
