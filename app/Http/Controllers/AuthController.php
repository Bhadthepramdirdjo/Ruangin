<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:mahasiswa,dosen', // admin di-set manual dari DB
        ];

        $messages = [
            'role.in' => 'Role tidak valid. Pilih mahasiswa atau dosen.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // Custom rule: jika role = dosen, email harus mengandung '@dosen'
        $validator->after(function ($v) use ($request) {
            if (isset($request->role) && $request->role === 'dosen') {
                $email = $request->email ?? '';
                if (stripos($email, '@dosen') === false) {
                    $v->errors()->add('email', 'Email dosen harus mengandung "@dosen".');
                }
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $user = User::create([
            'nama'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
            'is_verified' => $validated['role'] === 'dosen' ? false : true,
        ]);

        // Tidak login otomatis, redirect ke login dengan notifikasi
        return redirect()->route('login')->with('success', 'Akun telah berhasil terdaftar! Silakan login untuk melanjutkan.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Check DB connectivity and presence of users table to avoid 500 errors
        try {
            if (!Schema::hasTable('users')) {
                return back()->withErrors([
                    'database' => 'Tabel `users` tidak ditemukan. Jalankan migrasi atau periksa konfigurasi database.'
                ])->onlyInput('email');
            }
        } catch (QueryException $e) {
            return back()->withErrors([
                'database' => 'Tidak dapat terhubung ke database: ' . $e->getMessage()
            ])->onlyInput('email');
        } catch (\Exception $e) {
            return back()->withErrors([
                'database' => 'Kesalahan koneksi database: ' . $e->getMessage()
            ])->onlyInput('email');
        }

        // Remove 'remember me' functionality: do not pass remember flag
        if (Auth::attempt($credentials)) {
            // If the account is a dosen and not verified yet, prevent login
            $user = Auth::user();
            if ($user->role === 'dosen' && !$user->is_verified) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun dosen belum diverifikasi oleh admin. Silakan tunggu verifikasi.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->intended(route('landing'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
