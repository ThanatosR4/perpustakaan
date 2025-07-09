<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::with('buku')->get();

        return response()->json([
            'kategori' => $kategori
        ]);
    }

    public function showByKode($kode)
    {
        $kategori = Kategori::where('kode', $kode)->with('buku')->first();

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json([
            'kategori' => $kategori
        ]);
    }
}
