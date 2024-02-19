@extends('admin.layout')
@section('datasiswaedit')

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
            var nis2Input = document.getElementById("NIS2");
            var name2Input = document.getElementById("name2");
            var jurusan2Input = document.getElementById("jurusan2");
            var kelas2Input = document.getElementById("kelas2");
            var telp2Input = document.getElementById("telp2");
            var email2Input = document.getElementById("email2");
            var status2Input = document.getElementById("status2");
            var nilaiInput = document.getElementById("nilai");
            // var password_confirmationInput = document.getElementById("password_confirmation");

            // Tambahkan event listener ke tombol "Reset"
            resetButton2.addEventListener("click", function() {
                // Reset nilai semua input fields
                nis2Input.value = "{{ $siswa->NIS }}";
                name2Input.value = "{{ $siswa->name }}";
                jurusan2Input.value = "{{ $siswa->jurusan }}";
                kelas2Input.value = "{{ $siswa->kelas }}";
                telp2Input.value = "{{ $siswa->telp }}";
                email2Input.value = "{{ $siswa->email }}";
                status2Input.value = "{{ $siswa->status }}";
                nilaiInput.value = "{{ $siswa->nilai }}"
                // password_confirmationInput.value = "";
            });
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var jurusanInput = document.getElementById("jurusan2");
        var kelasInput = document.getElementById("kelas2");

        // Mendefinisikan daftar kelas untuk setiap jurusan
        var kelasMapping = {
            'DPIB': ['DPIB 1', 'DPIB 2', 'DPIB 3', 'DPIB 4'],
            'TE': ['TE 1', 'TE 2', 'TE 3', 'TE 4'],
            'TJKT': ['TJKT 1', 'TJKT 2', 'TJKT 3', 'TJKT 4'],
            'TK': ['TK 1', 'TK 2', 'TK 3', 'TK 4'],
            'TM': ['TM 1', 'TM 2', 'TM 3', 'TM 4'],
            'TKRO': ['TKRO 1', 'TKRO 2', 'TKRO 3', 'TKRO 4'],
            'TPFL': ['TPFL 1', 'TPFL 2', 'TPFL 3', 'TPFL 4'],
            // ... dan seterusnya, sesuai dengan jurusan yang tersedia
        };

        // Fungsi untuk mengisi opsi kelas berdasarkan jurusan yang dipilih
        function updateKelasOptions() {
            var selectedJurusan = jurusanInput.value;
            var kelasOptions = kelasMapping[selectedJurusan] || [];

            // Hapus opsi lama
            kelasInput.innerHTML = '';

            // Tambahkan opsi "Pilih Kelas"
            var placeholderOption = document.createElement("option");
            placeholderOption.value = "";
            placeholderOption.text = "{{ $siswa->kelas }}";
            placeholderOption.selected = true;
            placeholderOption.disabled = true;
            kelasInput.add(placeholderOption);

            // Tambahkan opsi baru
            kelasOptions.forEach(function(kelas) {
                var option = document.createElement("option");
                option.value = kelas;
                option.text = kelas;
                kelasInput.add(option);
            });

            // Tambahkan opsi default berdasarkan data dari database
            // var defaultOption = document.createElement("option");
            // defaultOption.value = "{{ $siswa->kelas }}";
            // defaultOption.text = "{{ $siswa->kelas }}";
            // defaultOption.selected = true;
            // kelasInput.add(defaultOption);
        }

        // Tambahkan event listener ke input jurusan
        jurusanInput.addEventListener("change", function() {
            updateKelasOptions();
        });

        // Panggil fungsi untuk inisialisasi opsi kelas
        updateKelasOptions();
    });
</script>



    <body>
        <div class="Judul mb-4">
            <a href="{{ route('admin.datasiswa') }}"><i style="padding-right: 2vh; color: #000000"
                    class="fas fa-chevron-left"></i></a>
            Edit Data Siswa
        </div>
        <div class="card shadow" style="margin-top: 50px">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Edit Data
                </p>
            </div>
            <form method="POST" action="{{ route('admin.datasiswaedit', $siswa->id) }}">
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
                                @if ($siswa->bimbingansiswa) {{-- Check if guru has data in bimbingan table --}}
                                    <input type="text" class="form-control" name="NIS" id="NIS2" value="{{ $siswa->NIS }}" readonly>
                                @else
                                    <input type="text" class="form-control" name="NIS" id="NIS2" value="{{ $siswa->NIS }}">
                                @endif
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Nama
                                    Siswa</label>
                                <input type="text" class="form-control" name="name" id="name2"
                                    value="{{ $siswa->name }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Jurusan</label>
                                @if ($siswa->bimbingansiswa) {{-- Check if siswa has data in bimbingan table --}}
                                    <select class="form-control" name="jurusan" id="jurusan2" readonly>
                                        <option value="{{ $siswa->jurusan }}" selected disabled>
                                            {{ $jurusanMapping[$siswa->jurusan] }}
                                        </option>
                                    </select>
                                @else
                                    <select class="form-control" name="jurusan" id="jurusan2">
                                        @if ($siswa->jurusan)
                                            <option value="{{ $siswa->jurusan }}" selected disabled>
                                                {{ $jurusanMapping[$siswa->jurusan] }}
                                            </option>
                                        @endif
                                        @if (Auth::user()->jurusan)
                                            <option value="{{ Auth::user()->jurusan }}">
                                                {{ $jurusanMapping[Auth::user()->jurusan] }}
                                            </option>
                                        @else
                                            @foreach ($jurusanMapping as $key => $jurusan)
                                                <option value="{{ $key }}">{{ $jurusan }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                @endif
                            </div>
                            
                            <div class="row mb-4">
                                <label class="form-label" style="color: #000000;">Kelas Siswa</label>
                                @if ($siswa->bimbingansiswa) {{-- Check if siswa has data in bimbingan table --}}
                                    <input type="text" class="form-control" name="kelas" id="kelas2" value="{{ $siswa->kelas }}" readonly>
                                @else
                                    <select class="form-control" name="kelas" id="kelas2">
                                        @foreach ($kelasMapping[$siswa->jurusan] as $kelas)
                                            @if ($kelas == $siswa->kelas)
                                                <option value="{{ $kelas }}" selected>
                                                    {{ $kelas }}
                                                </option>
                                            @else
                                                <option value="{{ $kelas }}">
                                                    {{ $kelas }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            
                            
                        </div>
                        <div class="col-6" style="padding-left:100px">
                            <div class="row mb-4">
                                <label class="form-label">No. Telp</label>
                                <input type="text" class="form-control" name="telp" id="telp2"
                                    value="{{ $siswa->telp }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email2"
                                    value="{{ $siswa->email }}">
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Status Prakerin</label>
                                <input class="form-control" name="status" id="status2" type="text" value="{{ $siswa->status }}" readonly>
                            </div>
                            <div class="row mb-4">
                                <label class="form-label">Nilai</label>
                                @if ($siswa->status == 'Selesai Prakerin')
                                    <input class="form-control" pattern="[0-9]+" name="nilai" id="nilai" type="text" value="{{ $siswa->nilai }}">
                                @else
                                    <input class="form-control" name="nilai" id="nilai" type="text" value="{{ $siswa->nilai }}" readonly>
                                @endif
                            </div>
                            <div class="btnedit" style="justify-content: end; display: flex">
                                <button type="button" class="btn" id="resetButton2"
                                    style="background-color: #EF4F4F; color: #ffffff">Reset</button>
                                <button type="submit" class="btn"
                                    style="background-color: #44B158; color: #ffffff; margin-left: 16px;">Save
                                    Change</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </body>

@stop
