@extends('auth.layout')

@section('content')
    <div>
        <h2 class="text-2xl font-bold">Dosen Dashboard</h2>
        <p class="text-slate-300 mt-2">Welcome, {{ auth()->user()->nama ?? auth()->user()->email }}</p>
        <div class="mt-6">
            <a href="{{ route('auth.logout') }}" class="text-sm text-cyan-300">Logout</a>
        </div>
    </div>
@endsection
