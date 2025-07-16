<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    $kelas = $request->input('kelas');

    $query = Siswa::query();

    if ($kelas) {
        $query->where('kelas', $kelas);
    }

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%');
        });
    }

     $query->orderByRaw("FIELD(kelas, 'XII', 'XI', 'X')")
          ->orderBy('nama', 'asc');

    $siswa = $query->orderBy('nama')->paginate(10)->withQueryString();

    return view('siswa.index', compact('siswa'));
    }

    function store(Request $request)
    {
    
        $request->validate([
        'kode' => 'required|unique:siswa,kode',
        'nama' => 'required|string',
        'password' => 'required|confirmed|min:6',
        'kelas' => 'required',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'telepon' => 'required|numeric',
        'email' => 'required|email',
        'alamat' => 'required|string',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
        'kode.required' => 'NISN wajib diisi.',
        'kode.unique' => 'NISN sudah terdaftar.',]
    );

        $foto = $request->foto;
        $slug = (".".$foto->getClientOriginalExtension());
        $new_foto = time() . $slug;

        $foto->storeAs('public/images/siswa', $new_foto);
        $fotoPath = 'images/siswa/' . $new_foto; 

        

        $password = Hash::make($request->password);

        Siswa::create([

            'kode' => $request->kode,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'password' =>$password,
            'foto'=> $fotoPath,

        ]);

        return redirect('siswa')->with('sukses', 'Data berhasil disimpan');
    }

    function edit($id)
    {
        $siswa = Siswa::find($id);

        return view('siswa.edit', compact('siswa'));
    }

    function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        if ($request->hasFile('foto')) {
            File::delete('storage/' . $siswa->foto); 
            $foto = $request->foto;
            $slug = "." . $foto->getClientOriginalExtension();
            $new_foto = time() . $slug;
            $foto->storeAs('public/images/siswa', $new_foto);
            $siswa->foto = 'images/siswa/' . $new_foto;
            }
        

        $siswa->kode = $request->kode;
        $siswa->nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->telepon = $request->telepon;
        $siswa->email = $request->email;
        $siswa->alamat = $request->alamat;
    
        $siswa->update();

        return redirect('siswa')->with('sukses', 'Data berhasil diupdate');
    }

    function destroy($id)
    {
        $siswa = Siswa::find($id);
        File::delete('storage/' . $siswa->foto); 
        $siswa->delete();

        return redirect('siswa')->with('sukses', 'Data berhasil dihapus');
    }
    


    // public function register(Request $request)
    // {
        
    //     $validator = Validator::make($request->all(), [
    //         'kode' => 'required',
    //         'nama' => 'required',
    //         'email' => 'required|email',
    //         'kelas' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors());
    //     }

    //     $siswa = Siswa::create([
    //         'kode' => $request->kode,
    //         'nama' => $request->nama,
    //         'kelas' => $request->kelas,
    //         'jenis_kelamin' => $request->jenis_kelamin,
    //         'tempat_lahir' => $request->tempat_lahir,
    //         'tanggal_lahir' => $request->tanggal_lahir,
    //         'telepon' => $request->telepon,
    //         'email' => $request->email,
    //         'alamat' => $request->alamat,
    //         'password' => Hash::make($request->password), 
    //     ]);

    //     return response()->json(['message' => 'Siswa berhasil didaftarkan', 'data' => $siswa], 201);
    // }

    public function resetPassword($id)
    {
    $siswa = Siswa::findOrFail($id);

    $defaultPassword = 'password123'; // Password baru yang direset
    $siswa->password = Hash::make($defaultPassword);
    $siswa->save();

    return redirect()->back()->with('sukses', "Password berhasil direset menjadi: $defaultPassword");
    }

}
