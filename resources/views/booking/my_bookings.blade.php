@extends('layouts.app')

@section('title', 'Booking Saya')

@push('styles')
<style>
    .booking-page { padding: 2.5rem 0; }
    .page-title { font-size: 2.25rem; font-weight: 700; color: #f8fafc; margin-bottom: 1rem; }

    .alert-success {
        background: linear-gradient(90deg, rgba(99,102,241,0.08), rgba(139,92,246,0.03));
        border: 1px solid rgba(148,163,184,0.12);
        color: #e6eef8;
        padding: 0.85rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .booking-card {
        background: #ffffff;
        color: #0f172a;
        border-radius: 10px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 12px 30px rgba(2,6,23,0.45);
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        align-items: flex-start;
    }

    .booking-left { flex: 1 1 auto; }
    .booking-right { width: 180px; text-align: right; }

    .booking-ruangan { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.4rem; }
    .booking-meta { color: #64748b; font-size: 0.95rem; margin-bottom: 0.4rem; }

    .status-badge { display: inline-block; padding: 6px 10px; border-radius: 999px; font-weight: 700; font-size: 0.85rem; }
    .status-pending { background: rgba(250,204,21,0.12); color: #b45309; }
    .status-disetujui { background: rgba(16,185,129,0.08); color: #065f46; }
    .status-ditolak { background: rgba(239,68,68,0.08); color: #7f1d1d; }

    .booking-actions a { display:inline-block; margin-left:8px; color:#475569; font-weight:600; text-decoration:none }
    .booking-actions a:hover { text-decoration:underline }

    .empty-box { background: rgba(255,255,255,0.03); border-radius:8px; padding:2rem; color:#cbd5f5; text-align:center; }
</style>
@endpush

@section('content')
<div class="container booking-page">
    <h1 class="page-title">Booking Saya</h1>

    @if ($message = Session::get('success'))
        <div class="alert-success">
            {{ $message }}
        </div>
    @endif

    @if ($bookings->count() > 0)
        <div class="grid grid-cols-1 gap-6">
            @foreach ($bookings as $booking)
                @php
                    $status = strtolower($booking->status ?? 'pending');
                @endphp
                <div class="booking-card" role="article">
                    <div class="booking-left">
                        <div class="booking-ruangan">{{ $booking->ruangan->nama_ruang ?? 'Ruangan Tidak Ditemukan' }}</div>
                        <div class="booking-meta"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}</div>
                        <div class="booking-meta"><strong>Jam:</strong> {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->jam_mulai)->format('H:i') ?? $booking->jam_mulai }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->jam_selesai)->format('H:i') ?? $booking->jam_selesai }}</div>
                        <div style="margin-top:.5rem;" class="booking-meta"><strong>Keperluan:</strong> {{ $booking->keperluan }}</div>
                        @if (!empty($booking->dokumen))
                            <div style="margin-top:.6rem;">
                                <a href="{{ asset('storage/' . $booking->dokumen) }}" target="_blank" class="booking-actions">📎 Lihat Lampiran</a>
                                <a href="{{ asset('storage/' . $booking->dokumen) }}" download class="booking-actions">⬇️ Unduh</a>
                            </div>
                        @endif
                    </div>

                    <div class="booking-right">
                        <div>
                            @if ($status === 'pending')
                                <span class="status-badge status-pending">Pending</span>
                            @elseif ($status === 'disetujui' || $status === 'approved')
                                <span class="status-badge status-disetujui">Disetujui</span>
                            @else
                                <span class="status-badge status-ditolak">{{ ucfirst($status) }}</span>
                            @endif
                        </div>
                        <div style="margin-top:12px; color:#94a3b8">Dibuat: {{ \Carbon\Carbon::parse($booking->dibuat)->format('d-m-Y H:i') }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-box">
            <p class="mb-4">Anda belum memiliki booking</p>
            <a href="{{ route('ruangan.list') }}" class="inline-block text-white font-semibold py-2 px-4 rounded" style="background: linear-gradient(135deg,#6366f1,#22d3ee);">Pesan Ruangan Sekarang</a>
        </div>
    @endif
</div>
@endsection
