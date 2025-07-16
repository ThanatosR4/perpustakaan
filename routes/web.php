<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SiswaController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\PengaturanPeminjamanController;
use App\Http\Controllers\PengaturanDendaController;
use App\Http\Controllers\AktivitasController;


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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin',[AuthController::class, 'postlogin']);
Route::get('/logout',[AuthController::class, 'logout']);






Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [DashboardController::class, 'show'])->name('profile.show');

    Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas.index');



    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');
    // Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    // Route::get('/settings/{id}/akun', [SettingsController::class, 'akun'])->name('settings.akun');
    // Route::post('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');


    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/kategori/{id}', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}', [KategoriController::class, 'destroy']);
    Route::resource('kategori', KategoriController::class);
    
    // Route::get('/kategori/search', [KategoriController::class, 'search']);


    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa/store', [SiswaController::class, 'store']);
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit']);
    Route::put('/siswa/{id}', [SiswaController::class, 'update']);
    Route::get('/siswa/{id}',[SiswaController::class, 'destroy']);
    Route::resource('siswa', SiswaController::class);
    Route::post('/siswa/reset-password/{id}', [SiswaController::class, 'resetPassword'])->name('siswa.resetPassword');

    

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/tambahbuku', [BukuController::class, 'tambahbuku']);
    Route::post('/buku',[BukuController::class, 'store']);
    Route::get('/buku/{id}/detail', [BukuController::class, 'detail']);
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');



    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');



    
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::post('/pengembalian/{id}', [PengembalianController::class, 'kembalikan'])->name('pengembalian.kembalikan');
    Route::get('/pengembalian/print', [PengembalianController::class, 'print'])->name('pengembalian.print');


    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::post('/cetak', [LaporanController::class, 'cetak'])->name('cetak'); // Untuk export/cetak ke PDF
        Route::post('/cetak/preview', [LaporanController::class, 'preview'])->name('cetak.preview'); // Untuk AJAX preview
    });
    Route::post('/laporan/cetak/pdf', [LaporanController::class, 'cetakPdf'])->name('laporan.cetak.pdf');




    Route::prefix('pengaturan')->group(function () {
        Route::get('/peminjaman', [PengaturanPeminjamanController::class, 'index'])->name('pengaturan.peminjaman.index');
        Route::post('/peminjaman', [PengaturanPeminjamanController::class, 'update'])->name('pengaturan.peminjaman.update');
    });


    Route::prefix('pengaturan/denda')->name('pengaturan.denda.')->group(function () {
        Route::get('/', [PengaturanDendaController::class, 'index'])->name('index');
        Route::post('/update', [PengaturanDendaController::class, 'update'])->name('update');
    });





});