<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;


class BukuController extends Controller
{
   public function index(Request $request)
    {
    $kategori_id = $request->kategori_id;
    $keyword = $request->keyword;

    
    $query = Buku::with('kategori');

    
    if ($kategori_id) {
        $query->where('kategori_id', $kategori_id);
    }

    
    if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->where('judul', 'like', '%' . $keyword . '%')
              ->orWhere('pengarang', 'like', '%' . $keyword . '%')
              ->orWhere('penerbit_id', 'like', '%' . $keyword . '%');
        });
    }

    
    $buku = $query->get();

    
    $kategori = Kategori::all();

    $totalBuku = $buku->count();

    
    $kategoriBersertaBuku = $kategori->map(function($kat) use ($buku) {
        $kat->buku = $buku->where('kategori_id', $kat->id)->values();
        return $kat;
    })->filter(function($kat) {
        return $kat->buku->isNotEmpty();
    });
    $kategoriInduk = Kategori::whereNull('parent_id')->with(['children.buku'])->get();

    return view('buku.index', compact('kategori', 'totalBuku', 'kategoriBersertaBuku'));
    }


    function tambahbuku()
    {
    $kategori = Kategori::all(); 
    return view('buku.tambahbuku', compact('kategori')); 
    }

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'kode' => 'required|string|max:50',
        'judul' => 'required|string|max:255',
        'isbn' => 'required|string',
        'pengarang' => 'required|string',
        'penerbit_id' => 'required|exists:penerbits,id',
        'jumlah_halaman' => 'required|numeric',
        'stok' => 'required|numeric',
        'tahun_terbit' => 'required|string|max:4',
        'sinopsis' => 'nullable|string',
        'kategori_id' => 'required|exists:kategoris,id',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    
    $gambar = $request->file('gambar');
    $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();

    $manager = new ImageManager(new GdDriver());
    $image = $manager->read($gambar);
    $image->resize(600, 800, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    $image->save(storage_path('app/public/images/buku/' . $namaGambar));

    
    $gambarPath = 'images/buku/' . $namaGambar;

    
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
        'gambar' => $gambarPath,
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

    
    if ($buku->gambar && Storage::exists('public/' . $buku->gambar)) {
    Storage::delete('public/' . $buku->gambar);
    }

    $buku->delete();

    return redirect('buku')->with('sukses', 'Buku berhasil dihapus');
    }

    public function edit($id)
{
    $buku = Buku::findOrFail($id);
    $kategori = Kategori::all(); 

    return view('buku.edit', compact('buku', 'kategori'));
}


public function update(Request $request, $id)
    {
    // Validasi data
    $request->validate([
        'judul' => 'required|string|max:255',
        'isbn' => 'required|string',
        'pengarang' => 'required|string',
        'jumlah_halaman' => 'required|numeric',
        'stok' => 'required|numeric',
        'tahun_terbit' => 'required|string|max:4',
        'sinopsis' => 'nullable|string',
        'kategori_id' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $buku = Buku::findOrFail($id);


    if ($request->hasFile('gambar')) {
        
        if ($buku->gambar && Storage::exists('public/' . $buku->gambar)) {
            Storage::delete('public/' . $buku->gambar);
        }

        
        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();

        $manager = new ImageManager(new GdDriver());
        $image = $manager->read($gambar);
        $image->resize(600, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->save(storage_path('app/public/images/buku/' . $namaGambar));

        
        $buku->gambar = 'images/buku/' . $namaGambar;
    }

    
    $buku->judul = $request->judul;
    $buku->isbn = $request->isbn;
    $buku->pengarang = $request->pengarang;
    $buku->jumlah_halaman = $request->jumlah_halaman;
    $buku->stok = $request->stok;
    $buku->tahun_terbit = $request->tahun_terbit;
    $buku->sinopsis = $request->sinopsis;
    $buku->kategori_id = $request->kategori_id;

    $buku->save();

    return redirect()->route('buku.index')->with('sukses', 'Data buku berhasil diperbarui.');
    }


}