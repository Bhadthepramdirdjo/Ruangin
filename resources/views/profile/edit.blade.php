@extends('layouts.app')

@section('title', 'Edit Profil - Ruangin.app')

@push('styles')
<style>
    /* Styling khusus untuk input form agar menyatu dengan dark theme */
    .form-label {
        color: #cbd5f5;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .form-control-dark {
        background-color: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(148, 163, 184, 0.2);
        color: #e5e7eb;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control-dark:focus {
        background-color: rgba(15, 23, 42, 0.8);
        border-color: #a855f7; /* Warna ungu aksen */
        box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
        color: #fff;
        outline: none;
    }

    .form-control-dark::placeholder {
        color: #94a3b8;  /* Warna abu-abu yang lebih terang (Slate-400) */
        opacity: 1;      /* Wajib untuk Firefox agar warnanya keluar */
    }

    /* Override autofill browser style agar tidak jadi putih */
    .form-control-dark:-webkit-autofill,
    .form-control-dark:-webkit-autofill:hover,
    .form-control-dark:-webkit-autofill:focus {
        -webkit-text-fill-color: #e5e7eb;
        -webkit-box-shadow: 0 0 0px 1000px #0f172a inset;
        transition: background-color 5000s ease-in-out 0s;
    }

    .section-header {
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding-bottom: 1rem;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #a855f7, #22d3ee);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
        color: white;
        margin-bottom: 1rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .avatar-wrapper {
        position: relative;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid #a855f7; /* Warna border ungu */
        transition: all 0.3s ease;
    }

    .avatar-wrapper-atas {
        position: relative;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid #a855f7;
        transition: all 0.3s ease;
    }

    .avatar-wrapper:hover {
        transform: scale(1.05);
        border-color: #22d3ee;
        box-shadow: 0 0 15px rgba(34, 211, 238, 0.5);
    }

    .avatar-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .avatar-wrapper:hover .avatar-overlay {
        opacity: 1;
    }

    .overlay-icon {
        color: white;
        font-size: 1.5rem;
        margin-bottom: 2px;
    }

    .overlay-text {
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>
@endpush

@section('content')
<div class="container fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-4" role="alert"
                 style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #86efac;">
                <span class="me-2">✅</span>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            <div class="card-glass p-4 p-md-5">
                <div class="d-flex align-items-center mb-5 section-header">
                    <div>
                        <label class="avatar-wrapper-atas shadow-lg me-4">
                            <img
                                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '#' }}"
                                alt="Profil"
                                class="avatar-image {{ $user->avatar ? '' : 'd-none' }}">
                            <div id="avatar-initial" class="{{ $user->avatar ? 'd-none' : '' }}"
                                style="width: 100%; height: 100%; background: linear-gradient(135deg, #a855f7, #22d3ee); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: white; font-weight: bold;">
                                {{ substr($user->nama, 0, 1) }}
                            </div>
                    </div>
                    <div>
                        <h1 class="h3 fw-bold text-white mb-1">Pengaturan Profil</h1>
                        <p class="text-label">Kelola informasi akun dan keamanan Anda</p>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <div class="col-12 d-flex align-items-center mb-4">
                            <label class="avatar-wrapper shadow-lg me-4" for="avatar-input">

                                <img id="avatar-preview"
                                     src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '#' }}"
                                     alt="Profil"
                                     class="avatar-image {{ $user->avatar ? '' : 'd-none' }}">

                                <div id="avatar-initial" class="{{ $user->avatar ? 'd-none' : '' }}"
                                     style="width: 100%; height: 100%; background: linear-gradient(135deg, #a855f7, #22d3ee); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: white; font-weight: bold;">
                                    {{ substr($user->nama, 0, 1) }}
                                </div>

                                <div class="avatar-overlay">
                                    <span class="overlay-icon">📷</span>
                                    <span class="overlay-text">Ubah</span>
                                </div>

                                <input type="file" id="avatar-input" name="avatar" class="d-none" accept="image/*">
                            </label>

                            <div>
                                <h4 class="text-white fw-bold mb-1">Foto Profil</h4>
                                <p class="text-tabel">Klik gambar untuk mengganti foto.</p>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-dark border border-secondary text-secondary">Max 2MB</span>
                                </div>
                                <div class="mt-2 text-label">Member sejak: {{ \Carbon\Carbon::parse($user->dibuat)->locale('id')->isoFormat('D MMMM YYYY') }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="text-gradient mb-1 fw-bold" style="font-size: 1.1rem;">📝 Informasi Dasar</h5>
                        </div>

                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text"
                                   class="form-control form-control-dark @error('nama') is-invalid @enderror"
                                   id="nama" name="nama"
                                   value="{{ old('nama', $user->nama) }}" required>
                            @error('nama')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email"
                                   class="form-control form-control-dark @error('email') is-invalid @enderror"
                                   id="email" name="email"
                                   value="{{ old('email', $user->email) }}" required>
                             @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <h5 class="text-gradient mb-1 fw-bold" style="font-size: 1.1rem;">🔒 Ganti Password</h5>
                            <p class="text-label">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password"
                                   class="form-control form-control-dark @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Minimal 8 karakter">
                             @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password"
                                   class="form-control form-control-dark"
                                   id="password_confirmation" name="password_confirmation"
                                   placeholder="Ulangi password baru">
                        </div>

                        <div class="col-12 mt-4 pt-3 border-top border-secondary border-opacity-25 d-flex justify-content-end gap-3">
                            <a href="{{ route('ruangan.list') }}" class="btn btn-ghost px-4">Batal</a>
                            <button type="submit" class="gradient-btn">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script Preview Gambar (Update Realtime)
    document.getElementById('avatar-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImg = document.getElementById('avatar-preview');
        const initialDiv = document.getElementById('avatar-initial');

        if (!file) {
            return;
        }

        const maxBytes = 2 * 1024 * 1024; // 2MB
        if (file.size > maxBytes) {
            // Friendly popup and reset input + preview
            alert('File terlalu besar. Maksimal ukuran adalah 2MB.');
            event.target.value = '';
            if (previewImg) previewImg.classList.add('d-none');
            if (initialDiv) initialDiv.classList.remove('d-none');
            return;
        }

        // If file size OK, preview it
        const reader = new FileReader();
        reader.onload = function(e) {
            // 1. Masukkan hasil baca file ke src gambar
            if (previewImg) previewImg.src = e.target.result;

            // 2. Munculkan tag img, sembunyikan inisial huruf
            if (previewImg) previewImg.classList.remove('d-none');
            if (initialDiv) initialDiv.classList.add('d-none');
        }
        reader.readAsDataURL(file);
    });
</script>
@endpush
