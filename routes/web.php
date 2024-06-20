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
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profil', [DashboardController::class, 'show'])->name('profile.show');



    
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/{id}/akun', [SettingsController::class, 'akun'])->name('settings.akun');
    Route::post('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');


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
    

    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/tambahbuku', [BukuController::class, 'tambahbuku']);
    Route::post('/buku',[BukuController::class, 'store']);
    Route::get('/buku/{id}/detail', [BukuController::class, 'detail']);
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');


    Route::get('/peminjaman',[PeminjamanController::class, 'index']);



    Route::get('/pengembalian', [PengembalianController::class, 'index']);


});