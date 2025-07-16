<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use Carbon\Carbon;
use App\Models\PengaturanPeminjaman;
use App\Models\PengaturanDenda;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
        'tanggal_pinjam' => 'required|date',
        'lama_pinjam' => 'required|integer',
        'buku_id' => 'required|exists:buku,id',
    ]);

    $siswa = Auth::guard('sanctum')->user();


    $pengaturan = PengaturanPeminjaman::first();

    // Cek batas jumlah buku
    $totalDipinjam = Peminjaman::where('siswa_id', $siswa->id)
        ->where('status', 'dipinjam')
        ->count();

    if ($pengaturan && $totalDipinjam >= $pengaturan->maksimal_buku) {
        return response()->json([
            'status' => false,
            'message' => 'Anda telah mencapai batas maksimal peminjaman buku.',
        ], 400);
    }

    // Cek batas hari pinjam
    if ($pengaturan && $request->lama_pinjam > $pengaturan->maksimal_hari) {
        return response()->json([
            'status' => false,
            'message' => 'Lama peminjaman melebihi batas maksimal yang diizinkan.',
        ], 400);
    }


    $existing = Peminjaman::where('siswa_id', $siswa->id)
        ->where('buku_id', $request->buku_id)
        ->where('status', 'dipinjam')
        ->first();

    if ($existing) {
        return response()->json([
            'status' => false,
            'message' => 'Anda sudah meminjam buku ini dan belum mengembalikannya.',
        ], 400);
    }

    $buku = Buku::find($request->buku_id);
    if ($buku->stok <= 0) {
        return response()->json([
            'status' => false,
            'message' => 'Stok buku habis, tidak bisa dipinjam.',
        ], 400);
    }

    $buku->stok -= 1;
    $buku->save();

    
    $tanggal_kembali = Carbon::parse($request->tanggal_pinjam)->addDays($request->lama_pinjam);

    $peminjaman = Peminjaman::create([
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'lama_pinjam' => $request->lama_pinjam,
        'tanggal_kembali' => $tanggal_kembali, 
        'status' => 'dipinjam',
        'siswa_id' => $siswa->id,
        'nama' => $siswa->nama,
        'buku_id' => $request->buku_id,
        'keterangan' => $request->keterangan ?? '',
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Buku berhasil dipinjam.',
        'data' => $peminjaman,
    ]);
    }


    public function index()
    {
    $siswa = Auth::guard('sanctum')->user();

    $peminjaman = Peminjaman::with('buku')
        ->where('siswa_id', $siswa->id)
        ->orderBy('tanggal_pinjam', 'desc')
        ->get();

    $denda = PengaturanDenda::first();

    return response()->json([
        'status' => true,
        'denda_per_hari' => $denda?->denda_per_hari ?? 0,
        'data' => $peminjaman,
    ]);
    }
}
