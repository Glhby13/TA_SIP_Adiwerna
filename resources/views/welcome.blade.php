@extends('layout')
@section('content')

<body>
    <div class="jumbotron">
        <div class="hero">
            <h1 class="display-4">Sistem Informasi Prakerin
                <br>SMKN 1 Adiwerna
            </h1>
            <p class="lead">Sistem Informasi Prakerin merupakan situs web yang digunakan untuk membantu Siswa
                <br>SMKN 1 Adiwerna, Guru, dan Tenaga Kependidikan dalam pelaksanaan Praktik Kerja Lapangan.
            </p>
            <p class="lead">
                <a class="btn btn-outline-light" href="{{ route('informasiprak') }}" role="button">Informasi
                    Prakerin</a>
            </p>
            <link rel="stylesheet" type="text/css" href="welcome.css">
        </div>
        <div class="icon-container">
            <a class="icon-class" href="https://www.instagram.com/smknegeri1adiwerna/">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-instagram">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                    </rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
            </a>
            <a class="icon-class" href="https://www.facebook.com/groups/stmadbtegal/">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-facebook">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
            </a>
            <a class="icon-class" href="https://twitter.com/stmadbtegal">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-twitter">
                    <path
                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                    </path>
                </svg>
            </a>
            <a class="icon-class" href="https://www.youtube.com/c/ADBtv/channels">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-youtube">
                    <path
                        d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z">
                    </path>
                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                </svg>
            </a>
        </div>
    </div>


    {{-- Card Kegiatan Prakerin --}}

    <div class="judulcard">
        Kegiatan Prakerin
    </div>

    <div class="container mb-5 mt-3" style="margin-left: auto; margin-right: auto;">
        <div class="row">
            <div class="owl-carousel owl-theme">
                @foreach ($kegiatanprakerin as $kegiatan)
                    <div class="item">
                        <div class="card" style="padding: 0.7rem; width: 300px; height: 430px;">
                            <div class="card-body" style="display: flex; flex-direction: column;">
                                @if ($kegiatan->image)
                                    <img src="data:image/jpeg;base64,{{ $kegiatan->image }}"
                                        class="card-img-top" alt="{{ $kegiatan->nama_kegiatan }}"
                                        style="width: 240px; height: 250px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/no_image.jpg') }}" class="card-img-top"
                                        alt="No Image" style="width: 240px; height: 250px; object-fit: cover;">
                                @endif
                                <hr>
                                <p class="card-text" style="text-align: justify; font-size: 12px">
                                    {{ Illuminate\Support\Str::limit($kegiatan->deskripsi, 100) }}
                                </p>
                                

                                <!-- Link Baca Selengkapnya yang membuka modal -->
                                <a href="#" data-toggle="modal" data-target="#modalSelengkapnya"
                                    style="color: #4055be; text-decoration: none; font-size: 13px"
                                    onclick="showFullDescription({{ json_encode($kegiatan) }})">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Modal untuk Baca Selengkapnya -->
    <div class="modal fade" id="modalSelengkapnya" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSelengkapnyaLabel">Baca Selengkapnya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi modal -->
                    <div class="text-center">
                        <img id="gambarKegiatan" class="img-fluid mb-3" alt="Gambar Kegiatan">
                    </div>
                    <h5 id="judulKegiatan" class="modal-title mb-3"></h5>
                    <p id="deskripsiKegiatan"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })

        // Fungsi untuk menampilkan deskripsi lengkap pada modal
        function showFullDescription(kegiatan) {
            document.getElementById('judulKegiatan').innerText = kegiatan.nama_kegiatan;

            // Menetapkan gambar ke dalam modal
            if (kegiatan.image) {
                document.getElementById('gambarKegiatan').src = 'data:image/jpeg;base64,' + kegiatan.image;
            } else {
                document.getElementById('gambarKegiatan').src = '{{ asset('assets/img/no_image.jpg') }}';
            }

            // Menetapkan deskripsi ke dalam modal
            document.getElementById('deskripsiKegiatan').innerText = kegiatan.deskripsi;
        }
    </script>

</body>
@stop
