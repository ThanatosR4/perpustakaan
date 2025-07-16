<?php

namespace App\Http\Controllers;

use App\Models\PengaturanDenda;
use Illuminate\Http\Request;

class PengaturanDendaController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanDenda::first();
        return view('pengaturan.denda.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'denda_per_hari' => 'required|integer|min:0',
        ]);

        $pengaturan = PengaturanDenda::first();
        if (!$pengaturan) {
            PengaturanDenda::create(['denda_per_hari' => $request->denda_per_hari]);
        } else {
            $pengaturan->update(['denda_per_hari' => $request->denda_per_hari]);
        }

        return redirect()->back()->with('success', 'Pengaturan denda berhasil diperbarui.');
    }
}
