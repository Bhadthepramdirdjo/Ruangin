@extends('layouts.app')

@section('title', 'Detail Booking - Admin')

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
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(56,189,248,0.3));
        border-color: rgba(99,102,241,0.8);
    }

    .detail-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .detail-card {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .detail-section {
        margin-bottom: 1.5rem;
    }

    .detail-section:last-child {
        margin-bottom: 0;
    }

    .detail-label {
        color: #a5b4fc;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.35rem;
        font-weight: 600;
    }

    .detail-value {
        color: #e5e7eb;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .divider {
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(148,163,184,0.3), transparent);
        margin: 1.5rem 0;
    }

    .badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .badge-pending {
        background: rgba(250,204,21,0.12);
        color: #b45309;
    }

    .badge-approved {
        background: rgba(16,185,129,0.08);
        color: #065f46;
    }

    .badge-rejected {
        background: rgba(239,68,68,0.08);
        color: #7f1d1d;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
    }

    .btn-success {
        background: rgba(16,185,129,0.2);
        border: 1px solid rgba(16,185,129,0.5);
        color: #10b981;
    }

    .btn-success:hover {
        background: rgba(16,185,129,0.3);
        color: #d1fae5;
    }

    .btn-danger {
        background: rgba(239,68,68,0.2);
        border: 1px solid rgba(239,68,68,0.5);
        color: #ef4444;
    }

    .btn-danger:hover {
        background: rgba(239,68,68,0.3);
        color: #fca5a5;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .document-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(99,102,241,0.15);
        border: 1px solid rgba(99,102,241,0.3);
        border-radius: 8px;
        color: #a5b4fc;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .document-link:hover {
        background: rgba(99,102,241,0.25);
        color: #e0e7ff;
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <div class="container">
        <h1 class="page-title">📋 Detail Booking</h1>
    </div>
</div>

<div class="container pb-5">
    @include('admin.partials.navigation')

    <a href="{{ route('admin.booking.index') }}" class="back-btn">← Kembali ke Booking</a>

    <div class="detail-container">
        <div class="detail-card">
            <!-- Status Badge -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #e5e7eb;">Booking ID: {{ $booking->id }}</h2>
                <div>
                    @if ($booking->status === 'pending')
                        <span class="badge badge-pending">Pending</span>
                    @elseif ($booking->status === 'disetujui')
                        <span class="badge badge-approved">Disetujui</span>
                    @else
                        <span class="badge badge-rejected">Ditolak</span>
                    @endif
                </div>
            </div>

            <div class="divider"></div>

            <!-- Ruangan Section -->
            <div class="detail-section">
                <div class="detail-label">Ruangan</div>
                <div class="detail-value">{{ $booking->ruangan->nama_ruang ?? '-' }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Kode Ruangan</div>
                <div class="detail-value">{{ $booking->ruangan->kode_ruang ?? '-' }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Kapasitas</div>
                <div class="detail-value">👥 {{ $booking->ruangan->kapasitas ?? '-' }} orang</div>
            </div>

            <div class="divider"></div>

            <!-- User Section -->
            <div class="detail-section">
                <div class="detail-label">Nama Peminjam</div>
                <div class="detail-value">{{ $booking->user->nama ?? '-' }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Email</div>
                <div class="detail-value">{{ $booking->user->email ?? '-' }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Role</div>
                <div class="detail-value">{{ ucfirst($booking->user->role ?? '-') }}</div>
            </div>

            <div class="divider"></div>

            <!-- Booking Details -->
            <div class="detail-section">
                <div class="detail-label">Tanggal Peminjaman</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}</div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Jam Peminjaman</div>
                <div class="detail-value">
                    @php
                        $jamMulai = \Carbon\Carbon::parse($booking->tanggal . ' ' . $booking->jam_mulai);
                        $jamSelesai = $jamMulai->copy()->addMinutes($booking->jumlah_sks * 50);
                    @endphp
                    {{ $jamMulai->format('H:i') }} - {{ $jamSelesai->format('H:i') }} ({{ $booking->jumlah_sks }} SKS)
                </div>
            </div>

            <div class="detail-section">
                <div class="detail-label">Keperluan</div>
                <div class="detail-value">{{ $booking->keperluan }}</div>
            </div>

            @if (!empty($booking->dokumen))
                <div class="detail-section">
                    <div class="detail-label">Lampiran Surat Peminjaman</div>
                    <div style="margin-top: 0.5rem;">
                        <a href="{{ route('booking.dokumen.show', $booking->id) }}" target="_blank" class="document-link">
                            📄 Lihat Dokumen
                        </a>
                        <a href="{{ route('booking.dokumen.download', $booking->id) }}" class="document-link" style="margin-left: 0.5rem;">
                            ⤓ Unduh
                        </a>
                    </div>
                </div>
            @endif

            <div class="divider"></div>

            <!-- Timestamps -->
            <div class="detail-section">
                <div class="detail-label">Dibuat Tanggal</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($booking->dibuat)->format('d-m-Y H:i') }}</div>
            </div>

            @if (!empty($booking->diubah))
                <div class="detail-section">
                    <div class="detail-label">Diubah Tanggal</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($booking->diubah)->format('d-m-Y H:i') }}</div>
                </div>
            @endif

            <!-- Action Buttons -->
            @if ($booking->status === 'pending')
                <div class="button-group">
                    <form action="{{ route('admin.booking.approve', $booking->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">✓ Setujui Booking</button>
                    </form>
                    <form action="{{ route('admin.booking.reject', $booking->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">✕ Tolak Booking</button>
                    </form>
                </div>
            @else
                <div style="color: #94a3b8; font-size: 0.9rem; margin-top: 1.5rem;">
                    Booking sudah dalam status: <strong>{{ ucfirst($booking->status) }}</strong>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
