@extends('layouts.app')

@section('title', 'Tambah Ruangan - Admin')

@push('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(56,189,248,0.1) 100%);
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(56,189,248,0.2));
        border: 1px solid rgba(99,102,241,0.5);
        border-radius: 12px;
        color: #e5e7eb;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-card {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control {
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        color: #e5e7eb;
        font-size: 0.9rem;
        width: 100%;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        background: rgba(30,41,59,0.6);
        border-color: rgba(99,102,241,0.6);
        color: #f9fafb;
        outline: none;
        box-shadow: 0 0 20px rgba(99,102,241,0.2);
    }

    .form-control::placeholder {
        color: #64748b;
    }

    select.form-control {
        cursor: pointer;
    }

    .form-error {
        color: #f87171;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.5);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        color: #fca5a5;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert-error li {
        font-size: 0.9rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
        border: 1px solid rgba(99,102,241,0.8);
        border-radius: 12px;
        color: #e5e7eb;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.7), rgba(56,189,248,0.7));
        border-color: rgba(99,102,241,1);
        color: #f9fafb;
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <div class="container">
        <h1 class="page-title">➕ Tambah Ruangan Baru</h1>
    </div>
</div>

<div class="container pb-5">
    @include('admin.partials.navigation')

    <a href="{{ route('admin.ruangan.index') }}" class="back-btn">← Kembali ke Daftar</a>

    <div class="form-container">
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('admin.ruangan.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_ruangan" class="form-label">Nama Ruangan <span style="color: #f87171;">*</span></label>
                    <input 
                        type="text" 
                        id="nama_ruangan" 
                        name="nama_ruangan" 
                        class="form-control"
                        value="{{ old('nama_ruangan') }}"
                        placeholder="Contoh: Lab Komputer 1"
                        required
                    >
                    @error('nama_ruangan')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kode" class="form-label">Kode Ruangan <span style="color: #f87171;">*</span></label>
                    <input 
                        type="text" 
                        id="kode" 
                        name="kode" 
                        class="form-control"
                        value="{{ old('kode') }}"
                        placeholder="Contoh: LAB01"
                        required
                    >
                    @error('kode')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kapasitas" class="form-label">Kapasitas <span style="color: #f87171;">*</span></label>
                    <input 
                        type="number" 
                        id="kapasitas" 
                        name="kapasitas" 
                        class="form-control"
                        value="{{ old('kapasitas') }}"
                        placeholder="Contoh: 30"
                        min="1"
                        max="500"
                        required
                    >
                    @error('kapasitas')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipe" class="form-label">Tipe Ruangan <span style="color: #f87171;">*</span></label>
                    <select id="tipe" name="tipe" class="form-control" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="kelas" {{ old('tipe') === 'kelas' ? 'selected' : '' }}>Kelas</option>
                        <option value="laboratorium" {{ old('tipe') === 'laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                        <option value="seminar" {{ old('tipe') === 'seminar' ? 'selected' : '' }}>Ruang Seminar</option>
                        <option value="meeting" {{ old('tipe') === 'meeting' ? 'selected' : '' }}>Meeting Room</option>
                    </select>
                    @error('tipe')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status <span style="color: #f87171;">*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">✓ Tambah Ruangan</button>
            </form>
        </div>
    </div>
</div>
@endsection
