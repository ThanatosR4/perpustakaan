<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Kategori;

class BukuController extends Controller
{
   function index(Request $request)
{
    $kategori_id = $request->kategori_id;
    $keyword = $request->keyword;

    // Query dasar: ambil relasi kategori juga
    $query = Buku::with('kategori');

    // Jika filter kategori dipilih
    if ($kategori_id) {
        $query->where('kategori_id', $kategori_id);
    }

    // Jika ada pencarian keyword
    if ($keyword) {
        $query->where('judul', 'like', '%' . $keyword . '%');
    }

    // Ambil hasil query
    $buku = $query->get();

    // Ambil semua kategori untuk filter
    $kategori = Kategori::all();

    return view('buku.index', compact('buku', 'kategori'));
}

    function tambahbuku()
    {
    $kategori = Kategori::all(); // Ambil semua kategori dari tabel
    return view('buku.tambahbuku', compact('kategori')); // Kirim ke view
    }

    function store(Request $request)
    {
        // Buku::create($request->all());

        $gambar = $request->gambar;
        $slug = (".".$gambar->getClientOriginalExtension());
        $new_gambar = time() . $slug;

        $gambarPath = $gambar->move('images/buku/',$new_gambar);

        Buku::create([

            'kode' => $request->kode,
            'judul' => $request->judul,
            'isbn' => $request->isbn,
            'pengarang' => $request->pengarang,
            'penerbit_id' => $request->penerbit_id,
            'jumlah_halaman' => $request->jumlah_halaman,
            'stok' => $request->stok,
            'tahun_terbit' => $request->tahun_terbit,
            'sinopsis' => $request->sinopsis,
            'kategori_id' => $request->kategori_id,
            'gambar'=> $gambarPath,

        ]);

        return redirect('buku')->with('sukses', 'Buku berhasil ditambah');
    }

    function detail($id)
{
    $buku = Buku::with(['kategori'])->find($id);
    return view('buku.detail', compact('buku'));
}


    public function destroy($id)
{
    $buku = Buku::find($id);
    File::delete($buku->gambar);
    $buku->delete();

    return redirect('buku')->with('sukses', 'Buku berhasil dihapus');

}
}