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
use Illuminate\Validation\Rule;

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

        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TKRO' => 'Teknik Kendaraan Ringan dan Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
        return view('guru.dashboard', [
            'guru' => $guru,
            'dataBimbingans' => $dataBimbingans,
            'jurusanmapping' => $jurusanMapping,
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
    
        // Validasi form jika tombol Revisi ditekan
        if ($request->has('btnRevisi')) {
            $request->validate([
                'catatan_revisi' => 'required', // Catatan revisi harus diisi
            ], [
                'catatan_revisi.required' => 'Catatan revisi wajib diisi.', // Pesan error jika catatan revisi kosong
            ]);
    
            // Cek apakah nilai siswa sudah terisi
            $siswa = $bimbingan->siswa;
    
            if ($siswa && $siswa->nilai !== null) {
                // Jika nilai siswa sudah terisi, tampilkan pesan error
                return redirect()->back()->withErrors(['catatan_revisi' => 'Siswa sudah diinilai, tidak dapat mengubah status laporan.']);
            }
    
            // Jika validasi berhasil, maka lakukan perubahan status dan data lainnya
            $bimbingan->status = 'Revisi';
            $bimbingan->jumlah_revisi = $request->input('jumlah_revisi');
            $bimbingan->catatan_revisi = $request->input('catatan_revisi');
    
            $successMessage = 'Status laporan berhasil diubah menjadi Revisi.';
        } elseif ($request->has('btnACC')) {
            // Jika tombol ACC ditekan
            if ($request->filled('catatan_revisi')) {
                // Jika ada input pada catatan_revisi, tampilkan pesan error
                return redirect()->back()->withErrors(['catatan_revisi' => 'Catatan revisi harus kosong saat menekan tombol ACC.']);
            }
    
            $bimbingan->status = 'ACC';
            $successMessage = 'Status laporan berhasil diubah menjadi ACC.';
        }
    
        $bimbingan->save();
    
        return redirect()->back()->with('success', $successMessage);
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
    
        // Update nilai pada tabel user
        $siswa = $dataBimbingan->siswa;
    
        // Cek apakah data siswa ditemukan
        if ($siswa && $siswa->nilai != $request->nilai) {
            // Update nilai pada tabel user
            $siswa->nilai = $request->nilai;
            $siswa->save();
    
            // Ubah status pada tabel User
            $siswa->status = 'Selesai Prakerin';
            $siswa->save();
    
            session()->flash('success', 'Nilai berhasil diperbarui.');
        } else {
            session()->flash('info', 'Tidak ada perubahan nilai.');
        }
    
        return redirect()->back();
    }
}
