@extends('admin.layout')
@section('datatempatprakerin')

    {{-- <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

    <body>
        <div class="Judul">Data Tempat Prakerin</div>
        <button type="button" class="btn mt-2 mb-4" style="background-color: #44B158; color: #ffffff; ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 18 18">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
              </svg>
            Tambah Data</button>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p class="sub-judul m-0">
                    Data Tempat Prakerin
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Tempat Prakerin</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Kapasitas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NO</th>
                                <th>Nama Tempat Prakerin</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Kapasitas</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>blabla</td>
                                <td style="display: flex; justify-content: center; align-item:center;">
                                    <i class="far fa-edit"></i>
                                    <i class="far fa-trash-alt ml-3"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008/12/13</td>
                                <td>blabla</td>
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
                "targets": 6
            }]
        });
    </script>
@endsection
