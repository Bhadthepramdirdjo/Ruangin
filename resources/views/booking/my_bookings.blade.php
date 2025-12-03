@extends('layouts.app')

@section('title', 'Booking Saya')

@push('styles')
<style>
    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #f9fafb;
    }

    .booking-alert {
        border-radius: 14px;
        padding: .85rem 1rem;
        background: rgba(16, 185, 129, .14);
        border: 1px solid rgba(16, 185, 129, .55);
        color: #d1fae5;
        font-size: .9rem;
        margin-bottom: 1.5rem;
    }

    .booking-card {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.25rem;
        border-radius: 24px;
        padding: 1.5rem 1.8rem 1.4rem;
        margin-bottom: 1.4rem;
        background: radial-gradient(circle at top left,
                    rgba(148, 163, 184, .25), transparent 55%),
                    rgba(15, 23, 42, .97);
        border: 1px solid rgba(148, 163, 184, .35);
        box-shadow: 0 20px 50px rgba(15, 23, 42, .95);
        overflow: hidden;
    }

    .booking-card::before {
        content: "";
        position: absolute;
        inset: 0;
        width: 4px;
        border-radius: 24px;
        background: linear-gradient(180deg, #38bdf8, #6366f1);
    }

    /* Variasi warna per status */
    .booking-card--pending::before {
        background: linear-gradient(180deg, #facc15, #f97316);
    }

    .booking-card--approved::before {
        background: linear-gradient(180deg, #22c55e, #16a34a);
    }

    .booking-card--rejected::before {
        background: linear-gradient(180deg, #f97373, #ef4444);
    }

    .booking-main {
        margin-left: 0.9rem; /* geser dikit dari garis kiri */
        flex: 1;
    }

    .booking-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #f1f5f9;
        margin-bottom: .75rem;
    }

    .booking-meta-row {
        font-size: .92rem;
        color: #e5e7eb;
        margin-bottom: .25rem;
    }

    .booking-meta-row strong {
        font-weight: 600;
        color: #e5e7eb;
        margin-right: .35rem;
    }

    .booking-meta-row span.value {
        color: #e5e7eb;
    }

    .booking-purpose {
        margin-top: .45rem;
        font-size: .92rem;
        color: #cbd5f5;
    }

    .booking-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
        margin-top: 1rem;
    }

    .booking-btn {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        border-radius: 999px;
        font-size: .87rem;
        font-weight: 500;
        padding: .48rem 1.1rem;
        text-decoration: none;
        border: 1px solid transparent;
        transition: all .18s ease-out;
        cursor: pointer;
    }

    .booking-btn .icon {
        font-size: .95rem;
        line-height: 1;
    }

    .booking-btn-ghost {
        background: rgba(15, 23, 42, .9);
        border-color: rgba(148, 163, 184, .6);
        color: #e5e7eb;
    }

    .booking-btn-ghost:hover {
        background: rgba(30, 64, 175, .75);
        border-color: rgba(129, 140, 248, 1);
        color: #e5e7eb;
        text-decoration: none;
    }

    .booking-btn-primary {
        background: linear-gradient(120deg, #0ea5e9, #22c1f1);
        color: #0b1120;
        border: none;
        box-shadow: 0 12px 30px rgba(56, 189, 248, .55);
    }

    .booking-btn-primary:hover {
        filter: brightness(1.06);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .booking-side {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: .4rem;
        min-width: 160px;
        font-size: .85rem;
    }

    .booking-status-badge {
        padding: .25rem .8rem;
        border-radius: 999px;
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: .02em;
        text-transform: capitalize;
    }

    .booking-status-badge--pending {
        background: #fef3c7;
        color: #92400e;
    }

    .booking-status-badge--approved {
        background: #dcfce7;
        color: #166534;
    }

    .booking-status-badge--rejected {
        background: #fee2e2;
        color: #b91c1c;
    }

    .booking-created {
        color: #cbd5f5;
        opacity: .9;
    }

    .booking-created-label {
        opacity: .8;
        margin-right: .25rem;
    }

    .empty-state {
        border-radius: 20px;
        padding: 1.5rem 1.6rem;
        background: rgba(15, 23, 42, .96);
        border: 1px dashed rgba(148, 163, 184, .6);
        color: #cbd5f5;
        font-size: .92rem;
        text-align: center;
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .booking-card {
            flex-direction: column;
        }

        .booking-side {
            align-items: flex-start;
            margin-left: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">

    <h1 class="page-title mb-3">Booking Saya</h1>

    @if (session('success'))
        <div class="booking-alert">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($bookings as $booking)
        @php
            $status = strtolower($booking->status);
            $cardClass  = 'booking-card booking-card--pending';
            $badgeClass = 'booking-status-badge booking-status-badge--pending';

            if (in_array($status, ['disetujui', 'approved'])) {
                $cardClass  = 'booking-card booking-card--approved';
                $badgeClass = 'booking-status-badge booking-status-badge--approved';
            } elseif (in_array($status, ['ditolak', 'rejected'])) {
                $cardClass  = 'booking-card booking-card--rejected';
                $badgeClass = 'booking-status-badge booking-status-badge--rejected';
            }

            $createdAt = $booking->dibuat
                ? \Carbon\Carbon::parse($booking->dibuat)->format('d-m-Y H:i')
                : ($booking->created_at
                    ? \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y H:i')
                    : '-');
        @endphp

        <div class="{{ $cardClass }}">
            {{-- Kiri: Detail utama --}}
            <div class="booking-main">
                <div class="booking-title">
                    {{ $booking->ruangan->nama_ruang ?? 'Ruangan' }}
                </div>

                <div class="booking-meta-row">
                    <strong>Tanggal:</strong>
                    <span class="value">
                        {{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}
                    </span>
                </div>

                <div class="booking-meta-row">
                    <strong>Jam:</strong>
                    <span class="value">
                        {{ substr($booking->jam_mulai,0,5) }} - {{ substr($booking->jam_selesai,0,5) }}
                    </span>
                </div>

                <div class="booking-purpose">
                    <strong>Keperluan:</strong>
                    <span class="value">{{ $booking->keperluan }}</span>
                </div>

                @if (!empty($booking->dokumen))
                    <div class="booking-actions">
                        {{-- Lihat lampiran (tab baru) --}}
                        <a href="{{ route('booking.dokumen.show', $booking->id) }}"
                           target="_blank"
                           class="booking-btn booking-btn-ghost">
                            <span class="icon">📎</span>
                            <span>Lihat Lampiran</span>
                        </a>

                        {{-- Unduh dokumen --}}
                        <a href="{{ route('booking.dokumen.download', $booking->id) }}"
                           class="booking-btn booking-btn-primary">
                            <span class="icon">⬇️</span>
                            <span>Unduh</span>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Kanan: Status & tanggal dibuat --}}
            <div class="booking-side">
                <span class="{{ $badgeClass }}">
                    {{ ucfirst($booking->status) }}
                </span>
                <div class="booking-created">
                    <span class="booking-created-label">Dibuat:</span>
                    <span>{{ $createdAt }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            Belum ada booking yang Anda buat.  
            Silakan gunakan menu <strong>Booking</strong> untuk mengajukan peminjaman ruangan.
        </div>
    @endforelse
</div>
@endsection
