<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    function index()
    {
        return view('settings.index');
    }

    function akun($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // User tidak ditemukan
        }

        return view('settings.akun', compact('user'));
    }

    function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // User tidak ditemukan
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'foto' => 'nullable|image|max:1024',
            'description' => 'nullable|string|max:1000', 
        ]);

        if($request->hasFile('foto')){
            // Menghapus foto lama jika ada
            if($user->foto){
                File::delete($user->foto);
            }
    
            // Mengunggah dan menyimpan foto baru
            $foto = $request->file('foto');
            $slug = '.' . $foto->getClientOriginalExtension();
            $new_foto = time() . $slug;
            $fotoPath = $foto->move('images/user/', $new_foto);
            $user->foto = 'images/user/' . $new_foto;
        }
        
        

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;

        // Jika password diisi, cek old password dan update password
        if ($request->filled('old_password') && $request->filled('new_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return back()->withErrors(['old_password' => 'Old password does not match']);
            }
        }

        $user->save();

        return redirect()->route('settings.akun', $user->id)->with('success', 'Pengaturan berhasil diperbarui');
    }

}
