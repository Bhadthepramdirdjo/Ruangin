@extends('layouts.app')

@section('title', 'Registrasi - Ruangin.app')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-card {
        max-width: 520px;
        width: 100%;
        border-radius: 28px;
        background:
            radial-gradient(circle at top left, rgba(129,140,248,0.3), transparent 60%),
            radial-gradient(circle at bottom right, rgba(56,189,248,0.4), transparent 60%),
            rgba(15,23,42,0.96);
        border: 1px solid rgba(148,163,184,0.5);
        box-shadow: 0 24px 60px rgba(15,23,42,0.95);
        color: #e5e7eb;
        padding: 2.2rem 2.4rem 2rem;
        position: relative;
        overflow: hidden;
        animation: fadeInUp .45s ease-out;
    }

    .auth-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 0 0, rgba(255,255,255,0.35), transparent 65%);
        opacity: .12;
        pointer-events: none;
    }

    .auth-card-inner {
        position: relative;
        z-index: 1;
    }

    .auth-badge {
        text-transform: uppercase;
        letter-spacing: .14em;
        font-size: .78rem;
        color: #cbd5f5;
        text-align: center;
    }

    .auth-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: .4rem;
        background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
        -webkit-background-clip: text;
        color: transparent;
        text-align: center;
    }

    .auth-subtitle {
        font-size: .9rem;
        color: #e5e7eb;
        text-align: center;
        margin-bottom: 1.4rem;
    }

    .auth-card .form-label {
        color: #e5e7eb;
        font-weight: 600;
        font-size: .9rem;
    }

    .auth-card .form-control,
    .auth-card .form-select {
        background: rgba(15,23,42,0.9);
        border-color: rgba(148,163,184,0.7);
        color: #f9fafb;
    }

    .auth-card .form-control::placeholder {
        color: #9ca3af;
    }

    .auth-footer-text {
        font-size: .85rem;
        color: #cbd5f5;
    }

    .auth-link {
        color: #7dd3fc;
        text-decoration: none;
        font-weight: 500;
    }

    .auth-link:hover {
        text-decoration: underline;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(16px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-card-inner">

            <div class="mb-3">
                <div class="auth-badge mb-2">Buat Akun Baru</div>
                <h1 class="auth-title">Registrasi</h1>
                <p class="auth-subtitle">
                    Daftarkan akun Anda sebagai mahasiswa atau dosen untuk mengelola booking ruangan kampus.
                </p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li style="font-size:.85rem;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="mt-2">
                @csrf

                {{-- Nama lengkap --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nama lengkap sesuai data kampus">
                </div>

                {{-- Email kampus --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email Kampus</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="nama@kampus.ac.id">
                </div>

                {{-- NIM / NIP --}}
                <div class="mb-3">
                    <label for="nim_nip" class="form-label">NIM / NIP</label>
                    <input id="nim_nip"
                           type="text"
                           name="nim_nip"
                           value="{{ old('nim_nip') }}"
                           required
                           class="form-control @error('nim_nip') is-invalid @enderror"
                           placeholder="Masukkan NIM (mahasiswa) atau NIP (dosen)">
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role"
                            name="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Role --</option>
                        <option value="mahasiswa" {{ old('role')=='mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="dosen" {{ old('role')=='dosen' ? 'selected' : '' }}>Dosen</option>
                    </select>
                </div>

                <div class="row g-3">
                    {{-- Password --}}
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter">
                    </div>

                    {{-- Konfirmasi password --}}
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               class="form-control"
                               placeholder="Ulangi password">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('login') }}" class="btn btn-ghost">
                        Sudah punya akun? Login
                    </a>
                    <button type="submit" class="gradient-btn">
                        Daftar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
