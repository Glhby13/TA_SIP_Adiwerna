<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class GuruController extends Controller
{
    public function index()
    {
        $guru = User::where('email', Auth::user()->email)->first();
        return view('guru.dashboard', [
            'guru' => $guru,
        ]);
    }

    public function siswabimbingan()
    {
        $guru = Auth::user();
        return view('guru.siswabimbingan', [
            'guru' => $guru,
        ]);
    }
    
    public function nilailaporan()
    {
        $guru = Auth::user();
        return view('guru.nilailaporan', [
            'guru' => $guru,
        ]);
    }
}
