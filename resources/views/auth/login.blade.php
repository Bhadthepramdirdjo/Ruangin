@extends('layouts.app')

@section('title', 'Login - Ruangin.app')

@push('styles')
{{-- FontAwesome untuk Ikon Mata --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .auth-wrapper {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-card {
        max-width: 420px;
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

    /* Update Style untuk Input dan Input Group agar menyatu */
    .auth-card .form-control {
        background: rgba(15,23,42,0.9);
        border-color: rgba(148,163,184,0.7);
        color: #f9fafb;
    }

    .auth-card .form-control:focus,
    .auth-card .input-group-text:focus {
        background: rgba(15,23,42,1);
        border-color: #818cf8;
        box-shadow: 0 0 0 0.25rem rgba(129, 140, 248, 0.25);
    }

    .auth-card .form-control::placeholder {
        color: #9ca3af;
    }

    /* Style khusus untuk Password Group */
    .password-group .form-control {
        border-right: none; /* Hilangkan border kanan input */
    }
    
    .password-group .input-group-text {
        background: rgba(15,23,42,0.9);
        border-color: rgba(148,163,184,0.7);
        border-left: none; /* Hilangkan border kiri ikon */
        color: #9ca3af;
        cursor: pointer;
    }
    
    .password-group .input-group-text:hover {
        color: #e5e7eb;
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

            <div class="text-center mb-3">
                <div class="auth-badge mb-2">Masuk ke Ruangin.app</div>
                <h1 class="auth-title">Login</h1>
                <p class="auth-subtitle">
                    Kelola booking ruangan kelas, lab, dan ruang rapat dalam satu aplikasi.
                </p>
            </div>

            @if (session('status'))
                <div class="alert alert-success py-2">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li style="font-size:.85rem;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-3">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="nama@kampus.ac.id">
                </div>

                {{-- Password dengan Ikon Mata --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group password-group">
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password">
                        <span class="input-group-text" id="togglePassword">
                            <i class="fa-regular fa-eye" id="iconPassword"></i>
                        </span>
                    </div>
                </div>

                {{-- Link register (remember me removed) --}}
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <div class="auth-footer-text">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="auth-link">Daftar</a>
                    </div>
                </div>

                {{-- Tombol login --}}
                <div class="d-grid">
                    <button type="submit" class="gradient-btn" style="background: linear-gradient(to right, #818cf8, #22d3ee); border:none; padding:12px; border-radius:8px; color:white; font-weight:700;">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Script untuk Toggle Password --}}
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const icon = document.querySelector('#iconPassword');

    togglePassword.addEventListener('click', function (e) {
        // Toggle tipe attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle ikon mata
        if (type === 'password') {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });
</script>
@endsection