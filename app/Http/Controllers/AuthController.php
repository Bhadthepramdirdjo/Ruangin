<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        Auth::login($user);

        return redirect()->route('landing')->with('success', 'Registrasi berhasil, selamat datang di Ruangin.app!');
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

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
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
