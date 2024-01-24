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

Route::middleware(['guest'])->group(function(){
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('/informasi-prakerin', [WelcomeController::class, 'informasiprak'])->name('informasiprak');
    Route::get('/informasi-prakerin/detail/{id}', [WelcomeController::class, 'detailinfo'])->name('detailinfo');
    // Route::get('/detail', [WelcomeController::class, 'detailinfo'])->name('detailinfo');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth', 'useraccess:siswa', 'preventBackButton', 'disableCaching' ])->group(function(){
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/permohonan-prakerin', [SiswaController::class, 'permohonan'])->name('siswa.permohonan');
    Route::post('/permohonan-prakerin', [SiswaController::class, 'submitPermohonan'])->name('submit.permohonan');
    Route::post('/permohonan-balasan', [SiswaController::class, 'balasanPermohonan'])->name('balasan.permohonan');
    Route::get('/pengisian-jurnal', [SiswaController::class, 'jurnal'])->name('siswa.jurnal');
    Route::post('/pengisian-jurnal', [SiswaController::class, 'submitJurnal'])->name('submit.jurnal');
    Route::get('/data-jurnal', [SiswaController::class, 'jurnaldata'])->name('siswa.jurnaldata');
    Route::get('/pengumpulan-laporan', [SiswaController::class, 'laporan'])->name('siswa.laporan');
    Route::get('/edit-profil', [SiswaController::class, 'pengaturan'])->name('siswa.pengaturan');
    Route::post('/edit-profil', [SiswaController::class, 'update'])->name('edit.profile');
    Route::get('/edit-password', [SiswaController::class, 'showchangepassword'])->name('show.changepassword');
    Route::post('/edit-password', [SiswaController::class, 'changepassword'])->name('change.password');

});

Route::middleware(['auth', 'useraccess:guru', 'preventBackButton', 'disableCaching' ])->group(function(){
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/siswa-bimbingan', [GuruController::class, 'siswabimbingan'])->name('guru.siswabimbingan');
    Route::get('/nilai-laporan', [GuruController::class, 'nilailaporan'])->name('guru.nilailaporan');
});

Route::middleware(['auth', 'useraccess:admin', 'preventBackButton', 'disableCaching' ])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/permohonan', [AdminController::class, 'permohonan'])->name('admin.permohonan');
    Route::post('/status-permohonan/{id}', [AdminController::class, 'statuspermohonan'])->name('status.permohonan');
    Route::post('/hapus-permohonan/{id}', [AdminController::class, 'hapuspermohonan'])->name('hapus.permohonan');

    Route::get('/data-siswa', [AdminController::class, 'datasiswa'])->name('admin.datasiswa');
    Route::post('/data-siswa', [AdminController::class, 'tambahdatasiswa'])->name('admin.tambahdatasiswa');
    Route::post('/data-siswa/file', [AdminController::class, 'tambahfiledatasiswa'])->name('admin.tambahfiledatasiswa');
    Route::get('/data-siswa/edit/{id}', [AdminController::class, 'datasiswaeditview'])->name('admin.datasiswaeditview');
    Route::post('/data-siswa/edit/{id}', [AdminController::class, 'datasiswaedit'])->name('admin.datasiswaedit');
    Route::delete('/data-siswa/delete/{id}', [AdminController::class, 'datasiswadelete'])->name('admin.datasiswadelete');
    Route::post('/data-siswa/softdeleteSelectedSiswa', [AdminController::class, 'softdeleteSelectedSiswa'])->name('admin.softdeleteSelectedSiswa');
    Route::get('/data-siswa/trash-siswa', [AdminController::class, 'trashsiswaview'])->name('admin.trashsiswaview');
    Route::post('/data-siswa/soft-delete/{id}', [AdminController::class, 'datasiswasoftdelete'])->name('admin.datasiswasoftdelete');
    Route::post('/data-siswa/restore/{id}', [AdminController::class, 'restoresiswa'])->name('admin.restoresiswa');
    Route::post('/data-siswa/handleselectedsiswa', [AdminController::class, 'handleSelectedSiswa'])->name('admin.handleselectedsiswa');

    Route::get('/data-guru', [AdminController::class, 'dataguru'])->name('admin.dataguru');
    Route::post('/data-guru', [AdminController::class, 'tambahdataguru'])->name('admin.tambahdataguru');
    Route::post('/data-guru/file', [AdminController::class, 'tambahfiledataguru'])->name('admin.tambahfiledataguru');
    Route::get('/data-guru/edit/{id}', [AdminController::class, 'datagurueditview'])->name('admin.datagurueditview');
    Route::post('/data-guru/edit/{id}', [AdminController::class, 'dataguruedit'])->name('admin.dataguruedit');
    Route::delete('/data-guru/delete/{id}', [AdminController::class, 'datagurudelete'])->name('admin.datagurudelete');
    Route::post('/data-siswa/softdeleteSelectedGuru', [AdminController::class, 'softdeleteSelectedGuru'])->name('admin.softdeleteSelectedGuru');
    Route::get('/data-guru/trash-guru', [AdminController::class, 'trashguruview'])->name('admin.trashguruview');
    Route::post('/data-guru/soft-delete/{id}', [AdminController::class, 'datagurusoftdelete'])->name('admin.datagurusoftdelete');
    Route::post('/data-guru/restore/{id}', [AdminController::class, 'restoreguru'])->name('admin.restoreguru');
    Route::post('/data-guru/handleselectedguru', [AdminController::class, 'handleSelectedGuru'])->name('admin.handleselectedguru');
    
    Route::get('/data-pembagian-bimbingan', [AdminController::class, 'datapembagianbimbingan'])->name('admin.datapembagianbimbingan');
    Route::post('/data-pembagian-bimbingan/tambah', [AdminController::class, 'tambahdatapembagianbimbingan'])->name('admin.tambahdatapembagianbimbingan');
    Route::get('/data-pembagian-bimbingan/edit/{id}', [AdminController::class, 'datapembagianbimbinganeditview'])->name('admin.datapembagianbimbinganeditview');
    Route::post('/data-pembagian-bimbingan/edit/{id}', [AdminController::class, 'datapembagianbimbinganedit'])->name('admin.datapembagianbimbinganedit');
    Route::post('/data-pembagian-bimbingan/delete/{id}', [AdminController::class, 'datapembagianbimbingandelete'])->name('admin.datapembagianbimbingandelete');

    Route::get('/data-tempat-prakerin', [AdminController::class, 'datatempatprakerin'])->name('admin.datatempatprakerin');
    
    Route::get('/data-informasi-prakerin', [AdminController::class, 'informasiprakerin'])->name('admin.informasiprakerin');
    Route::post('/data-informasi-prakerin', [AdminController::class, 'tambahinformasiprakerin'])->name('admin.tambahinformasiprakerin');
    Route::get('/data-informasi-prakerin/edit/{id}', [AdminController::class, 'editinfoprakview'])->name('admin.editinfoprakview');
    Route::post('/data-informasi-prakerin/edit/{id}', [AdminController::class, 'editinfoprak'])->name('admin.editinfoprak');
    Route::post('/data-informasi-prakerin/soft-delete/{id}', [AdminController::class, 'infopraksoftdelete'])->name('admin.infopraksoftdelete');
    Route::post('/data-informasi-prakerin/softdeleteselected', [AdminController::class, 'softdeleteselectedinfoprak'])->name('admin.softdeleteselectedinfoprak');
    Route::get('/data-informasi-prakerin/trash-informasi-prakerin', [AdminController::class, 'trashinfoprakview'])->name('admin.trashinfoprakview');
    Route::post('/data-informasi-prakerin/restore/{id}', [AdminController::class, 'restoreinfoprak'])->name('admin.restoreinfoprak');
    Route::delete('/data-informasi-prakerin/delete/{id}', [AdminController::class, 'infoprakdelete'])->name('admin.infoprakdelete');
    Route::post('/data-informasi-prakerin/handleselectedinformasiprakerin', [AdminController::class, 'handleSelectedInfoprak'])->name('admin.handleSelectedInfoprak');

});

Route::get('/logout', [LoginController::class, 'logout']);




// Route::get('/guru', [GuruController::class, 'index'])->name('guru.dashboard');
// Route::get('/siswa-bimbingan', [GuruController::class, 'siswabimbingan'])->name('guru.siswabimbingan');

