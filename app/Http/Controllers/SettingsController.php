<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|max:1024', 
            'new_password' => 'nullable|min:6|same:confirm_password',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;

        
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/images/user', $filename);
            $user->foto = 'images/user/' . $filename;
        }

        
        if ($request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama salah.']);
            }

            if ($request->new_password) {
                $user->password = Hash::make($request->new_password);
            }
        }

        $user->save();

        return redirect()->route('settings.edit')->with('success', 'Pengaturan akun berhasil diperbarui.');
    }
}
