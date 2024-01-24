@extends('layout')
@section('informasiprak')

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

        .jumbotron {
            /* margin-top: 75px; */
            padding: 8px 64px;
            font-family: Poppins;
            font-size: 28px;
            font-style: normal;
            font-weight: bold;
            line-height: normal;
            letter-spacing: 0.5px;
            background-image: url("/assets/img/bgjumbotron.jpg");
            background-color: rgb(94, 94, 94);
            background-blend-mode: multiply;
            position: relative;
            background-size: cover;
            color: white;
            height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            margin-bottom: 8vh;
        }


        .jumbotron .lead {
            margin-top: 20px;
            font-weight: light;
            font-size: 14px;

        }

        .jumbotron .display-4 {
            font-weight: 800;
            font-size: 36px;
            line-height: normal;

        }

        .col-8 {
            font-family: Poppins;
        }

        .name {
            font-weight: 800;
            font-size: 26px;

        }
    </style>

    <body>
        <div class="jumbotron">
            <h1 class="display-4">
                Informasi Prakerin
            </h1>
            <p class="lead">Informasi lowongan Praktik Kerja Industri dari beberapa Dunia Industri
                <br>atau Dunia Usaha yang bekerja sama dengan SMK Negeri 1 Adiwerna
            </p>
        </div>

        {{-- Card Kegiatan Prakerin --}}
        @foreach($informasiTempatPrakerin as $info)
        <div class="row" style="width: 100%">
            <div class="col-3 mb-4" style="display:flex; justify-content:center; align-items:center">
                <div style="width: 140px; height: 140px; overflow: hidden; position: relative; border-radius: 8px;">
                    @if ($info->image)
                        <img src="data:image/jpeg;base64,{{ $info->image }}" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                    @else
                        <img src="{{ asset('storage/images/no_image.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="No Image">
                    @endif
                </div>
            </div>            
            <div class="col-8 mb-4">
                <a class="name mt-2" href="{{ route('detailinfo', $info->id) }}" style="text-decoration: none; color: #000000;">{{ $info->nama_perusahaan }}</a>
                {{-- <a class="name mt-2" href="{{ route('detailinfo') }}" style="text-decoration: none; color: #000000;">{{ $info->nama_perusahaan }}</a> --}}
                <br>
                <p class="keterangan mt-4">{{ $info->deskripsi }}</p>
            </div>
        </div>
        @endforeach

    </body>

@stop
