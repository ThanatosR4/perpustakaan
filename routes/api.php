<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiswaAuthController;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\API\PeminjamanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/siswa/register', [SiswaAuthController::class, 'register']);
Route::post('/siswa/login', [SiswaAuthController::class, 'login']);

Route::get('/buku', [BukuController::class, 'index']);

Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{kode}', [KategoriController::class, 'showByKode']);

// Route::middleware('auth:sanctum')->get('/siswa/profile', function (Request $request) {
//     return $request->user(); 
// });


Route::middleware('auth:sanctum')->get('/siswa/profile', [SiswaAuthController::class, 'getProfile']);
Route::middleware('auth:sanctum')->post('/siswa/update', [SiswaAuthController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->post('/siswa/ubah-password', [SiswaAuthController::class, 'ubahPassword']);


Route::middleware('auth:sanctum')->post('/siswa/peminjaman', [PeminjamanController::class, 'store']);
Route::middleware('auth:sanctum')->get('/siswa/peminjaman', [PeminjamanController::class, 'index']);