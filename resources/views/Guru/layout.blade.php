<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Custom fonts for this template -->
    <link rel="icon" href="{{ asset('assets/img/logosmk.png') }}" type="image/x-icon">
    <title>Guru Pembimbing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/Guru/vendor/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/vendor/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/vendor/datatables-demo.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css') }}">

</head>

<body>




    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="min-height: 100vh">

            <!-- Sidebar - Brand -->
            <div class="sidebar">
                <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
                    <div class="sidebar-brand-icon" style="justify-content: center; display: flex;">
                        <img src="{{ asset('assets/img/logosmk.png') }}" width="90"height="90" alt="Logo" />
                    </div>
                    <div class="sidebar-brand-text">SMKN 1 Adiwerna</div>
                </a>
            </div>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('guru.siswabimbingan') }}">
                    <i class="fas fa-users"></i>
                    <span>Siswa Bimbingan</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-file-alt"></i>
                    <span>Dokumen</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.datasiswa') }}">Surat Monitoring</a>
                        <a class="collapse-item" href="{{ route('guru.penarikan') }}">Surat Penarikan</a>
                        
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-copy"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('guru.pengumpulanlaporan') }}">Pengumpulan Laporan</a>
                        <a class="collapse-item" href="{{ route('guru.nilailaporan') }}">Nilai Laporan</a>
                        
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <ul class="navbar-nav ml-auto">

                        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown ">
                            {{-- <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="assets/img/user1.jpg"> --}}
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
                                <span class="ml-3 mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ isset($guru) ? $guru->name : '' }}
                                </span>
                                


                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> --}}
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('dashboard')
                    @yield('siswabimbingan')
                    @yield('jurnaldata')
                    @yield('penarikan')
                    @yield('pengumpulanlaporan')
                    @yield('nilailaporan')
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        {{-- <span>Copyright &copy; Your Website 2020</span> --}}
                        <span> &copy; 2023 SMK NEGERI 1 ADIWERNA</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
        $(function() {
            $('a').each(function() {
                if ($(this).prop('href') == window.location.href) {
                    $(this).addClass('active');
                    $(this).parents('li').addClass('active');
                }
            });
        });

        var url = location.href;

        $('.nav-item').each(function() {
            // var $dropdownmenu = $(this);
            $('.nav-link').each(function() {
                if ($(this).prop('href') == window.location.href) {
                    $(this).removeClass('collapsed');
                }
            });
            $('#collapseUtilities').each(function() {
                if ($(this).prop('href') == window.location.href) {
                    $(this).removeClass('collapsed');
                }
            });
        });
        
    </script>

    @yield('script')

</body>

</html>
