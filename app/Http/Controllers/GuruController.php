<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permohonan;
use App\Models\Bimbingan;
use App\Models\Jurnalharian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class GuruController extends Controller
{
    public function index()
    {
        // Mengambil data guru yang sedang login
        $guru = User::where('email', Auth::user()->email)->first();
    
        // Mengambil data bimbingan berdasarkan NIP guru yang sedang login
        $bimbingans = Bimbingan::where('NIP', $guru->NIP)->get();
    
        // Inisialisasi array untuk menyimpan data siswa, permohonan, dan bimbingan
        $dataBimbingans = [];
    
        // Iterasi melalui setiap bimbingan
        foreach ($bimbingans as $bimbingan) {
            // Mengambil data siswa dan permohonan melalui relasi yang sudah didefinisikan di model Bimbingan
            $siswa = $bimbingan->siswa;
            $permohonan = $siswa->permohonan;
    
            // Menyimpan data dalam array
            $dataBimbingans[] = [
                'siswa' => $siswa,
                'permohonan' => $permohonan,
                'bimbingan' => $bimbingan,
            ];
        }
    
        return view('guru.dashboard', [
            'guru' => $guru,
            'dataBimbingans' => $dataBimbingans,
        ]);
    }

    public function siswabimbingan()
    {
        // Mengambil data guru yang sedang login
        $guru = User::where('email', Auth::user()->email)->first();
    
        // Mengambil data bimbingan dan menyertakan relasi siswa, permohonan, dan jurnal
        $bimbingans = Bimbingan::with(['siswa.permohonan', 'siswa.jurnal'])->where('NIP', $guru->NIP)->get();
    
        // Inisialisasi array untuk menyimpan data siswa, permohonan, bimbingan, dan jumlah jurnal
        $dataBimbingans = [];
    
        // Iterasi melalui setiap bimbingan
        foreach ($bimbingans as $bimbingan) {
            // Mengambil data siswa, permohonan, dan jurnal
            $siswa = $bimbingan->siswa;
            $permohonan = $siswa->permohonan;
            $jurnalCount = $siswa->jurnal->count(); // Menghitung jumlah jurnal
    
            // Menyimpan data dalam array
            $dataBimbingans[] = [
                'siswa' => $siswa,
                'permohonan' => $permohonan,
                'bimbingan' => $bimbingan,
                'jurnalCount' => $jurnalCount,
            ];
        }
    
        return view('guru.siswabimbingan', [
            'guru' => $guru,
            'dataBimbingans' => $dataBimbingans,
        ]);
    }

    public function jurnaldata($nis)
    {
        // Mengambil data guru yang sedang login
        $guru = User::where('email', Auth::user()->email)->first();

        // Mendapatkan siswa berdasarkan NIS yang diterima dari parameter
        $siswa = User::where('NIS', $nis)->first();
    
        // Cek apakah siswa ditemukan
        if (!$siswa) {
            // Handle jika siswa tidak ditemukan, misalnya redirect atau tampilkan pesan error
            return redirect()->back()->with('error', 'Siswa tidak ditemukan');
        }
    
        // Mendapatkan semua data jurnal harian sesuai NIS siswa, diurutkan berdasarkan tanggal
        $jurnals = $siswa->jurnal()->orderBy('tanggal')->get();

        // dd($siswa);
    
        // Menampilkan view 'siswa.jurnaldata' dengan data siswa dan jurnals
        return view('guru.jurnaldata', [
            'guru' => $guru,
            'siswa' => $siswa,
            'jurnals' => $jurnals,
        ]);

        // return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    public function penarikan()
    {
        // Mengambil data guru yang sedang login
        $guru = User::where('email', Auth::user()->email)->first();
    
        // Mengambil data bimbingan berdasarkan NIP guru yang sedang login
        $bimbingans = Bimbingan::where('NIP', $guru->NIP)->get();
    
        // Inisialisasi array untuk menyimpan data siswa, permohonan, dan bimbingan
        $dataBimbingans = [];
    
        // Iterasi melalui setiap bimbingan
        foreach ($bimbingans as $bimbingan) {
            // Mengambil data siswa dan permohonan melalui relasi yang sudah didefinisikan di model Bimbingan
            $siswa = $bimbingan->siswa;
            $permohonan = $siswa->permohonan;
    
            // Menyimpan data dalam array
            $dataBimbingans[] = [
                'siswa' => $siswa,
                'permohonan' => $permohonan,
                'bimbingan' => $bimbingan,
            ];
        }
    
        return view('guru.penarikan', [
            'guru' => $guru,
            'dataBimbingans' => $dataBimbingans,
        ]);
    }

    public function suratpenarikan($id)
    {
        // Mendapatkan satu data permohonan berdasarkan ID
        $dataSiswa = Bimbingan::find($id);

        // Mengambil data bimbingan berdasarkan NIS dari $dataSiswa
        $bimbingans = Bimbingan::where('NIS', $dataSiswa->NIS)->get();

        // Inisialisasi array untuk menyimpan data siswa, permohonan, dan bimbingan
        $dataBimbingans = [];
    
        // Iterasi melalui setiap bimbingan
        foreach ($bimbingans as $bimbingan) {
            // Mengambil data siswa dan permohonan melalui relasi yang sudah didefinisikan di model Bimbingan
            $siswa = $bimbingan->siswa;
            $permohonan = $siswa->permohonan;
    
            // Menyimpan data dalam array
            $dataBimbingans[] = [
                'siswa' => $siswa,
                'permohonan' => $permohonan,
                'bimbingan' => $bimbingan,
            ];
        }
        // dd($dataBimbingans);

        return view('guru.pdf.suratpenarikan', [
            'dataBimbingans' => $dataBimbingans,
        ]);
    }

    public function pengumpulanlaporan()
    {
        // Mengambil data guru yang sedang login
        $guru = User::where('email', Auth::user()->email)->first();
    
        // Mengambil data bimbingan berdasarkan NIP guru yang sedang login
        $bimbingans = Bimbingan::where('NIP', $guru->NIP)->get();
    
        // Inisialisasi array untuk menyimpan data siswa, permohonan, dan bimbingan
        $dataBimbingans = [];
    
        // Iterasi melalui setiap bimbingan
        foreach ($bimbingans as $bimbingan) {
            // Mengambil data siswa dan permohonan melalui relasi yang sudah didefinisikan di model Bimbingan
            $siswa = $bimbingan->siswa;
            $permohonan = $siswa->permohonan;
    
            // Menyimpan data dalam array
            $dataBimbingans[] = [
                'siswa' => $siswa,
                'permohonan' => $permohonan,
                'bimbingan' => $bimbingan,
            ];
        }

        // dd($dataBimbingans);
    
        return view('guru.pengumpulanlaporan', [
            'guru' => $guru,
            'dataBimbingans' => $dataBimbingans,
        ]);
    }

    public function statuslaporan(Request $request, $id)
    {
        $bimbingan = Bimbingan::find($id);

        

        if ($request->has('btnRevisi')) {
            $bimbingan->status = 'Revisi';
        } elseif ($request->has('btnACC')) {
            $bimbingan->status = 'ACC';
        }
    
        $bimbingan->save();
    
        // dd($bimbingan);
        return redirect()->back()->with('success', 'Status permohonan berhasil diubah.');
        // Redirect atau kembali ke halaman yang sesuai
    }
    
    public function nilailaporan()
    {
        // Mengambil data guru yang sedang login
        $guru = User::where('email', Auth::user()->email)->first();
    
        // Mengambil data bimbingan berdasarkan NIP guru yang sedang login
        $bimbingans = Bimbingan::where('NIP', $guru->NIP)->get();
    
        // Inisialisasi array untuk menyimpan data siswa, permohonan, dan bimbingan
        $dataBimbingans = [];
    
        // Iterasi melalui setiap bimbingan
        foreach ($bimbingans as $bimbingan) {
            // Mengambil data siswa dan permohonan melalui relasi yang sudah didefinisikan di model Bimbingan
            $siswa = $bimbingan->siswa;
            $permohonan = $siswa->permohonan;
    
            // Menyimpan data dalam array
            $dataBimbingans[] = [
                'siswa' => $siswa,
                'permohonan' => $permohonan,
                'bimbingan' => $bimbingan,
            ];
        }

        // dd($dataBimbingans);
    
        return view('guru.nilailaporan', [
            'guru' => $guru,
            'dataBimbingans' => $dataBimbingans,
        ]);
    }

    public function setnilailaporan(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nilai' => 'numeric|nullable',
        ]);
    
        // Temukan data bimbingan berdasarkan ID
        $dataBimbingan = Bimbingan::find($id);
    
        // Cek apakah data bimbingan ditemukan
        if (!$dataBimbingan) {
            // Handle jika data bimbingan tidak ditemukan, misalnya redirect atau tampilkan pesan error
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    
        // Update nilai hanya jika ada perubahan
        if ($dataBimbingan->nilai != $request->nilai) {
            $dataBimbingan->nilai = $request->nilai;
            $dataBimbingan->save();
    
            // Ubah status pada tabel User
            $siswa = $dataBimbingan->siswa;
            if ($siswa) {
                $siswa->status = 'Selesai Prakerin';
                $siswa->save();
            }
    
            session()->flash('success', 'Nilai dan status berhasil diperbarui.');
        } else {
            session()->flash('info', 'Tidak ada perubahan nilai.');
        }
    
        return redirect()->back();
    }
}
