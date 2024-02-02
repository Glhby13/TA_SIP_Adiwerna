<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/img/logosmk.png') }}" type="image/x-icon">
    <title>SISTEM PRAKERIN SMKN 1 ADIWERNA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}">
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/Admin/vendor/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}">
    <script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js') }}"></script>

</head>

<style>
    .button-style {
        display: inline-block;
        padding: 0px 5px;
        /* Atur ukuran sesuai kebutuhan Anda */
        color: #fff;
        /* Atur warna teks sesuai kebutuhan Anda */
        border: 2px solid #ffffff;
        /* Atur gaya border sesuai kebutuhan Anda */
        border-radius: 5px;
        /* Atur border radius sesuai kebutuhan Anda */
        text-decoration: none;
        /* Menghilangkan garis bawah default untuk tautan */
    }

    .button-style:hover {
        color: #EF4F4F;
        /* Warna latar belakang saat dihover */
        border: 2px solid #EF4F4F;
    }

    html {
        height: 100%;
    }

    body {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    footer {
        margin-top: auto;
    }

    .navbar-brand2 {
        font-family: Poppins;
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        color: white;
        margin-left: 5px;
    }
</style>

<body>

    {{-- navigation bar --}}
    <nav class="navbar fixed-top justify-content-between navbar-expand-lg" style="height: 100%; max-height: 76px;">
        <div class="logo-home">
            <a class="navbar-brand-two d-inline-block ml-1" href="#">
                <img src="{{ asset('assets/img/logosmk.png') }}" alt="Logo" width="40" height="40" class="logo-navbar" />
            </a>
            <div class="navbar-brand2">
                <a href="{{ route('welcome') }}" style="text-decoration: none;">
                    <strong class="text-white">
                        SEKOLAH MENENGAH KEJURUAN
                        <br>NEGERI 1 ADIWERNA
                    </strong>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  mb-2 mb-lg-0" style="margin-left: auto;">
                    <li class="nav-item" style="padding-top: 1%">
                        <a class="nav-link active1" aria-current="page" href="{{ route('siswa.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item" style="padding-top: 1%">
                        <a class="nav-link active2" href="{{ route('siswa.permohonan') }}"> Permohonan Prakerin </a>
                    </li>
                    <li class="nav-item" style="padding-top: 1%">
                        <a class="nav-link active3 @if(Auth::user()->status == 'Belum Mendaftar' || Auth::user()->status == 'Sudah Mendaftar') disabled @endif" 
                           href="{{ route('siswa.jurnal') }}"> Pengisian Jurnal </a>
                    </li>
                    <li class="nav-item nav-item-divider" style="padding-top: 1%">
                        <a class="nav-link active4 @if(Auth::user()->status == 'Belum Mendaftar' || Auth::user()->status == 'Sudah Mendaftar') disabled @endif" 
                           href="{{ route('siswa.laporan') }}"> Pengumpulan Laporan </a>
                    </li>
                    <li class="nav-item" style="padding-bottom: 1%">
                        <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{-- <img class="img-profile rounded-circle" src="{{ $siswa->name[0] }}"
                                style="height: 2rem; width: 2rem; border-radius: 50% !important;"> --}}
                                @if (Auth::user()->image)
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    style="background-image: url(data:image/png;base64,{{ base64_encode(Auth::user()->image) }});
                                    object-fit: fill;
                                    background-size: cover;
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    width: 35px;
                                    height: 35px;
                                    border-radius: 50%;
                                    overflow: hidden;
                                    opacity: 1;
                                    display: inline-flex;
                                    vertical-align: middle;">
                                </figure>
                            @else
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}">
                                </figure>
                            @endif
                            
                            <span class="ml-3 mr-2 d-none d-lg-inline text-gray-600 small"
                                style="margin-left: 5% !important; color: #ffffff !important; margin-right: 0% !important; font-size: 14px;">{{ isset($siswa->name) ? $siswa->name : '' }}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" style="cursor: pointer;" href="/edit-profil">
                                <i class="fa-solid fa-user-gear fa-sm fa-fw mr-2 text-gray-400"></i>
                                Edit Profile
                            </a>
                            <a class="dropdown-item" style="cursor: pointer;" href="/edit-password">
                                <i class="fa-solid fa-user-gear fa-sm fa-fw mr-2 text-gray-400"></i>
                                Change Password
                            </a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"
                                style="cursor: pointer;">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var dropdownMenu = $(".dropdown-menu");
            var userDropdown = $(".nav-link.dropdown-toggle");

            // Sembunyikan dropdown "Logout" saat halaman dimuat
            dropdownMenu.hide();

            // Tampilkan dropdown "Logout" saat tombol "Admin" diklik
            userDropdown.on("click", function(e) {
                e
            .stopPropagation(); // Menghentikan event propagasi agar dropdown tidak menutup dengan sendirinya
                dropdownMenu.show();
            });

            // Sembunyikan dropdown "Logout" saat tombol "Logout" diklik
            $(".dropdown-item").on("click", function(e) {
                if (e.target.textContent.trim() !== "Logout") {
                    // Jika tombol yang diklik bukan "Logout", sembunyikan dropdown
                    dropdownMenu.hide();
                }
            });

            // Sembunyikan dropdown "Logout" saat area lain di luar dropdown diklik
            $(document).on("click", function(e) {
                if (!userDropdown.is(e.target) && !dropdownMenu.is(e.target) && dropdownMenu.has(e.target)
                    .length === 0) {
                    dropdownMenu.hide();
                }
            });
        });
    </script>

    @yield('dashboard')
    @yield('permohonan')
    @yield('jurnal')
    @yield('jurnaldata')
    @yield('jurnaldataedit')
    @yield('laporan')
    @yield('pengaturan')
    {{-- <div class="isi">
        
    </div> --}}

    {{-- Footer --}}

</body>

<footer>
    <div class="footer">
        <div class="logo">
            <div class="logo-footer">
                <img src="{{ asset('assets/img/logosmk.png') }}" alt="Logo" class="logo-image-size" />
            </div>
            <div style="width: 50%; height: 100%; margin-right: auto;">
                <div class="contact">
                    <p class="judulfooter">SMKN 1 ADIWERNA</p>
                    <ul class="list-unstyled">
                        <li>
                            <div class="icon-contact">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size" width="20"
                                    height="20" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    <path
                                        d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.
                                        493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.
                                        436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0
                                        .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                <span class="contact-text">Jl. Raya II PO Box 24 Adiwerna Tegal, Indonesia</span>
                            </div>
                        </li>
                        <li>
                            <div class="icon-contact">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size" width="20"
                                    height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2
                                        2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0
                                        0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5
                                        .64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1
                                        1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                                <span class="contact-text">mail@smkn1adw.sch.id</span>
                            </div>
                        </li>
                        <li>
                            <div class="icon-contact">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size" width="20"
                                    height="20" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.
                                        484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17
                                        .569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l
                                        1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.67
                                        8 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.
                                        482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0
                                         0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.6
                                         12.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.6
                                         78.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178
                                         l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.
                                         645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2
                                         .877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0
                                         1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                </svg>
                                <span class="contact-text">Telp. (0283) 443768</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="maps">
                <a href="https://maps.app.goo.gl/qY8YSmcHdRYQUUFr7">
                    <img src="{{ asset('assets/img/maps_sekolah.png') }}" alt="Foto" class="maps-image-size" />
                </a>
            </div>
        </div>
    </div>
    <div class="cpr">
        <div class="d-flex justify-content-center" style="background-color: rgba(0, 0, 0, 0.2);">
            <div class="copyright">
                © 2023 SMK NEGERI 1 ADIWERNA
            </div>
        </div>
    </div>
</footer>

</html>
