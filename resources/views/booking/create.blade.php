@extends('layouts.app')

@section('title', 'Ajukan Peminjaman - ' . $ruangan->nama_ruang)

@push('styles')
<style>
    .booking-header {
        background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(56,189,248,0.1) 100%);
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .booking-title {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
        -webkit-background-clip: text;
        color: transparent;
    }

    .booking-form-container {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 16px;
        padding: 2rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .ruangan-info-box {
        background: rgba(30,41,59,0.5);
        border-left: 4px solid rgba(99,102,241,0.6);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .ruangan-info-box .label {
        color: #cbd5f5;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .ruangan-info-box .value {
        color: #e5e7eb;
        font-size: 1.25rem;
        font-weight: 600;
        margin-top: 0.25rem;
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

    .form-error {
        color: #f87171;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .submit-btn {
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
        margin-top: 1.5rem;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.7), rgba(56,189,248,0.7));
        border-color: rgba(99,102,241,1);
        transform: translateY(-2px);
        color: #f9fafb;
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
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(56,189,248,0.3));
        border-color: rgba(99,102,241,0.8);
        color: #f9fafb;
        text-decoration: none;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.5);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert-error li {
        color: #fca5a5;
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
<div class="booking-header">
    <div class="container">
        <a href="{{ route('ruangan.list') }}" class="back-btn">
            <span>←</span> Kembali ke Daftar Ruangan
        </a>
        <h1 class="booking-title">📄 Ajukan Peminjaman</h1>
    </div>
</div>

<div class="container pb-5">
    <div class="booking-form-container">
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="ruangan-info-box">
            <div class="label">Ruangan yang Dipilih</div>
            <div class="value">{{ $ruangan->nama_ruang }}</div>
            <div style="margin-top: 0.5rem; color: #cbd5f5; font-size: 0.9rem;">
                📍 {{ $ruangan->lokasi }} • 👥 {{ $ruangan->kapasitas }} orang
            </div>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="ruangan_id" value="{{ $ruangan->id_ruangan }}">

            <div class="form-group">
                <label for="tanggal" class="form-label">Tanggal Pesan</label>
                <input 
                    type="date" 
                    id="tanggal" 
                    name="tanggal" 
                    class="form-control @error('tanggal') border-red-500 @enderror"
                    value="{{ old('tanggal') }}"
                    required
                >
                @error('tanggal')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                <input 
                    type="time" 
                    id="jam_mulai" 
                    name="jam_mulai" 
                    class="form-control @error('jam_mulai') border-red-500 @enderror"
                    value="{{ old('jam_mulai') }}"
                    required
                >
                @error('jam_mulai')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                <input 
                    type="time" 
                    id="jam_selesai" 
                    name="jam_selesai" 
                    class="form-control @error('jam_selesai') border-red-500 @enderror"
                    value="{{ old('jam_selesai') }}"
                    required
                >
                @error('jam_selesai')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="keperluan" class="form-label">Keperluan / Deskripsi Kegiatan</label>
                <textarea 
                    id="keperluan" 
                    name="keperluan" 
                    class="form-control @error('keperluan') border-red-500 @enderror"
                    rows="4"
                    placeholder="Jelaskan kegiatan atau tujuan penggunaan ruangan..."
                    required
                >{{ old('keperluan') }}</textarea>
                @error('keperluan')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="dokumen" class="form-label">Lampiran Surat Peminjaman (PDF)</label>
                <input
                    type="file"
                    id="dokumen"
                    name="dokumen"
                    accept="application/pdf"
                    class="form-control @error('dokumen') border-red-500 @enderror"
                >
                <small style="color:#94a3b8; display:block; margin-top:6px;">Upload file PDF sebagai surat permohonan peminjaman (maks 5MB).</small>
                @error('dokumen')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">
                <span>✓</span> Buat Booking
            </button>
        </form>
    </div>
</div>
@endsection
