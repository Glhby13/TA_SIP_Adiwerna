<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('/informasi-prakerin', [WelcomeController::class, 'informasiprak'])->name('informasiprak');
    Route::get('/informasi-prakerin/detail/{id}', [WelcomeController::class, 'detailinfo'])->name('detailinfo');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth', 'useraccess:siswa', 'preventBackButton', 'disableCaching'])->prefix('/siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/permohonan-prakerin', [SiswaController::class, 'permohonan'])->name('siswa.permohonan');
    Route::post('/permohonan-prakerin', [SiswaController::class, 'submitPermohonan'])->name('submit.permohonan');
    Route::post('/permohonan-balasan', [SiswaController::class, 'balasanPermohonan'])->name('balasan.permohonan');
    Route::get('/pengisian-jurnal', [SiswaController::class, 'jurnal'])->name('siswa.jurnal');
    Route::post('/pengisian-jurnal', [SiswaController::class, 'submitJurnal'])->name('submit.jurnal');
    Route::get('/data-jurnal', [SiswaController::class, 'jurnaldata'])->name('siswa.jurnaldata');
    Route::get('/edit-jurnal/{id}', [SiswaController::class, 'jurnaldataeditview'])->name('siswa.jurnaldataeditview');
    Route::post('/edit-jurnal/{id}', [SiswaController::class, 'jurnaldataedit'])->name('siswa.jurnaldataedit');
    Route::delete('/hapus-jurnal/{id}', [SiswaController::class, 'jurnaldelete'])->name('siswa.jurnaldelete');
    Route::get('/pengumpulan-laporan', [SiswaController::class, 'laporan'])->name('siswa.laporan');
    Route::post('/pengumpulan-laporan', [SiswaController::class, 'submitlaporan'])->name('submit.laporan');
    Route::get('/edit-profil', [SiswaController::class, 'pengaturan'])->name('siswa.pengaturan');
    Route::post('/edit-profil', [SiswaController::class, 'update'])->name('edit.profile');
    Route::get('/edit-password', [SiswaController::class, 'showchangepassword'])->name('show.changepassword');
    Route::post('/edit-password', [SiswaController::class, 'changepassword'])->name('change.password');
});

Route::middleware(['auth', 'useraccess:guru', 'preventBackButton', 'disableCaching'])->prefix('/guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/siswa-bimbingan', [GuruController::class, 'siswabimbingan'])->name('guru.siswabimbingan');
    Route::get('/jurnal-siswa/{NIS}', [GuruController::class, 'jurnaldata'])->name('guru.jurnaldata');
    Route::get('/penarikan', [GuruController::class, 'penarikan'])->name('guru.penarikan');
    Route::get('/surat-penarikan/{id}', [GuruController::class, 'suratpenarikan'])->name('guru.suratpenarikan');
    Route::get('/pengumpulan-laporan-siswa', [GuruController::class, 'pengumpulanlaporan'])->name('guru.pengumpulanlaporan');
    Route::post('/status-laporan/{id}', [GuruController::class, 'statuslaporan'])->name('status.laporan');
    Route::get('/nilai-laporan', [GuruController::class, 'nilailaporan'])->name('guru.nilailaporan');
    Route::post('/nilai/{id}', [GuruController::class, 'setnilailaporan'])->name('nilai.laporan');
});

Route::middleware(['auth', 'useraccess:admin', 'preventBackButton', 'disableCaching'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/permohonan', [AdminController::class, 'permohonan'])->name('admin.permohonan');
    Route::get('/permohonan/edit/{id}', [AdminController::class, 'permohonaneditview'])->name('admin.permohonaneditview');
    Route::post('/permohonan/edit/{id}', [AdminController::class, 'permohonanedit'])->name('admin.permohonanedit');
    Route::post('/status-permohonan/{id}', [AdminController::class, 'statuspermohonan'])->name('status.permohonan');
    Route::post('/hapus-permohonan/{id}', [AdminController::class, 'hapuspermohonan'])->name('hapus.permohonan');
    Route::get('/surat-permohonan/{id}', [AdminController::class, 'suratpermohonan'])->name('admin.suratpermohonan');

    Route::get('/data-siswa', [AdminController::class, 'datasiswa'])->name('admin.datasiswa');
    Route::post('/data-siswa', [AdminController::class, 'tambahdatasiswa'])->name('admin.tambahdatasiswa');
    Route::post('/data-siswa/file', [AdminController::class, 'tambahfiledatasiswa'])->name('admin.tambahfiledatasiswa');
    Route::get('/data-siswa/edit/{id}', [AdminController::class, 'datasiswaeditview'])->name('admin.datasiswaeditview');
    Route::post('/data-siswa/edit/{id}', [AdminController::class, 'datasiswaedit'])->name('admin.datasiswaedit');
    Route::delete('/data-siswa/delete/{id}', [AdminController::class, 'datasiswadelete'])->name('admin.datasiswadelete');
    Route::post('/data-siswa/softdeleteSelectedSiswa', [AdminController::class, 'softdeleteSelectedSiswa'])->name('admin.softdeleteSelectedSiswa');
    Route::get('/data-siswa/trash', [AdminController::class, 'trashsiswaview'])->name('admin.trashsiswaview');
    Route::post('/data-siswa/soft-delete/{id}', [AdminController::class, 'datasiswasoftdelete'])->name('admin.datasiswasoftdelete');
    Route::post('/data-siswa/restore/{id}', [AdminController::class, 'restoresiswa'])->name('admin.restoresiswa');
    Route::post('/data-siswa/selected', [AdminController::class, 'handleSelectedSiswa'])->name('admin.handleselectedsiswa');

    Route::get('/data-guru', [AdminController::class, 'dataguru'])->name('admin.dataguru');
    Route::post('/data-guru', [AdminController::class, 'tambahdataguru'])->name('admin.tambahdataguru');
    Route::post('/data-guru/file', [AdminController::class, 'tambahfiledataguru'])->name('admin.tambahfiledataguru');
    Route::get('/data-guru/edit/{id}', [AdminController::class, 'datagurueditview'])->name('admin.datagurueditview');
    Route::post('/data-guru/edit/{id}', [AdminController::class, 'dataguruedit'])->name('admin.dataguruedit');
    Route::delete('/data-guru/delete/{id}', [AdminController::class, 'datagurudelete'])->name('admin.datagurudelete');
    Route::post('/data-guru/softdeleteSelectedGuru', [AdminController::class, 'softdeleteSelectedGuru'])->name('admin.softdeleteSelectedGuru');
    Route::get('/data-guru/trash', [AdminController::class, 'trashguruview'])->name('admin.trashguruview');
    Route::post('/data-guru/soft-delete/{id}', [AdminController::class, 'datagurusoftdelete'])->name('admin.datagurusoftdelete');
    Route::post('/data-guru/restore/{id}', [AdminController::class, 'restoreguru'])->name('admin.restoreguru');
    Route::post('/data-guru/selected', [AdminController::class, 'handleSelectedGuru'])->name('admin.handleselectedguru');

    Route::get('/data-pembagian-bimbingan', [AdminController::class, 'datapembagianbimbingan'])->name('admin.datapembagianbimbingan');
    Route::post('/data-pembagian-bimbingan/tambah', [AdminController::class, 'tambahdatapembagianbimbingan'])->name('admin.tambahdatapembagianbimbingan');
    Route::get('/data-pembagian-bimbingan/edit/{id}', [AdminController::class, 'datapembagianbimbinganeditview'])->name('admin.datapembagianbimbinganeditview');
    Route::post('/data-pembagian-bimbingan/edit/{id}', [AdminController::class, 'datapembagianbimbinganedit'])->name('admin.datapembagianbimbinganedit');
    Route::post('/data-pembagian-bimbingan/softdeleteSelectedBimbingan', [AdminController::class, 'softdeleteSelectedBimbingan'])->name('admin.softdeleteSelectedBimbingan');
    Route::delete('/data-pembagian-bimbingan/delete/{id}', [AdminController::class, 'datapembagianbimbingandelete'])->name('admin.datapembagianbimbingandelete');
    Route::get('/data-pembagian-bimbingan/trash', [AdminController::class, 'trashdatapembagianbimbinganview'])->name('admin.trashdatapembagianbimbinganview');
    Route::post('/data-pembagian-bimbingan/soft-delete/{id}', [AdminController::class, 'datapembagianbimbingansoftdelete'])->name('admin.datapembagianbimbingansoftdelete');
    Route::post('/data-pembagian-bimbingan/restore/{id}', [AdminController::class, 'restoredatabimbingan'])->name('admin.restoredatabimbingan');
    Route::post('/data-pembagian-bimbingan/selected', [AdminController::class, 'handleSelectedBimbingan'])->name('admin.handleSelectedBimbingan');
    

    Route::get('/data-tempat-prakerin', [AdminController::class, 'datatempatprakerin'])->name('admin.datatempatprakerin');

    Route::get('/data-informasi-prakerin', [AdminController::class, 'informasiprakerin'])->name('admin.informasiprakerin');
    Route::post('/data-informasi-prakerin/tambah', [AdminController::class, 'tambahinformasiprakerin'])->name('admin.tambahinformasiprakerin');
    Route::get('/data-informasi-prakerin/edit/{id}', [AdminController::class, 'editinfoprakview'])->name('admin.editinfoprakview');
    Route::post('/data-informasi-prakerin/edit/{id}', [AdminController::class, 'editinfoprak'])->name('admin.editinfoprak');
    Route::delete('/data-informasi-prakerin/delete/{id}', [AdminController::class, 'infoprakdelete'])->name('admin.infoprakdelete');
    Route::post('/data-informasi-prakerin/softdeleteselected', [AdminController::class, 'softdeleteselectedinfoprak'])->name('admin.softdeleteselectedinfoprak');
    Route::get('/data-informasi-prakerin/trash', [AdminController::class, 'trashinfoprakview'])->name('admin.trashinfoprakview');
    Route::post('/data-informasi-prakerin/soft-delete/{id}', [AdminController::class, 'infopraksoftdelete'])->name('admin.infopraksoftdelete');
    Route::post('/data-informasi-prakerin/restore/{id}', [AdminController::class, 'restoreinfoprak'])->name('admin.restoreinfoprak');
    Route::post('/data-informasi-prakerin/selected', [AdminController::class, 'handleSelectedInfoprak'])->name('admin.handleSelectedInfoprak');

    Route::get('/data-kegiatan-prakerin', [AdminController::class, 'kegiatanprakerin'])->name('admin.kegiatanprakerin');
    Route::post('/data-kegiatan-prakerin/tambah', [AdminController::class, 'tambahkegiatanprakerin'])->name('admin.tambahkegiatanprakerin');
    Route::get('/data-kegiatan-prakerin/edit/{id}', [AdminController::class, 'editkegiatanprakerinview'])->name('admin.editkegiatanprakerinview');
    Route::post('/data-kegiatan-prakerin/edit/{id}', [AdminController::class, 'editkegiatanprakerin'])->name('admin.editkegiatanprakerin');
    Route::delete('/data-kegiatan-prakerin/delete/{id}', [AdminController::class, 'kegiatanprakerindelete'])->name('admin.kegiatanprakerindelete');
    Route::post('/data-kegiatan-prakerin/softdeleteselected', [AdminController::class, 'softdeleteselectedkegiatanprakerin'])->name('admin.softdeleteselectedkegiatanprakerin');
    Route::get('/data-kegiatan-prakerin/trash', [AdminController::class, 'trashkegiatanprakerinview'])->name('admin.trashkegiatanprakerinview');
    Route::post('/data-kegiatan-prakerin/soft-delete/{id}', [AdminController::class, 'kegiatanprakerinsoftdelete'])->name('admin.kegiatanprakerinsoftdelete');
    Route::post('/data-kegiatan-prakerin/restore/{id}', [AdminController::class, 'restorekegiatanprakerin'])->name('admin.restorekegiatanprakerin');
    Route::post('/data-kegiatan-prakerin/selected', [AdminController::class, 'handleSelectedkegiatanprakerin'])->name('admin.handleSelectedkegiatanprakerin');
    
    

});

Route::get('/logout', [LoginController::class, 'logout']);




// Route::get('/guru', [GuruController::class, 'index'])->name('guru.dashboard');
// Route::get('/siswa-bimbingan', [GuruController::class, 'siswabimbingan'])->name('guru.siswabimbingan');
