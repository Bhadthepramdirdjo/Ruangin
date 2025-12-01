<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $role = Auth::user()->role ?? 'mahasiswa';
            return match($role) {
                'admin' => redirect()->intended('/admin/dashboard'),
                'dosen' => redirect()->intended('/dosen/dashboard'),
                default => redirect()->intended('/mahasiswa/dashboard'),
            };
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required','string','max:150'],
            'email' => ['required','email','max:150','unique:users,email'],
            'password' => ['required','confirmed','min:8'],
            'role' => ['required','in:mahasiswa,dosen'],
        ]);

        $user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        Auth::login($user);

        $role = $user->role ?? 'mahasiswa';
        return match($role) {
            'admin' => redirect('/admin/dashboard'),
            'dosen' => redirect('/dosen/dashboard'),
            default => redirect('/mahasiswa/dashboard'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
