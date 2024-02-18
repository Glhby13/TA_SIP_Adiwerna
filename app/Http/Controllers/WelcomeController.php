<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiTempatPrakerin;
use App\Models\Kegiatanprakerin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;

class WelcomeController extends Controller
{
    public function index()
    {
        $kegiatanprakerin = Kegiatanprakerin::all();
        // dd($kegiatanprakerin);

        return view('welcome', [
            'kegiatanprakerin' => $kegiatanprakerin,
        ]);
    }

    public function informasiprak()
    {
        $informasiTempatPrakerin = InformasiTempatPrakerin::all();

        

        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TKRO' => 'Teknik Kendaraan Ringan dan Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];

       
        return view('informasiprak', [
            'informasiTempatPrakerin' => $informasiTempatPrakerin,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }
    
    public function detailinfo($id)
    {

        $informasiTempatPrakerin = InformasiTempatPrakerin::find($id);
        $listinformasiTempatPrakerin = InformasiTempatPrakerin::all();

        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TKRO' => 'Teknik Kendaraan Ringan dan Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];

        // dd($informasiTempatPrakerin);
        // dd($listinformasiTempatPrakerin);
        
        return view('detailinfo', [
            'informasiTempatPrakerin' => $informasiTempatPrakerin,
            'listinformasiTempatPrakerin' => $listinformasiTempatPrakerin,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    // public function detailinfo()
    // {

    //     return view('detailinfo');
    // }
}
