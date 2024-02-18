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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Carbon\Carbon;





class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa yang sedang login
        $siswa = User::where('email', Auth::user()->email)->first();

        // Ambil permohonan yang terkait dengan siswa
        $permohonan = $siswa->permohonan;

        // Ambil bimbingan yang terkait dengan siswa
        $bimbingan = $siswa->bimbingansiswa;

        // Ambil guru yang terkait dengan bimbingan siswa (jika bimbingan tidak null)
        $guru = $bimbingan ? $bimbingan->guru : null;

        // dd($permohonan);

        return view('siswa.dashboard', [
            'siswa' => $siswa,
            'permohonan' => $permohonan,
            'bimbingan' => $bimbingan,
            'guru' => $guru,
        ]);
    }


    public function permohonan()
    {
        // Mendapatkan model User yang sedang login
        $siswa = Auth::user();

        // Mengambil data permohonan siswa berdasarkan relasi

        // NIS siswa/user yang ada di sini adalah 'has one' tabel permohonan. jadi ini mempunyai dia (perbandingan dengan 
        // controller permohonan pada admincontroller)

        $permohonan = $siswa->permohonan;

        return view('siswa.permohonan', [
            'siswa' => $siswa,
            'permohonan' => $permohonan,
        ]);
    }


    public function submitPermohonan(Request $request)
    {
        // Validasi input form
        $request->validate([
            'tempatPrakerin' => 'required|string',
            'alamatPrakerin' => 'required|string',
            'emailPrakerin' => 'required|email',
            'noTelpPrakerin' => 'required|string',
            'durasi' => 'required|integer|min:1|max:6', // Menambahkan validasi untuk durasi
        ], [
            'tempatPrakerin.required' => '*Nama Tempat Prakerin wajib diisi',
            'alamatPrakerin.required' => '*Alamat Tempat Prakerin wajib diisi',
            'emailPrakerin.required' => '*Email Tempat Prakerin wajib diisi',
            'noTelpPrakerin.required' => '*No. Telp Tempat Prakerin wajib diisi',
            'durasi.required' => '*Durasi wajib diisi',
        ]);

        // dd($request->all());

        // Ambil data siswa yang sedang login
        $siswa = User::where('email', Auth::user()->email)->first();

        // Simpan data permohonan
        Permohonan::create([
            'tempat_prakerin' => $request->input('tempatPrakerin'),
            'alamat_tempat_prakerin' => $request->input('alamatPrakerin'),
            'email_tempat_prakerin' => $request->input('emailPrakerin'),
            'telp_tempat_prakerin' => $request->input('noTelpPrakerin'),
            'durasi' => $request->input('durasi'), // Menambahkan durasi ke dalam data permohonan
            'NIS' => Auth::user()->NIS,
            'status' => 'Mengajukan',
        ]);

        // Update status siswa di tabel user
        $siswa->status = 'Sudah Mendaftar';
        $siswa->save();

        // Redirect atau kembalikan ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('siswa.permohonan')->with('success', 'Permohonan berhasil diajukan!');
    }


    public function balasanPermohonan(Request $request)
    {
        // Validasi input form
        $request->validate([
            'balasanPrakerin' => 'required|url',
        ]);

        // Ambil data siswa yang sedang login
        $siswa = Auth::user();

        // Ambil data permohonan sesuai dengan siswa yang sedang login
        $permohonan = Permohonan::where('NIS', $siswa->NIS)->first();

        // Simpan balasan tempat prakerin pada data permohonan
        $permohonan->update([
            'balasan' => $request->input('balasanPrakerin'),
        ]);

        // Redirect atau kembalikan ke halaman sebelumnya atau halaman lain yang sesuai
        return redirect()->route('siswa.permohonan')->with('success', 'Balasan berhasil disampaikan!');
    }


    public function jurnal()
    {
        $siswa = User::where('email', Auth::user()->email)->first();
        return view('siswa.jurnal', [
            'siswa' => $siswa,
        ]);
    }

    public function submitJurnal(Request $request)
    {
        // Validasi data yang diterima dari form
        $validator = $request->validate([
            'date' => 'required|date_format:d-m-Y',
            'deskripsi' => 'required',
        ]);

        // Periksa apakah jurnal dengan NIS dan tanggal sudah ada
        $existingJurnal = Jurnalharian::where([
            'NIS' => Auth::user()->NIS,
            'tanggal' => Carbon::createFromFormat('d-m-Y', $request->date)->toDateString(),
        ])->first();

        if ($existingJurnal) {
            return redirect()->back()->withErrors(['error' => 'Anda sudah membuat jurnal untuk tanggal tersebut.'])->withInput();
        }

        // Simpan data jurnal harian
        try {
            Jurnalharian::create([
                'NIS' => Auth::user()->NIS,
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->date)->toDateString(),
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->back()->with('success', 'Jurnal harian berhasil disubmit.');
        } catch (\Exception $e) {
            // Jika ada kesalahan saat menyimpan ke database, tampilkan pesan error
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan jurnal harian. Silakan coba lagi.'])
                ->withInput();
        }
    }

    public function jurnaldata()
    {
        // Mendapatkan siswa yang sedang login
        $siswa = User::where('email', Auth::user()->email)->first();

        // Mendapatkan semua data jurnal harian sesuai NIS siswa, diurutkan berdasarkan tanggal
        $jurnals = $siswa->jurnal()->orderBy('tanggal')->get();

        // dd($jurnals);
        // Menampilkan view 'siswa.jurnaldata' dengan data siswa dan jurnals
        return view('siswa.jurnaldata', [
            'siswa' => $siswa,
            'jurnals' => $jurnals,
        ]);
    }

    public function jurnaldataeditview($id)
    {
        // Mendapatkan siswa yang sedang login
        $siswa = User::where('email', Auth::user()->email)->first();
        // Ambil data jurnal berdasarkan ID yang dikirimkan
        $jurnal = Jurnalharian::find($id);
    
        // Lakukan pengecekan apakah data jurnal ditemukan atau tidak
        if (!$jurnal) {
            // Jika tidak ditemukan, mungkin hendak ditangani dengan redirect atau pesan kesalahan
            // Misalnya:
            return redirect()->route('siswa.jurnaldata')->with('error', 'Data jurnal tidak ditemukan');
        }
    
        // Validasi apakah tanggal jurnal sama dengan tanggal hari ini
        $today = now()->format('Y-m-d');
        if ($jurnal->tanggal != $today) {
            // Jika tanggal jurnal tidak sama dengan tanggal hari ini, kembalikan dengan pesan error
            return redirect()->route('siswa.jurnaldata')->with('error', 'Anda tidak dapat mengubah jurnal untuk tanggal selain hari ini');
        }
    
        // Kirim data jurnal ke view
        return view('siswa.jurnaldataedit', [
            'siswa' => $siswa,
            'jurnal' => $jurnal,
        ]);
    }
    

    public function jurnaldataedit($id, Request $request)
    {
        try {
            // Validasi input jika diperlukan
            $request->validate([
                'deskripsi' => 'required',
            ]);

            // Update data jurnal berdasarkan ID
            $jurnal = Jurnalharian::findOrFail($id);
            $jurnal->deskripsi = $request->input('deskripsi');
            $jurnal->save();

            // Redirect atau berikan response sesuai kebutuhan Anda
            return redirect()->back()->with('success', 'Jurnal berhasil diubah');
        } catch (ModelNotFoundException $e) {
            // Handler jika data tidak ditemukan
            return redirect()->back()->with('error', 'Jurnal tidak ditemukan');
        } catch (\Exception $e) {
            // Handler untuk error umum
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function jurnaldelete($id)
    {
        // Hapus data secara permanen dari database
        Jurnalharian::where('id', $id)->forceDelete();

        return redirect()->back()->with('success', 'Data jurnal berhasil dihapus permanen.');
    }

    public function laporan()
    {
        $siswa = User::where('email', Auth::user()->email)->first();

        // Mengambil data bimbingan siswa berdasarkan NIS
        $bimbinganSiswa = $siswa->bimbinganSiswa;
        // dd($bimbinganSiswa);

        return view('siswa.laporan', [
            'siswa' => $siswa,
            'bimbinganSiswa' => $bimbinganSiswa,
        ]);
    }

    public function submitlaporan(Request $request)
    {
        // Validasi request
        $request->validate([
            'laporan' => 'required|url', // Sesuaikan dengan aturan validasi yang diinginkan
        ]);

        // Ambil data siswa yang sedang login
        $siswa = User::where('email', Auth::user()->email)->first();

        // Ambil bimbingan siswa berdasarkan NIS
        $bimbinganSiswa = $siswa->bimbingansiswa;

        // Cek apakah sudah ada data bimbingan siswa
        if ($bimbinganSiswa) {
            // Update kolom laporan dengan data dari request
            $bimbinganSiswa->update([
                'laporan' => $request->laporan,
            ]);

            // Periksa action yang diambil dari tombol submit/update
            if ($request->action == 'submit') {
                // Tombol Submit: Set status menjadi 'Sudah Mengumpulkan'
                $bimbinganSiswa->update(['status' => 'Sudah Mengumpulkan']);
            } elseif ($request->action == 'update') {
                // Tombol Update: Set status menjadi 'Sudah Mengumpulkan'
                $bimbinganSiswa->update(['status' => 'Sudah Mengumpulkan']);
            }

            // Tambahkan pesan sukses atau sesuaikan dengan kebutuhan
            return redirect()->back()->with('success', 'Laporan berhasil diunggah!');
        } else {
            // Tambahkan pesan error atau sesuaikan dengan kebutuhan
            return redirect()->back()->with('error', 'Data bimbingan siswa tidak ditemukan.');
        }
    }


    public function pengaturan()
    {
        $siswa = User::where('email', Auth::user()->email)->first();
        return view('siswa.pengaturan', [
            'siswa' => $siswa,
        ]);
    }

    public function update(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'telp' => 'string|nullable',
            'email' => 'email|nullable',
            'imageUpload' => 'image|mimes:jpeg,png,jpg|nullable|max:20480', // Batasan file gambar
        ]);


        $siswa = Auth::user();

        // Cek field yang diubah
        $updatedFields = [];

        if ($request->has('telp') && $request->telp != $siswa->telp) {
            $siswa->telp = $request->telp;
            $updatedFields[] = 'No. Telp';
        }

        if ($request->has('email') && $request->email != $siswa->email) {
            $siswa->email = $request->email;
            $updatedFields[] = 'Email';
        }

        // Unggah dan simpan gambar
        if ($request->hasFile('imageUpload')) {
            // Hapus gambar lama jika ada
            if ($siswa->image) {
                $siswa->image = null; // Hapus gambar lama dari kolom blob
            }

            // Konversi dan simpan gambar baru ke dalam format blob
            $imagePath = $request->file('imageUpload')->get(); // Ambil binary data gambar
            $siswa->image = $imagePath; // Konversi binary ke dalam format base64
            $updatedFields[] = 'Gambar Profil';
        }

        // Simpan perubahan
        $siswa->save();

        if (!empty($updatedFields)) {
            // Set pesan flash 'success' berdasarkan field yang diupdate
            $message = implode(', ', $updatedFields) . ' berhasil diperbarui.';
            session()->flash('success', $message);
        }

        return redirect()->back();
    }

    public function showchangepassword()
    {
        $siswa = User::where('email', Auth::user()->email)->first();
        return view('siswa.password', [
            'siswa' => $siswa,
        ]);
    }

    public function changepassword(Request $request)
    {


        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'

        ], [
            'current_password.required' => 'Current Password tidak boleh kosong'
        ]);
        if (Hash::check($request->current_password, Auth::user()->password)) {
            Auth()->user()->update(['password' => Hash::make($request->password)]);
            return back()->with('message', 'Password anda telah diperbarui');
        }
        throw ValidationException::withMessages([
            'current_password' => 'Current password anda tidak sesuai',
        ]);
    }

    
}
