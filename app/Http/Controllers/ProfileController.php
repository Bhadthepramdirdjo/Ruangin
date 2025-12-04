<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'min:8', 'confirmed'], // confirmed artinya butuh field password_confirmation
        ]);

        // Update Data Diri
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Update Password (hanya jika diisi)
        if ($request->hasFile('avatar')) {
        // 1. Hapus foto lama jika ada (dan bukan foto default)
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // 2. Simpan foto baru ke folder 'avatars' di public disk
        $path = $request->file('avatar')->store('avatars', 'public');
        
        // 3. Simpan path-nya ke database
        $user->avatar = $path;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
        }
}