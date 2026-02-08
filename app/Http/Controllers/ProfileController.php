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
        ], [
            'avatar.max' => 'File terlalu besar. Maksimal ukuran adalah 2MB.',
            'avatar.image' => 'Tipe file tidak valid. Silakan unggah gambar (jpg, png, gif, dll).',
        ]);

        // Update Data Diri
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Update Avatar (jika ada upload baru)
        if ($request->hasFile('avatar')) {
            // Upload ke Cloudinary
            $response = cloudinary()->uploadApi()->upload($request->file('avatar')->getRealPath(), [
                'folder' => 'avatars',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ]);
            
            $uploadedFileUrl = $response['secure_url'];

            // Simpan URL Cloudinary ke database
            $user->avatar = $uploadedFileUrl;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
        }
}
