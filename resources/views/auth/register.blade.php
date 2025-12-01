@extends('auth.layout')

@section('page_title', 'Register')

@section('content')
<form method="POST" action="{{ route('auth.register') }}" class="space-y-4">
    @csrf

    @if($errors->any())
        <div class="text-sm text-red-400">{{ $errors->first() }}</div>
    @endif

    <div>
        <label class="block text-sm text-slate-300">Nama Lengkap</label>
        <input name="nama" type="text" value="{{ old('nama') }}" required class="mt-1 w-full px-4 py-2 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div>
        <label class="block text-sm text-slate-300">Email</label>
        <input name="email" type="email" value="{{ old('email') }}" required class="mt-1 w-full px-4 py-2 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div>
        <label class="block text-sm text-slate-300">Password</label>
        <input name="password" type="password" required class="mt-1 w-full px-4 py-2 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div>
        <label class="block text-sm text-slate-300">Konfirmasi Password</label>
        <input name="password_confirmation" type="password" required class="mt-1 w-full px-4 py-2 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div>
        <label class="block text-sm text-slate-300">Role</label>
        <select name="role" required class="mt-1 w-full px-4 py-2 rounded-lg bg-white/5 border border-white/10">
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
        </select>
    </div>

    <div>
        <button type="submit" class="w-full py-2 rounded-lg bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-semibold hover:opacity-95">Daftar</button>
    </div>

    <div class="text-center text-sm text-slate-300">
        Sudah punya akun? <a href="{{ route('auth.showLogin') }}" class="text-cyan-300 hover:underline">Login</a>
    </div>
</form>
@endsection
