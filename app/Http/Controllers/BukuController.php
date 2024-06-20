<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    function tambahbuku()
    {
        return view('buku.tambahbuku');
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
        $buku = Buku::find($id);

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