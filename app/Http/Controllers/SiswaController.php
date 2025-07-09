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
    function index(Request $request)
    {
        $search = $request->input('search');
        
        if ($search) {
            $siswa = Siswa::where('nama', 'like', '%' . $search . '%')->orderBy('nama')->paginate(10);
        } else {
            $siswa = Siswa::orderBy('nama')->paginate(10);
        }

        return view('siswa.index', compact('siswa'));
    }

    function store(Request $request)
    {
        // Siswa::create($request->all());
        


        $foto = $request->foto;
        $slug = (".".$foto->getClientOriginalExtension());
        $new_foto = time() . $slug;

        $fotoPath = $foto->move('images/siswa/', $new_foto);

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

        if($request->hasFile('foto')){
            File::delete($siswa->foto);
            $foto = $request->foto;
            $slug = (".".$foto->getClientOriginalExtension());
            $new_foto = time() . $slug;
            $fotoPath = $foto->move('images/siswa/', $new_foto);
            $fotoPath = 'images/siswa/' .$new_foto;
            $siswa->foto = $fotoPath;

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
        File::delete($siswa->foto);
        $siswa->delete();

        return redirect('siswa')->with('sukses', 'Data berhasil dihapus');
    }
    


    public function register(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'kelas' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Membuat data siswa baru
        $siswa = Siswa::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password), // Hashing password untuk keamanan
        ]);

        return response()->json(['message' => 'Siswa berhasil didaftarkan', 'data' => $siswa], 201);
    }

}
