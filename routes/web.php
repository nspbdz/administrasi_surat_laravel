<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalSuratController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratPemberitahuanController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\SuratDispensasiController;
use App\Http\Controllers\SuratUndanganController;
use App\Http\Controllers\DokumenBlankoController;
use App\Http\Controllers\DokumenSuratController;
use App\Http\Controllers\DokumenSertifikatController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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


// Route::get('/home', function () {
//     return view('home');
// });

Auth::routes();
// Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


    
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    // Route::get('/', function () {
    //     return view('home');
    // });


    Route::resource('jadwal', ProductController::class);

    //Dashboard
    Route::get('getDashboard', [DashboardController::class, 'getDashboard'])->name('getDashboard');
    Route::group(['middleware' => ['permission:dashboard']], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    });

    //Jadwal Surat
    Route::resource('/jadwalSurat', JadwalSuratController::class);
    Route::get('getJadwalSurat', [JadwalSuratController::class, 'getJadwalSurat'])->name('getJadwalSurat');

    //Dokumen
    Route::resource('/dokumen', DokumenController::class);
    Route::get('getDokumen', [DokumenController::class, 'getDokumen'])->name('getDokumen');

    //Instansi
    Route::resource('/instansi', InstansiController::class);
    Route::get('getInstansi', [InstansiController::class, 'getInstansi'])->name('getInstansi');

    //Surat Masuk
    Route::resource('/suratMasuk', SuratMasukController::class);
    Route::get('status/{id}', [SuratMasukController::class, 'status'])->name('status');
    Route::get('getSuratMasuk', [SuratMasukController::class, 'getSuratMasuk'])->name('getSuratMasuk');
    Route::get('registrationNumberSuratMasuk', [SuratMasukController::class, 'registrationNumberSuratMasuk'])->name('registrationNumberSuratMasuk');
    Route::get('statusundo/{id}', [SuratMasukController::class, 'statusUndo'])->name('statusUndo');

    Route::prefix('auth')->group(function () {

        Route::resource('/roles', RoleController::class);
        Route::resource('/users', UserController::class);
        Route::get('getUser', [UserController::class, 'getUser'])->name('getUser');
    });
    //Surat Pemberitahuan
    Route::prefix('suratkeluar')->group(function () {
        Route::resource('/suratPemberitahuan', SuratPemberitahuanController::class);
        Route::get('getSuratPemberitahuan', [SuratPemberitahuanController::class, 'getSuratPemberitahuan'])->name('getSuratPemberitahuan');
        Route::get('generatePDFPemberitahuan/{id}', [SuratPemberitahuanController::class, 'generatePDFPemberitahuan'])->name('generatePDFPemberitahuan');
        Route::get('generateLetterNumberPemberitahuan', [SuratPemberitahuanController::class, 'generateLetterNumberPemberitahuan'])->name('generateLetterNumberPemberitahuan');

        //Surat Tugas
        Route::resource('/suratTugas', SuratTugasController::class);
        Route::get('getSuratTugas', [SuratTugasController::class, 'getSuratTugas'])->name('getSuratTugas');
        Route::get('generatePDFTugas/{id}', [SuratTugasController::class, 'generatePDFTugas'])->name('generatePDFTugas');
        Route::get('generateLetterNumberTugas', [SuratTugasController::class, 'generateLetterNumberTugas'])->name('generateLetterNumberTugas');

        //Surat Dispensasi
        Route::resource('/suratDispensasi', SuratDispensasiController::class);
        Route::get('getSuratDispensasi', [SuratDispensasiController::class, 'getSuratDispensasi'])->name('getSuratDispensasi');
        Route::get('generatePDFDispensasi/{id}', [SuratDispensasiController::class, 'generatePDFDispensasi'])->name('generatePDFDispensasi');
        Route::get('generateLetterNumberDispensasi', [SuratDispensasiController::class, 'generateLetterNumberDispensasi'])->name('generateLetterNumberDispensasi');

        //Surat Undangan
        Route::resource('/suratUndangan', SuratUndanganController::class);
        Route::get('getSuratUndangan', [SuratUndanganController::class, 'getSuratUndangan'])->name('getSuratUndangan');
        Route::get('generatePDFUndangan/{id}', [SuratUndanganController::class, 'generatePDFUndangan'])->name('generatePDFUndangan');
        Route::get('generateLetterNumberUndangan', [SuratUndanganController::class, 'generateLetterNumberUndangan'])->name('generateLetterNumberUndangan');
    });

    Route::prefix('dokumenData')->group(function () {
        Route::resource('/dokumenBlanko', DokumenBlankoController::class);
        Route::get('getDokumenBlanko', [DokumenBlankoController::class, 'getDokumenBlanko'])->name('getDokumenBlanko');

        //Dokumen Surat
        Route::resource('/dokumenSurat', DokumenSuratController::class);
        Route::get('getDokumenSurat', [DokumenSuratController::class, 'getDokumenSurat'])->name('getDokumenSurat');

        //Dokumen Sertifikat
        Route::resource('/dokumenSertifikat', DokumenSertifikatController::class);
        Route::get('getDokumenSertifikat', [DokumenSertifikatController::class, 'getDokumenSertifikat'])->name('getDokumenSertifikat');
    });
});
