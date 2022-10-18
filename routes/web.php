<?php

use App\Http\Controllers\DaftarObatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\KartuRmController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RawatInapController;
use App\Http\Controllers\RawatJalanController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('login');
Route::post('/login', [DashboardController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/users/registrasi', [DashboardController::class, 'createAccount']);
    Route::post('/registrasi', [DashboardController::class, 'registrasi']);
    Route::get('/logout', [DashboardController::class, 'logout']);
    Route::get('/dashboard/user/{id}', [DashboardController::class, 'user']);
    Route::post('/dashboard/user/edit', [DashboardController::class, 'editUser']);

    // Users
    Route::get('/dashboard/users', [DashboardController::class, 'users']);
    Route::get('/dashboard/users/view-user/{id}', [DashboardController::class, 'viewUser']);
    Route::post('/dashboard/users/delete/{id}', [DashboardController::class, 'deleteUser']);

    // Profile
    // sp3
    Route::get('/profile/sp3', [ProfileController::class, 'index']);
    Route::post('/profile/sp3/upload', [ProfileController::class, 'upload']);
    Route::post('/profile/sp3/create-indikator', [ProfileController::class, 'createIndikator']);
    Route::get('/profile/view/file/{id}', [ProfileController::class, 'viewFile']);
    Route::get('/profile/view/indikator/{id}', [ProfileController::class, 'viewIndikator']);
    Route::post('/profile/delete/file/{id}', [ProfileController::class, 'deleteFile']);
    Route::post('/profile/delete/indikator/{id}', [ProfileController::class, 'deleteIndikator']);
    Route::get('/profile/download/file/{file}', [ProfileController::class, 'downloadFile']);
    Route::get('/profile/sp3/form-buat-indikator', [ProfileController::class, 'formIndikator']);
    Route::get('/profile/sp3/edit-indikator', [ProfileController::class, 'formEditIndikator']);
    Route::post('/profile/sp3/edit-indikator', [ProfileController::class, 'editIndikator']);
    Route::get('/profile/sp3/filter-indikator', [ProfileController::class, 'filterIndikator']);

    // Laporan Tahunan
    Route::get('/profile/laporan-tahunan', [ProfileController::class, 'laporan']);
    Route::get('/profile/laporan-tahunan/form-upload-laporan', [ProfileController::class, 'formUploadLaporan']);
    Route::post('/profile/laporan-tahunan/upload', [ProfileController::class, 'uploadLaporan']);

    // Obat
    Route::get('/searchCardRm', [MainController::class, 'search']);
    Route::get('/noSearchCardRm', [MainController::class, 'noSearch']);
    Route::get('/searchRegister', [PasienController::class, 'search']);
    Route::get('/noSearchRegister', [PasienController::class, 'noSearch']);
    Route::get('/searchNoRegister', [PasienController::class, 'searchNoRegister']);
    Route::get('/showRegisterPasien', [RegisterController::class, 'show']);
    Route::get('/editRegisterPasien', [RegisterController::class, 'create']);
    Route::get('/searchByDateCard', [KartuRmController::class, 'searchByDate']);
    Route::get('/searchByDatePasien', [PasienController::class, 'searchByDate']);
    Route::get('/descRegister', [RegisterController::class, 'descRegister']);
    Route::get('/search-name-pasien', [RegisterController::class, 'searchNamePasien']);

    // Print
    Route::post('/Kartu-RM/tambah-data', [KartuRmController::class, 'tambahData']);
    Route::get('/printCardRm/{id}', [MainController::class, 'printCardRm']);
    Route::get('/print/register-pasien/{kartuRm}', [KartuRmController::class, 'printRegister']);
    Route::get('/Kartu-RM/download', [KartuRmController::class, 'downloadKartuRM']);
    Route::get('/Pasien/download', [KartuRmController::class, 'downloadPasien']);

    // form
    Route::post('/Kartu-RM/search', [KartuRmController::class, 'formSearch']);
    Route::post('/Pasien/search', [PasienController::class, 'formSearch']);
    Route::post('/register/search', [RegisterController::class, 'formSearch']);
    Route::get('/pasien-data', [PasienController::class, 'dataPasien']);


    Route::resource('/Kartu-RM', KartuRmController::class);
    Route::resource('/Pasien', PasienController::class);
    Route::resource('/Register', RegisterController::class);
    Route::get('/register', [PasienController::class, 'register']);


    Route::post('/Kartu-RM/addFamily', [PasienController::class, 'addFamily']);

    // Rawat Jalan
    // Pendaftaran
    Route::get('/rawat-jalan/pendaftaran', [RawatJalanController::class, 'pendaftaran']);
    Route::post('/rawat-jalan/upload', [RawatJalanController::class, 'upload']);
    Route::get('/rawat-jalan/pendaftaran/form', [RawatJalanController::class, 'formPendaftaran']);

    Route::get('/rawat-jalan/poli-umum', [RawatJalanController::class, 'poliUmum']);
    Route::get('/rawat-jalan/poli-gigi', [RawatJalanController::class, 'poliGigi']);
    Route::get('/rawat-jalan/poli-kia', [RawatJalanController::class, 'poliKia']);
    Route::get('/rawat-jalan/poli-lansia', [RawatJalanController::class, 'poliLansia']);
    Route::get('/rawat-jalan/ruang-konseling', [RawatJalanController::class, 'ruangKonseling']);
    Route::get('/rawat-jalan/poli-tb', [RawatJalanController::class, 'poliTb']);
    Route::get('/rawat-jalan/poli-laboratorium', [RawatJalanController::class, 'poliLaboratorium']);

    // Parmasi
    Route::get('/rawat-jalan/parmasi', [RawatJalanController::class, 'parmasi']);
    Route::get('/rawat-jalan/parmasi/daftar-obat', [RawatJalanController::class, 'daftarObat']);
    Route::post('/rawat-jalan/parmasi/create', [RawatJalanController::class, 'createParmasi']);
    Route::get('/rawat-jalan/parmasi/create-obat', [RawatJalanController::class, 'createObat']);
    Route::post('/rawat-jalan/parmasi/create-obat', [RawatJalanController::class, 'storeObat']);
    Route::post('/rawat-jalan/parmasi/hapus-obat/{id}', [RawatJalanController::class, 'deleteObat']);
    Route::post('/rawat-jalan/delete-parmasi/{id}', [RawatJalanController::class, 'deleteParmasi']);
    Route::post('/rawat-jalan/parmasi/tambah-obat', [RawatJalanController::class, 'tambahObat']);
    Route::get('/rawat-jalan/parmasi/edit/{id}', [RawatJalanController::class, 'editParmasi']);
    Route::post('/rawat-jalan/parmasi/update/{id}', [RawatJalanController::class, 'updateParmasi']);
    Route::get('/rawat-jalan/parmasi/pengeluaran-obat/{type}', [RawatJalanController::class, 'pengeluaranObat']);
    Route::get('/rawat-jalan/parmasi/search-obat', [RawatJalanController::class, 'searchObatParmasi']);
    Route::get('/rawat-jalan/parmasi/edit-obat', [RawatJalanController::class, 'editObat']);
    Route::post('/rawat-jalan/parmasi/edit-obat', [RawatJalanController::class, 'updateObat']);
    Route::get('/rawat-jalan/parmasi/filter', [RawatJalanController::class, 'filterParmasi']);
    Route::get('/rawat-jalan/parmasi/filter-obat', [RawatJalanController::class, 'filterObat']);
    Route::get('/rawat-jalan/parmasi/filter-obat-parmasi', [RawatJalanController::class, 'filterObatParmasi']);
    Route::get('/searchObat', [RawatJalanController::class, 'searchObat']);
    Route::post('/rawat-jalan/parmasi/tambah-daftar-obat', [DaftarObatController::class, 'store']);

    Route::get('/rawat-jalan/poli-umum/form', [RawatJalanController::class, 'formPoliUmum']);
    Route::get('/rawat-jalan/view/{id}', [RawatJalanController::class, 'view']);
    Route::post('/rawat-jalan/delete/{id}', [RawatJalanController::class, 'delete']);
    Route::get('/rawat-jalan/download/{file}', [RawatJalanController::class, 'download']);

    // Print
    Route::get('/rawat-jalan/parmasi/print/pengeluran-obat', [RawatJalanController::class, 'printPengeluaranObat']);
    Route::get('/rawat-jalan/parmasi/print/filter-pengeluaran-obat', [RawatJalanController::class, 'printFilterPengeluaranObat']);
    Route::get('/rawat-jalan/parmasi/print/pengeluran-total-obat', [RawatJalanController::class, 'printTotalPengeluaranObat']);

    // Rawat Inap

    // Perawatan
    Route::get('/rawat-inap/perawatan', [RawatInapController::class, 'perawatan']);
    // Poned
    Route::get('/rawat-inap/poned', [RawatInapController::class, 'poned']);
    // UGD
    Route::get('/rawat-inap/ugd', [RawatInapController::class, 'ugd']);

    Route::get('/rawat-inap/perawatan/form', [RawatInapController::class, 'formUpload']);
    Route::post('/rawat-inap/upload', [RawatInapController::class, 'upload']);
    Route::get('/rawat-inap/view/{id}', [RawatInapController::class, 'viewFile']);
    Route::post('/rawat-inap/delete/{id}', [RawatInapController::class, 'deleteFile']);
    Route::get('/rawat-inap/download/{file}', [RawatInapController::class, 'downloadFile']);
});
