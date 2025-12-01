@extends('auth.layout')

@section('page_title', 'Login')

@section('content')
<form method="POST" action="{{ route('auth.login') }}" class="space-y-4">
    @csrf

    @if($errors->any())
        <div class="text-sm text-red-400">{{ $errors->first() }}</div>
    @endif

    <div>
        <label class="block text-sm text-slate-300">Email</label>
        <input name="email" type="email" value="{{ old('email') }}" required class="mt-1 w-full px-4 py-2 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div>
        <label class="block text-sm text-slate-300">Password</label>
        <input name="password" type="password" required class="mt-1 w-full px-4 py-2 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <div class="flex items-center justify-between">
        <div>
            <label class="inline-flex items-center text-sm text-slate-300"><input type="checkbox" name="remember" class="mr-2"/> Remember</label>
        </div>
        <div>
            <a href="{{ route('auth.showRegister') }}" class="text-sm text-cyan-300 hover:underline">Daftar</a>
        </div>
    </div>

    <div>
        <button type="submit" class="w-full py-2 rounded-lg bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-semibold hover:opacity-95">Login</button>
    </div>
</form>
@endsection
