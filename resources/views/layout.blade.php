<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/img/logosmk.png')}}" type="image/x-icon">
    <title>SISTEM PRAKERIN SMKN 1 ADIWERNA</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">

    <link rel="stylesheet" type="text/css" href="dashboard.css">
</head>

<body>

    {{-- navigation bar --}}
    <nav class="navbar fixed-top justify-content-between navbar-expand-lg">
        <div class="logo">
            <a class="navbar-brand-two d-inline-block ml-1" href="#">
                <img src="{{ asset('assets/img/logosmk.png') }}" alt="Logo" width="40" height="40" class="logo-navbar" />
            </a>
            <div class="navbar-brand">
                <a href="{{ route('welcome') }}" style="text-decoration: none;">
                    <strong class="text-white">
                        SEKOLAH MENENGAH KEJURUAN
                    <br>NEGERI 1 ADIWERNA
                    </strong>
                </a>
            </div>
        </div>
        <a href="{{ route('login') }}">
            <button type="button" class="d-flex btn btn-outline-light">Login</button>
        </a>

    </nav>

    @yield('content')
    @yield('informasiprak')
    @yield('detail')

    {{-- <div class="isi">
        
    </div> --}}
</body>

<footer>
        {{-- Footer --}}
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-size" width="20" height="20"
                                        fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path
                                            d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                    <span class="contact-text">Jl. Raya II PO Box 24 Adiwerna Tegal, Indonesia</span>
                                </div>
                            </li>
                            <li>
                                <div class="icon-contact">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-size" width="20" height="20"
                                        fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                    </svg>
                                    <span class="contact-text">mail@smkn1adw.sch.id</span>
                                </div>
                            </li>
                            <li>
                                <div class="icon-contact">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-size" width="20" height="20"
                                        fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path
                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
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
            <div class="d-flex justify-content-center style="background-color: rgba(0, 0, 0, 0.2);>
                <div class="copyright">
                    © 2023 SMK NEGERI 1 ADIWERNA
                </div>
            </div>
        </div>
</footer>

</html>
