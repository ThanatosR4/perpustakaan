<?php

namespace App\Http\Controllers;

use App\Models\PengaturanPeminjaman;
use Illuminate\Http\Request;

class PengaturanPeminjamanController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanPeminjaman::first(); // hanya 1 data
        return view('pengaturan.peminjaman.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'maksimal_hari' => 'required|integer|min:1',
            'maksimal_buku' => 'required|integer|min:1',
        ]);

        $pengaturan = PengaturanPeminjaman::first();
        $pengaturan->update([
            'maksimal_hari' => $request->maksimal_hari,
            'maksimal_buku' => $request->maksimal_buku,
        ]);

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
