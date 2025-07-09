<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;

class BukuController extends Controller
{
   public function index()
{
    $buku = Buku::with('kategori')->get();

    return response()->json([
        'status' => true,
        'message' => 'Data buku berhasil diambil',
        'data' => $buku
    ]);
}

 
}
