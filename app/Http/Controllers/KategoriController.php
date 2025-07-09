<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function index(Request $request){

        $search = $request->input('search');
        
        if ($search) {
            $kategori = Kategori::where('nama', 'like', '%' . $search . '%')->orderBy('nama')->paginate(10);
        } else {
            $kategori = Kategori::orderBy('nama')->paginate(10);
        }

        return view('kategori.index', compact('kategori'));
    }

    function store(Request $request)
    {
        Kategori::create($request->all());

        return redirect('kategori')->with('sukses', 'Data berhasil disimpan');
    }

    function edit($id)
    {
        $kategori = Kategori::find($id);

        return view('kategori.edit', compact('kategori'));
    }

    function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        $kategori->kode = $request->kode;
        $kategori->nama = $request->nama;
        $kategori->update();

        return redirect('kategori')->with('sukses', 'Data berhasil diupdate');
    }
    function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect('kategori')->with('sukses', 'Data berhasil dihapus');
    }
    
    function tambahbuku()
    {
    $kategori = Kategori::all();
    return view('buku.tambahbuku', compact('kategori'));
    }   

}
