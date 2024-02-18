@extends('layout')
@section('detail')

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

        .container {

            margin-left: 4vw;
            /* padding: 8px 64px; */
        }

        .Judul {
            font-family: Poppins;
            font-size: 24px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            color: #000000;
        }

        .name {
            font-family: Poppins;
            font-weight: 900;
            font-size: 30px;

        }

        .img-fluid {
            width: 40vw;
            height: 50vh;
        }

        .keterangan {
            padding-top: 3vh;
            padding-left: 5.6vh;
            font-size: 16px;
            font-family: Poppins;
            text-align: justify;

        }

        .nama {
            font-weight: 600;
            font-size: 16px;
        }

        .ket {
            font-size: 8px;
            text-align: justify;

        }
    </style>

    <body>
        <div class="row" style="width: 100%; margin-bottom:10vh">
            <div class="Judul mb-4">
                <a href="{{ route('informasiprak') }}"><i
                        style="padding-left: 8.9vh; padding-right: 3vh; padding-top:13vh; color: #000000"
                        class="fas fa-arrow-left"></i></a>
                Informasi Prakerin
            </div>
            <div class="col-7">
                <div class="container">

                    <div class="name" style="padding-left: 5.6vh;">
                        {{ $informasiTempatPrakerin->nama_perusahaan }}
                        <div style="width: 640px; height: 360px; overflow: hidden; position: relative; border-radius: 8px;">
                            @if ($informasiTempatPrakerin->image)
                                <img src="data:image/jpeg;base64,{{ $informasiTempatPrakerin->image }}" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                            @else
                                <img src="{{ asset('assets/img/no_image.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="No Image">
                            @endif
                        </div>
                    </div>
                    <p class="keterangan mb-4">
                        {{ $informasiTempatPrakerin->deskripsi }}
                    </p>
                    
                    <div class="posisi mb-3" style="padding-left: 5.6vh; font-family: Poppins;">
                        <p style="font-size: 26px; font-weight: 800;">Posisi</p>
                        <p style="font-size: 16px;">
                            @php
                                $posisiList = explode(',', $informasiTempatPrakerin->posisi);
                            @endphp
                    
                            @foreach($posisiList as $posisi)
                                {{ $loop->iteration }}. {{ trim($posisi) }}<br>
                            @endforeach
                        </p>
                    </div>
                    
                    <div class="persyaratan" style="padding-left: 5.6vh; font-family: Poppins;">
                        <p style="font-size: 26px; font-weight: 800;">Persyaratan</p>
                        <p style="font-size: 16px; text-align:justify">
                            @php
                                $persyaratanList = explode(',', $informasiTempatPrakerin->persyaratan);
                            @endphp
                    
                            @foreach($persyaratanList as $persyaratan)
                                - {{ trim($persyaratan) }}<br>
                            @endforeach
                        </p>
                    </div>
                    
                    <div class="kontak" style="padding-left: 5.6vh;  font-family: Poppins;">
                        <p style="font-size: 26px; font-weight: 800;">Alamat dan Kontak</p>
                        <p style="font-size: 16px;">
                            {{ $informasiTempatPrakerin->nama_perusahaan }}
                            <br>{{ $informasiTempatPrakerin->alamat }}
                            <br>Tel: {{ $informasiTempatPrakerin->telp }}
                            <br>Email: {{ $informasiTempatPrakerin->email }}
                        </p>
                    </div>
                    
                    {{-- <div class="btnpermohonan" style="padding-left:5.6vh; margin-top: 5vh;">
                        <button type="button" class="btn"
                            style="background-color: #445cb1; color: #ffffff;">Ajukan Permohonan</button>
                    </div> --}}
                </div>
            </div>
            <div class="col-1">

            </div>
            <div class="col-4">
                <div class="card" style="border-radius: 16px; border-color: #000000;">
                    @foreach($listinformasiTempatPrakerin->shuffle()->take(3) as $informasi)
                        <div class="row mt-4" style="margin-top: 1rem !important; margin-bottom: 1rem !important;">
                            <div class="col-3" style="display:flex; justify-content:center; align-items:center">
                                <div style="width: 70px; height: 70px; overflow: hidden; border-radius: 8px;">
                                    @if ($informasi->image)
                                        <img src="data:image/jpeg;base64,{{ $informasi->image }}" style="width: 100%; height: 100%; object-fit: cover;" alt="...">
                                    @else
                                        <img src="{{ asset('assets/img/no_image.jpg') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="No Image">
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-7">
                                <a class="nama" href="{{ route('detailinfo', $informasi->id) }}"
                                    style="text-decoration: none; color: #000000;">{{ $informasi->nama_perusahaan }}</a>
                                <br>
                                <p class="ket">{{ $informasi->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </body>
@stop
