<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Permohonan;
use App\Models\Bimbingan;
use App\Models\InformasiTempatPrakerin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Imports\SiswaImport;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // Memfilter guru berdasarkan jurusan admin yang sedang login
        if($admin->jurusan){
            //jika admin memiliki jurusan
            $guru = User::where('role', 'guru')
                ->where(function ($query) use ($admin) {
                $query->whereNull('jurusan')
                    ->orWhere('jurusan', $admin->jurusan);
            })->get();
            } else {
                //jika admin tidak memiliki jurusan, tampilkan semua guru
                $guru = User::where('role', 'guru')->get();
            }
        
        if($admin->jurusan){
            //jika admin memiliki jurusan
            $siswa = User::where('role', 'siswa')
                ->where(function ($query) use ($admin) {
                $query->whereNull('jurusan')
                    ->orWhere('jurusan', $admin->jurusan);
            })
            ->where('status', 'Sedang Prakerin')
            ->get();
            } else {
                //jika admin tidak memiliki jurusan, tampilkan semua guru
                $siswa = User::where('role', 'siswa')
                ->where('status', 'Sedang Prakerin')
                ->get();
            }

        // Menghitung jumlah guru pembimbing
        $jumlahGuruPembimbing = $guru->count();

        // Menghitung jumlah siswa
        $jumlahSiswa = $siswa->count();

        // Menghitung jumlah bimbingan
        $jumlahBimbingan = Bimbingan::count();

        // Menghitung jumlah permohonan
        $jumlahPermohonan = Permohonan::count();

        return view('admin.dashboard',[
            'jumlahGuruPembimbing' => $jumlahGuruPembimbing,
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahBimbingan' => $jumlahBimbingan,
            'jumlahPermohonan' => $jumlahPermohonan,
        ]);
    }

    public function permohonan() 
    {
        $admin = Auth::user();

        // Memfilter data permohonan berdasarkan jurusan admin yang sedang login
        if ($admin->jurusan) {
            // Jika admin memiliki jurusan
            $dataPermohonan = Permohonan::join('users', 'permohonans.NIS', '=', 'users.NIS')
                ->where(function ($query) use ($admin) {
                    $query->whereNull('users.jurusan')
                        ->orWhere('users.jurusan', $admin->jurusan);
                })
                ->get(['permohonans.*', 'users.jurusan']); // Ambil kolom 'jurusan' dari tabel 'users'
        } else {
            // Jika admin tidak memiliki jurusan, tampilkan semua data permohonan
            $dataPermohonan = Permohonan::get();
        }

        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];

        // dd($dataPermohonan);

        // Ambil data bimbingan beserta relasinya

        // NIS pemohonan yang ada di sini adalah 'belongs to' tabel user. jadi ini miliknya dia (perbandingan dengan 
        // controller permohonan pada siswacontroller)

        // $dataPemohon = Permohonan::with('siswa')->get();

        return view('admin.permohonan', [
            'dataPermohonan' => $dataPermohonan,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    public function statuspermohonan(Request $request, $id) {
        $permohonan = Permohonan::find($id);
    
        if (!$permohonan) {
            // Handle jika permohonan tidak ditemukan
        }
    
        if ($request->has('btnMengajukan')) {
            $permohonan->status = 'Mengajukan';
        } elseif ($request->has('btnDiterima')) {
            $permohonan->status = 'Diterima';
        }
    
        $permohonan->save();
    

        return redirect()->back()->with('success', 'Status permohonan berhasil diubah.');
        // Redirect atau kembali ke halaman yang sesuai
    }
    
    public function hapuspermohonan($id) {
        // Temukan permohonan berdasarkan ID
        $permohonan = Permohonan::find($id);
    
        if (!$permohonan) {
            // Handle jika permohonan tidak ditemukan
            return redirect()->back()->with('error', 'Permohonan tidak ditemukan.');
        }
    
        // Ambil siswa berdasarkan NIS
        $siswa = User::where('NIS', $permohonan->NIS)->first();
    
        if ($siswa) {
            // Ubah status siswa menjadi 'Belum Mendaftar'
            $siswa->status = 'Belum Mendaftar';
            $siswa->save();
        }
    
        // Hapus permohonan
        $permohonan->delete();
    
        return redirect()->back()->with('error', 'Permohonan berhasil dihapus.');
    }

    public function permohonaneditview($id)
    {
        // Mendapatkan satu data permohonan berdasarkan ID
        $dataPermohonan = Permohonan::find($id);
    
        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
        return view('admin.permohonanedit', [
            'dataPermohonan' => $dataPermohonan,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }
    
    public function permohonanedit($id, Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tempat_prakerin' => 'string|nullable',
            'alamat_tempat_prakerin' => 'string|nullable',
            'email_tempat_prakerin' => 'string|nullable',
            'telp_tempat_prakerin' => 'string|nullable',
            'tanggal_mulai' => 'nullable|date_format:d-m-Y',
            'tanggal_selesai' => 'nullable|date_format:d-m-Y',
        ]);

        // Konversi format tanggal mulai
        $validatedData['tanggal_mulai'] = $validatedData['tanggal_mulai']
            ? Carbon::createFromFormat('d-m-Y', $validatedData['tanggal_mulai'])->toDateString()
            : null;

        // Konversi format tanggal selesai
        $validatedData['tanggal_selesai'] = $validatedData['tanggal_selesai']
            ? Carbon::createFromFormat('d-m-Y', $validatedData['tanggal_selesai'])->toDateString()
            : null;

        // Temukan data permohonan berdasarkan ID
        $dataPermohonan = Permohonan::find($id);

        // Cek apakah data permohonan ditemukan
        if (!$dataPermohonan) {
            // Handle jika data permohonan tidak ditemukan, misalnya redirect atau tampilkan pesan error
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Update data permohonan dengan data baru
        $dataPermohonan->update($validatedData);

        // Simpan perubahan
        $dataPermohonan->save();

        // Tampilkan pesan sukses
        session()->flash('success', 'Data berhasil diperbarui.');

        // Redirect kembali ke halaman edit
        return redirect()->route('admin.permohonaneditview', $dataPermohonan->id);
    }

    
    public function suratpermohonan($id)
    {
        // Mendapatkan satu data permohonan berdasarkan ID
        $dataPermohonan = Permohonan::find($id);
    
        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
        return view('admin.pdf.suratpermohonan', [
            'dataPermohonan' => $dataPermohonan,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function datasiswa()
    {
        // Mendapatkan admin yang sedang login
        $admin = Auth::user();

        // Memfilter siswa berdasarkan jurusan admin yang sedang login
        $query = User::where('role', 'siswa');

        if ($admin->jurusan) {
            $query->where('jurusan', $admin->jurusan);
        }

        // Mendapatkan data siswa
        $siswa = $query->get();

        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];

        return view('admin.datasiswa', [
            'siswa' => $siswa,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }


    public function tambahdatasiswa(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'NIS' => 'string|nullable',
                'name' => 'string|nullable',
                'jurusan' => 'string|nullable',
                'kelas' => 'string|nullable',
                'telp' => 'string|nullable',
                'email' => 'email|nullable',
                'status' => 'string|nullable',
            ]);
    
            // Buat objek user baru (siswa)
            $siswa = new User;
    
            // Set nilai atribut user (siswa) sesuai dengan data yang diterima dari formulir
            $siswa->NIS = $request->NIS;
            $siswa->name = $request->name;
            $siswa->jurusan = $request->jurusan;
            $siswa->kelas = $request->kelas;
            $siswa->telp = $request->telp;
            $siswa->email = $request->email;
            $siswa->status = $request->status;
    
            // Simpan data user (siswa) ke dalam database
            $siswa->save();
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil disimpan
            session()->flash('success', 'Data siswa berhasil ditambahkan.');
    
            // Redirect ke halaman yang sesuai, misalnya index siswa
            return redirect()->route('admin.datasiswa'); // Sesuaikan dengan nama route yang Anda gunakan untuk menampilkan daftar siswa
        } catch (QueryException $e) {
            // Tangani kesalahan query jika terjadi, misalnya duplikasi data
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangani kesalahan umum jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambahfiledatasiswa(Request $request)
    {
        // Validasi file Excel
        $request->validate([
            'excelFileSiswa' => 'required|mimes:xls,xlsx|max:2048',
        ]);
    
        // Ambil file Excel dari request
        $file = $request->file('excelFileSiswa');
    
        // Baca data Excel dan impor ke dalam database
        try {
            Excel::import(new SiswaImport, $file);
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil disimpan
            session()->flash('success', 'Data siswa berhasil ditambahkan dari file Excel.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi, misalnya file tidak valid atau format tidak sesuai
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    
        // Redirect ke halaman yang sesuai, misalnya index siswa
        return redirect()->route('admin.datasiswa');
    }

    public function datasiswaeditview($id){
        // Mendapatkan admin yang sedang login
        $admin = Auth::user();

        // Memfilter siswa berdasarkan jurusan admin yang sedang login
        $query = User::where('role', 'siswa');

        if ($admin->jurusan) {
            $query->where('jurusan', $admin->jurusan);
        }

        // Mendapatkan data siswa
        $siswa = $query->get();

        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];

        $siswa = User::find($id);
        
        return view('admin.datasiswaedit', [
            'siswa' => $siswa,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    public function datasiswaedit($id, Request $request){
        // Validasi input
        $validatedData = $request->validate([
            'NIS' => 'string|nullable',
            'name' => 'string|nullable',
            'jurusan' => 'string|nullable',
            'kelas' => 'string|nullable',
            'telp' => 'string|nullable',
            'email' => 'email|nullable',
            'status' => 'string|nullable',
        ]);
    
        // Temukan siswa berdasarkan ID
        $siswa = User::find($id);
    
        // Cek apakah siswa ditemukan
        if (!$siswa) {
            // Handle jika siswa tidak ditemukan, misalnya redirect atau tampilkan pesan error
            return redirect()->back()->with('error', 'Siswa tidak ditemukan');
        }
    
        // Cek field yang diubah
        $updatedFields = [];
    
        // Iterasi melalui properti yang validasi lulus
        foreach ($validatedData as $field => $value) {
            if ($request->has($field) && $request->$field != $siswa->$field) {
                $siswa->$field = $value;
                $updatedFields[] = $field;
            }
        }
    
        // Simpan perubahan
        $siswa->save();
    
        if (!empty($updatedFields)) {
            session()->flash('success', 'Data siswa berhasil diperbarui.');
        }
    
        return redirect()->back();
    }

    public function datasiswasoftdelete($id)
    {
        try {
            // Cari siswa berdasarkan ID
            $siswa = User::find($id);
    
            if (!$siswa) {
                return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
            }
    
            // Soft delete siswa
            $siswa->delete();
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil dihapus
            session()->flash('success', 'Data siswa berhasil dihapus.');
    
            // Redirect kembali ke halaman data siswa
            return redirect()->route('admin.datasiswa');
        } catch (QueryException $e) {
            // Tangani kesalahan query jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangani kesalahan umum jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function softdeleteSelectedSiswa(Request $request)
    {
        $action = $request->input('action');
        $selectedIds = $request->input('selectedIds');
    
        try {
            switch ($action) {
                case 'delete':
                    $deletedCount = User::whereIn('id', $selectedIds)->delete();
                    if ($deletedCount > 0) {
                        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal menghapus data.');
                    }
                    break;
    
                default:
                    return redirect()->back()->with('error', 'Aksi tidak valid.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function trashsiswaview()
    {
        // Mendapatkan admin yang sedang login
        $admin = Auth::user();
    
        // Memfilter siswa yang telah di-soft delete berdasarkan jurusan admin yang sedang login
        $query = User::onlyTrashed()->where('role', 'siswa');
    
        if ($admin->jurusan) {
            $query->where('jurusan', $admin->jurusan);
        }
    
        // Mendapatkan data siswa yang telah di-soft delete
        $deletedSiswa = $query->get();
    
        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
        // Kirim data siswa yang telah di-soft delete ke view
        return view('admin.trash.trashsiswa', [
            'deletedSiswa' => $deletedSiswa,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    public function datasiswadelete($id){
        // Hapus data secara permanen dari database
        User::where('id', $id)->forceDelete();
    
        return redirect()->back()->with('success', 'Data siswa berhasil dihapus permanen.');
    }

    
    public function restoresiswa(Request $request, $id)
    {
        $siswa = User::withTrashed()->find($id);
    
        if ($siswa) {
            $siswa->restore();
    
            // Tambahkan dd untuk mengecek pesan
            // dd('Data berhasil dipulihkan.');
    
            return redirect()->route('admin.trashsiswaview')->with('success', 'Data siswa berhasil direstore.');
        }
    
        return redirect()->route('admin.trashsiswaview')->with('error', 'Data siswa tidak ditemukan.');
    }
    
    public function handleSelectedSiswa(Request $request)
    {
        $action = $request->input('action');
        $selectedIds = $request->input('selectedIds');
    
        try {
            switch ($action) {
                case 'restore':
                    $restoredCount = User::withTrashed()->whereIn('id', $selectedIds)->restore();
                    if ($restoredCount > 0) {
                        return redirect()->back()->with('success', 'Data siswa berhasil direstore.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal melakukan restore data.');
                    }
                    break;
    
                case 'delete':
                    $deletedCount = User::whereIn('id', $selectedIds)->forceDelete();
                    if ($deletedCount > 0) {
                        return redirect()->back()->with('success', 'Data siswa berhasil dihapus permanen.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal menghapus data permanen.');
                    }
                    break;
    
                default:
                    return redirect()->back()->with('error', 'Aksi tidak valid.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function dataguru()
    {
        // Mendapatkan admin yang sedang login
        $admin = Auth::user();

        // Memfilter guru berdasarkan jurusan admin yang sedang login
        if($admin->jurusan){
            //jika admin memiliki jurusan
            $guru = User::where('role', 'guru')
                ->where(function ($query) use ($admin) {
                $query->whereNull('jurusan')
                    ->orWhere('jurusan', $admin->jurusan);
            })->get();
            } else {
                //jika admin tidak memiliki jurusan, tampilkan semua guru
                $guru = User::where('role', 'guru')->get();
            }
        
        // Mapping jurusan
        $jurusanGuruMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];

        return view('admin.dataguru', [
            'guru' => $guru,
            'jurusanGuruMapping' => $jurusanGuruMapping,
        ]);
    }

    public function tambahdataguru(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'NIP' => 'string|nullable',
                'name' => 'string|nullable',
                'jurusan' => 'string|nullable',
                'kuota_bimbingan' => 'integer|nullable',
                'telp' => 'string|nullable',
                'email' => 'email|nullable',
            ]);
    
            // Buat objek user baru (guru)
            $guru = new User;
    
            // Set nilai atribut user (guru) sesuai dengan data yang diterima dari formulir
            $guru->NIP = $request->NIP;
            $guru->name = $request->name;
            $guru->jurusan = $request->jurusan;
            $guru->kuota_bimbingan = $request->kuota_bimbingan;
            $guru->telp = $request->telp;
            $guru->email = $request->email;
    
            // Set role ke "guru"
            $guru->role = 'guru';
    
            // Simpan data user (guru) ke dalam database
            $guru->save();
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil disimpan
            session()->flash('success', 'Data guru pembimbing berhasil ditambahkan.');
    
            // Redirect ke halaman yang sesuai, misalnya index guru
            return redirect()->route('admin.dataguru'); // Sesuaikan dengan nama route yang Anda gunakan untuk menampilkan daftar guru
        } catch (QueryException $e) {
            // Tangani kesalahan query jika terjadi, misalnya duplikasi data
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangani kesalahan umum jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambahfiledataguru(Request $request)
    {
        // Validasi file Excel
        $request->validate([
            'excelFileGuru' => 'required|mimes:xls,xlsx|max:2048',
        ]);
    
        // Ambil file Excel dari request
        $file = $request->file('excelFileGuru');
    
        // Baca data Excel dan impor ke dalam database
        try {
            Excel::import(new GuruImport, $file);
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil disimpan
            session()->flash('success', 'Data guru berhasil ditambahkan dari file Excel.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi, misalnya file tidak valid atau format tidak sesuai
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    
        // Redirect ke halaman yang sesuai, misalnya index guru
        return redirect()->route('admin.dataguru');
    }

    public function datagurueditview($id){
        $guru = User::find($id);
        
        return view('admin.dataguruedit', [
            'guru' => $guru,
        ]);
    }
    
    public function dataguruedit($id, Request $request){
        // Validasi input
        $validatedData = $request->validate([
            'NIP' => 'string|nullable',
            'name' => 'string|nullable',
            'kuota_bimbingan' => 'integer|nullable',
            'telp' => 'string|nullable',
            'email' => 'email|nullable',
        ]);
    
        // Temukan guru berdasarkan ID
        $guru = User::find($id);
    
        // Cek apakah guru ditemukan
        if (!$guru) {
            // Handle jika guru tidak ditemukan, misalnya redirect atau tampilkan pesan error
            return redirect()->back()->with('error', 'Guru tidak ditemukan');
        }
    
        // Cek field yang diubah
        $updatedFields = [];
    
        // Iterasi melalui properti yang validasi lulus
        foreach ($validatedData as $field => $value) {
            if ($request->has($field) && $request->$field != $guru->$field) {
                $guru->$field = $value;
                $updatedFields[] = $field;
            }
        }
    
        // Simpan perubahan
        $guru->save();
    
        if (!empty($updatedFields)) {
            session()->flash('success', 'Data guru pembimbing berhasil diperbarui.');
        }
    
        return redirect()->back();
    }

    public function datagurusoftdelete($id)
    {
        try {
            // Cari guru berdasarkan ID
            $guru = User::find($id);
    
            if (!$guru) {
                return redirect()->back()->with('error', 'guru tidak ditemukan.');
            }
    
            // Soft delete guru
            $guru->delete();
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil dihapus
            session()->flash('success', 'Data guru berhasil dihapus.');
    
            // Redirect kembali ke halaman data guru
            return redirect()->route('admin.dataguru');
        } catch (QueryException $e) {
            // Tangani kesalahan query jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangani kesalahan umum jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function softdeleteSelectedGuru(Request $request)
    {
        $action = $request->input('action');
        $selectedIds = $request->input('selectedIds');
    
        try {
            switch ($action) {
                case 'delete':
                    $deletedCount = User::whereIn('id', $selectedIds)->delete();
                    if ($deletedCount > 0) {
                        return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal menghapus data.');
                    }
                    break;
    
                default:
                    return redirect()->back()->with('error', 'Aksi tidak valid.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function trashguruview()
    {
        // Mendapatkan admin yang sedang login
        $admin = Auth::user();
    
        // Memfilter guru yang telah di-soft delete berdasarkan jurusan admin yang sedang login
        $query = User::onlyTrashed()->where('role', 'guru');
    
        if ($admin->jurusan) {
            $query->where('jurusan', $admin->jurusan);
        }
    
        // Mendapatkan data guru yang telah di-soft delete
        $deletedGuru = $query->get();
    
        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
        // Kirim data guru yang telah di-soft delete ke view
        return view('admin.trash.trashguru', [
            'deletedGuru' => $deletedGuru,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    public function datagurudelete($id){
        // Hapus data secara permanen dari database
        User::where('id', $id)->forceDelete();
    
        return redirect()->back()->with('success', 'Data guru berhasil dihapus permanen.');
    }

    
    public function restoreguru(Request $request, $id)
    {
        $guru = User::withTrashed()->find($id);
    
        if ($guru) {
            $guru->restore();
    
            // Tambahkan dd untuk mengecek pesan
            // dd('Data berhasil dipulihkan.');
    
            return redirect()->route('admin.trashguruview')->with('success', 'Data guru berhasil direstore.');
        }
    
        return redirect()->route('admin.trashguruview')->with('error', 'Data guru tidak ditemukan.');
    }
    
    public function handleSelectedGuru(Request $request)
    {
        $action = $request->input('action');
        $selectedIds = $request->input('selectedIds');
    
        try {
            switch ($action) {
                case 'restore':
                    $restoredCount = User::withTrashed()->whereIn('id', $selectedIds)->restore();
                    if ($restoredCount > 0) {
                        return redirect()->back()->with('success', 'Data guru berhasil direstore.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal melakukan restore data.');
                    }
                    break;
    
                case 'delete':
                    $deletedCount = User::whereIn('id', $selectedIds)->forceDelete();
                    if ($deletedCount > 0) {
                        return redirect()->back()->with('success', 'Data guru berhasil dihapus permanen.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal menghapus data permanen.');
                    }
                    break;
    
                default:
                    return redirect()->back()->with('error', 'Aksi tidak valid.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function datatempatprakerin()
    {
        return view('admin.datatempatprakerin');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function datapembagianbimbingan()
    {
        // Mendapatkan admin yang sedang login
        $admin = Auth::user();
    
        // Memfilter guru berdasarkan jurusan admin yang sedang login
        if ($admin->jurusan) {
            // Jika admin memiliki jurusan
            $guru = User::where('role', 'guru')
                ->where(function ($query) use ($admin) {
                    $query->whereNull('jurusan')
                        ->orWhere('jurusan', $admin->jurusan);
                })->get();
        } else {
            // Jika admin tidak memiliki jurusan, tampilkan semua guru
            $guru = User::where('role', 'guru')->get();
        }
    
        // Mapping jurusan
        $jurusanGuruMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
        // Ambil data siswa yang memiliki jurusan sama dengan guru dan memiliki status diterima
        // $siswa = Permohonan::where('status', 'Diterima')
        //     ->where(function ($query) use ($guru) {
        //         $query->whereIn('jurusan', $guru->pluck('jurusan'));
        //     })->get();

        // Ambil data siswa yang memiliki jurusan sama dengan guru dan memiliki status diterima
        $siswa = Permohonan::where('status', 'Diterima')
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->whereIn('jurusan', $guru->pluck('jurusan'));
            })
            ->with(['siswa' => function ($query) {
                $query->select('NIS', 'name', 'jurusan'); // Pilih kolom yang ingin diambil dari tabel user
            }])
            ->get();

        // dd($siswa);
    
        // Ambil data guru (nip) yang ada di tabel bimbingan
        $guruBimbingan = Bimbingan::pluck('NIP')->toArray();
    
        // Ambil data siswa (nis) yang ada di tabel bimbingan
        $siswaBimbingan = Bimbingan::pluck('NIS')->toArray();

        
        // Menyiapkan data sisa kuota bimbingan guru
        $siswaBimbinganCount = [];

        foreach ($guru as $guruItem) {
            $siswaBimbinganCount[$guruItem->NIP] = $guruItem->bimbingan->count();
        }
        //dd($siswaBimbinganCount);

        // Ambil data bimbingan beserta relasinya
        $dataBimbingan = Bimbingan::with(['guru', 'siswa'])->get();

        //dd($dataBimbingan);
    
        return view('admin.datapembagianbimbingan', [
            'guru' => $guru,
            'jurusanGuruMapping' => $jurusanGuruMapping,
            'siswa' => $siswa,
            'guruBimbingan' => $guruBimbingan,
            'siswaBimbingan' => $siswaBimbingan,
            'siswaBimbinganCount' => $siswaBimbinganCount,
            'dataBimbingan' => $dataBimbingan,
        ]);
    }
    

    public function datapembagianbimbinganeditview($id){
        // Ambil data bimbingan beserta relasinya
        $dataBimbingan = Bimbingan::with(['guru', 'siswa'])->find($id);

        // Ambil data permohonan siswa
        $dataPermohonan = $dataBimbingan->siswa->permohonan;

        // dd($dataPermohonan);
    
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
    
        return view('admin.datapembagianbimbinganedit', [
            'dataBimbingan' => $dataBimbingan,
            'dataPermohonan' => $dataPermohonan,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    public function tambahdatapembagianbimbingan(Request $request)
    {
        // dd($request->all());
        try {
            // Ambil data dari request
            $nip = $request->input('NIP');
            $nisArray = $request->input('NIS');

            // Hapus elemen array yang kosong atau bernilai null
            $nisArray = array_filter($nisArray);

            // Lakukan validasi data (sesuai kebutuhan)

            // Loop untuk menyimpan data
            foreach ($nisArray as $nis) {
                // Ambil data siswa dari tabel user
                $siswa = User::where('NIS', $nis)->first();

                // Buat entri baru di tabel bimbingan
                Bimbingan::create([
                    'NIP' => $nip,
                    'NIS' => $nis,
                    'status' => 'Belum Mengumpulkan',
                ]);

                // Update status siswa pada tabel user menjadi "Sedang Prakerin"
                $siswa->update(['status' => 'Sedang Prakerin']);
            }

            return Redirect::back()->with('success', 'Data pembagian bimbingan berhasil disimpan.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function datapembagianbimbinganedit($id, Request $request)
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
    
            session()->flash('success', 'Nilai berhasil diperbarui.');
        } else {
            session()->flash('info', 'Tidak ada perubahan nilai.');
        }
    
        return redirect()->back();
    }
    
    public function datapembagianbimbingandelete($id){
        Bimbingan::destroy($id);

        return redirect()->back()->with('success', 'Data pembagian bimbingan berhasil dihapus.');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function informasiprakerin()
    {
        $informasiTempatPrakerin = InformasiTempatPrakerin::all();

        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
        return view('admin.informasiprakerin', [
            'informasiTempatPrakerin' => $informasiTempatPrakerin,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    public function tambahinformasiprakerin(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'namaperusahaan' => 'string|nullable',
                'gambar' => 'nullable', // Hapus validasi gambar
                'deskripsi' => 'string|nullable',
                'posisi' => 'string|nullable',
                'jurusan' => 'string|nullable',
                'persyaratan' => 'string|nullable',
                'email' => 'email|nullable',
                'telp' => 'string|nullable',
                'alamat' => 'string|nullable',
            ]);
    
            $gambarBlob = null;

            if ($request->hasFile('gambar')) {
                $gambarBlob = base64_encode(file_get_contents($request->file('gambar')->path()));
            }
    
            // Membuat objek baru
            $info = new InformasiTempatPrakerin;
    
            // Menetapkan nilai atribut sesuai dengan data yang diterima dari formulir
            $info->nama_perusahaan = $request->namaperusahaan;
            $info->image = $gambarBlob;
            $info->deskripsi = $request->deskripsi;
            $info->posisi = $request->posisi;
            $info->jurusan = $request->jurusan;
            $info->persyaratan = $request->persyaratan;
            $info->telp = $request->telp;
            $info->email = $request->email;
            $info->alamat = $request->alamat;
    
            // Menyimpan data ke dalam database
            $info->save();
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil disimpan
            session()->flash('success', 'Data informasi tempat prakerin berhasil ditambahkan.');
    
            // Redirect ke halaman yang sesuai, misalnya index informasi prakerin
            return redirect()->route('admin.informasiprakerin');
        } catch (QueryException $e) {
            // Tangani kesalahan query jika terjadi, misalnya duplikasi data
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangani kesalahan umum jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editinfoprakview($id)
    {
        $informasiTempatPrakerin = InformasiTempatPrakerin::find($id);

        if (!$informasiTempatPrakerin) {
            // Handle jika data tidak ditemukan, misalnya redirect ke halaman tertentu atau tampilkan pesan error
            return redirect()->route('admin.informasiprakerin')->with('error', 'Data tidak ditemukan.');
        }

        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];

        return view('admin.editinfoprak', [
            'informasiTempatPrakerin' => $informasiTempatPrakerin,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }

    public function editinfoprak($id, Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nama_perusahaan' => 'string|nullable',
                'deskripsi' => 'string|nullable',
                'posisi' => 'string|nullable',
                'jurusan' => 'string|nullable',
                'persyaratan' => 'string|nullable',
                'email' => 'email|nullable',
                'telp' => 'string|nullable',
                'alamat' => 'string|nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            // Temukan informasi tempat prakerin berdasarkan ID
            $informasiTempatPrakerin = InformasiTempatPrakerin::find($id);
    
            // Cek apakah informasi tempat prakerin ditemukan
            if (!$informasiTempatPrakerin) {
                // Handle jika informasi tempat prakerin tidak ditemukan, misalnya redirect atau tampilkan pesan error
                return redirect()->back()->with('error', 'Informasi tempat prakerin tidak ditemukan');
            }
    
            // Cek field yang diubah
            $updatedFields = [];
    
            // Iterasi melalui properti yang validasi lulus
            foreach ($validatedData as $field => $value) {
                if ($request->has($field) && $request->$field != $informasiTempatPrakerin->$field) {
                    $informasiTempatPrakerin->$field = $value;
                    $updatedFields[] = $field;
                }
            }

            $gambarBlob = null;
            // Update gambar jika ada yang diunggah
            if ($request->hasFile('image')) {
                $gambarBlob = base64_encode(file_get_contents($request->file('image')->path()));
                $informasiTempatPrakerin->image = $gambarBlob;
                $updatedFields[] = 'image';
            }
    
            // Simpan perubahan
            $informasiTempatPrakerin->save();
    
            if (!empty($updatedFields)) {
                session()->flash('success', 'Data informasi tempat prakerin berhasil diperbarui.');
            }
    
            return redirect()->back();
        } catch (QueryException $e) {
            // Tangani kesalahan query jika terjadi, misalnya duplikasi data
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangani kesalahan umum jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function infopraksoftdelete($id)
    {
        try {
            // Cari Informasi tempat prakerin berdasarkan ID
            $informasiTempatPrakerin = InformasiTempatPrakerin::find($id);
    
            if (!$informasiTempatPrakerin) {
                // Handle jika data tidak ditemukan, misalnya redirect ke halaman tertentu atau tampilkan pesan error
                return redirect()->route('admin.informasiprakerin')->with('error', 'Data tidak ditemukan.');
            }
    
            // Soft delete infoprak
            $informasiTempatPrakerin->delete();
    
            // Set pesan flash 'success' untuk memberi tahu admin bahwa data berhasil dihapus
            session()->flash('success', 'Data informasi tempat prakerin berhasil dihapus.');
    
            // Redirect kembali ke halaman data infoprak
            return redirect()->route('admin.informasiprakerin');
        } catch (QueryException $e) {
            // Tangani kesalahan query jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Tangani kesalahan umum jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function softdeleteselectedinfoprak(Request $request)
    {
        // dd($request->all());

        $action = $request->input('action');
        $selectedIds = $request->input('selectedIds');
    
        try {
            switch ($action) {
                case 'delete':
                    $deletedCount = InformasiTempatPrakerin::whereIn('id', $selectedIds)->delete();
                    if ($deletedCount > 0) {
                        return redirect()->back()->with('success', 'Data berhasil dihapus.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal menghapus data.');
                    }
                    break;
    
                default:
                    return redirect()->back()->with('error', 'Aksi tidak valid.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function trashinfoprakview()
    {
        // Mendapatkan data infoprak yang telah di-soft delete
        $deletedinfoprak = InformasiTempatPrakerin::onlyTrashed()->get();
    
        // Mapping jurusan
        $jurusanMapping = [
            'DPIB' => 'Desain Pemodelan dan Informasi Bangunan',
            'TE' => 'Teknik Elektronika',
            'TJKT' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'TK' => 'Teknik Ketenagalistrikan',
            'TM' => 'Teknik Mesin',
            'TO' => 'Teknik Otomotif',
            'TPFL' => 'Teknik Pengelasan dan Fabrikasi Logam',
        ];
    
        // Kirim data infoprak yang telah di-soft delete ke view
        return view('admin.trash.trashinfoprak', [
            'deletedinfoprak' => $deletedinfoprak,
            'jurusanMapping' => $jurusanMapping,
        ]);
    }
    
    public function restoreinfoprak(Request $request, $id)
    {
        try {
            // Gunakan metode findOrFail untuk menghindari cek manual
            $informasiTempatPrakerin = InformasiTempatPrakerin::withTrashed()->findOrFail($id);
    
            // Lakukan restore
            $informasiTempatPrakerin->restore();
    
            return redirect()->route('admin.trashinfoprakview')->with('success', 'Data informasi tempat prakerin berhasil direstore.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return redirect()->route('admin.trashinfoprakview')->with('error', 'Data informasi tempat prakerin tidak ditemukan.');
        }
    }
    
    public function infoprakdelete($id){
        // Hapus data secara permanen dari database
        InformasiTempatPrakerin::where('id', $id)->forceDelete();
    
        return redirect()->back()->with('success', 'Data informasi tempat prakerin berhasil dihapus permanen.');
    }

    public function handleSelectedInfoprak(Request $request)
    {
        $action = $request->input('action');
        $selectedIds = $request->input('selectedIds');
    
        try {
            switch ($action) {
                case 'restore':
                    $restoredCount = InformasiTempatPrakerin::withTrashed()->whereIn('id', $selectedIds)->restore();
                    if ($restoredCount > 0) {
                        return redirect()->back()->with('success', 'Data informasi tempat prakerin berhasil direstore.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal melakukan restore data.');
                    }
                    break;
    
                case 'delete':
                    $deletedCount = InformasiTempatPrakerin::whereIn('id', $selectedIds)->forceDelete();
                    if ($deletedCount > 0) {
                        return redirect()->back()->with('success', 'Data informasi tempat prakerin berhasil dihapus permanen.');
                    } else {
                        return redirect()->back()->with('error', 'Gagal menghapus data permanen.');
                    }
                    break;
    
                default:
                    return redirect()->back()->with('error', 'Aksi tidak valid.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
