<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class SiswaAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:siswa,kode',
            'nama' => 'required',
            'email' => 'required|email|unique:siswa,email',
            'password' => 'required|min:6',
        ]);

        $siswa = Siswa::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $siswa->createToken('siswa-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'siswa' => $siswa
        ], 201);
    }

    public function login(Request $request)
    {
        $siswa = Siswa::where('email', $request->email)->first();

        if (!$siswa || !Hash::check($request->password, $siswa->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        $token = $siswa->createToken('siswa-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'siswa' => $siswa
        ]);
    }
    public function updateProfile(Request $request)
    {
    $user = auth()->user(); // siswa yang sedang login

    $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:siswa,email,' . $user->id,
        'jenis_kelamin' => 'nullable',
        'tempat_lahir' => 'nullable',
        'tanggal_lahir' => 'nullable|date',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->except('foto'); // ambil semua data kecuali foto

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fotoPath = $foto->store('images/siswa', 'public');
        $data['foto'] = $fotoPath;
    }

    $user->update($data); // langsung update dengan data yang sudah diolah

    return response()->json([
        'message' => 'Profil berhasil diperbarui',
        'siswa' => $user
    ]);
    }
    public function getProfile()
    {
    $user = auth()->user();

    return response()->json([
        'status' => true,
        'siswa' => $user,
    ]);
    }



}