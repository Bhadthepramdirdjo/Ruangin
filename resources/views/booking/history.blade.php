@extends('layouts.app')

@section('title', 'Riwayat Booking')

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
        animation: fadeInDown .4s ease-out;
    }

    /* ===== CARD UTAMA ===== */
    .booking-card {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.25rem;
        border-radius: 24px;
        padding: 1.5rem 1.8rem 1.4rem;
        margin-bottom: 1.4rem;
        background:
            radial-gradient(circle at top left, rgba(148, 163, 184, .25), transparent 55%),
            radial-gradient(circle at bottom right, rgba(37, 99, 235, .18), rgba(15, 23, 42, .97));
        border: 1px solid rgba(148, 163, 184, .35);
        box-shadow: 0 18px 48px rgba(15, 23, 42, .92);
        overflow: hidden;
        transform: translateY(0);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease, background .3s ease;
        animation: cardAppear .35s ease-out;
    }

    .booking-card::before {
        content: "";
        position: absolute;
        inset: 0;
        width: 4px;
        border-radius: 24px;
        background: linear-gradient(180deg, #38bdf8, #6366f1);
        opacity: .9;
    }

    /* Variasi warna per status (garis kiri) */
    .booking-card--pending::before {
        background: linear-gradient(180deg, #facc15, #f97316);
    }
    .booking-card--approved::before {
        background: linear-gradient(180deg, #22c55e, #16a34a);
    }
    .booking-card--rejected::before {
        background: linear-gradient(180deg, #fb7185, #ef4444);
    }

    .booking-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 26px 62px rgba(15, 23, 42, .98);
        border-color: rgba(129, 140, 248, .7);
        background:
            radial-gradient(circle at top left, rgba(191, 219, 254, .22), transparent 55%),
            radial-gradient(circle at bottom right, rgba(59, 130, 246, .25), rgba(15, 23, 42, .97));
    }

    .booking-main {
        margin-left: 0.9rem;
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

    /* ===== BUTTON LAMPIRAN & UNDUH ===== */
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
        box-shadow: 0 0 0 rgba(148, 163, 184, 0);
    }
    .booking-btn-ghost:hover {
        background: rgba(30, 64, 175, .85);
        border-color: rgba(129, 140, 248, 1);
        color: #e5e7eb;
        text-decoration: none;
        box-shadow: 0 0 16px rgba(129, 140, 248, .7);
        transform: translateY(-1px);
    }

    .booking-btn-primary {
        background: radial-gradient(circle at top, #0ea5e9, #22c1f1 45%, #0284c7);
        color: #0b1120;
        border: none;
        box-shadow: 0 12px 30px rgba(56, 189, 248, .6);
        animation: glowPulse 2.4s ease-in-out infinite;
    }
    .booking-btn-primary:hover {
        filter: brightness(1.06);
        transform: translateY(-1px) scale(1.02);
        text-decoration: none;
        box-shadow: 0 16px 36px rgba(56, 189, 248, .85);
    }

    /* ===== STATUS & WAKTU ===== */
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
        display: inline-flex;
        align-items: center;
        gap: .35rem;
    }
    .booking-status-badge::before{
        content:"";
        width:.5rem;
        height:.5rem;
        border-radius:999px;
        background: currentColor;
    }

    .booking-status-badge--pending {
        background: #fef3c7;
        color: #92400e;
        animation: statusPulse 1.8s ease-in-out infinite;
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
        animation: fadeInUp .35s ease-out;
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

    /* ===== KEYFRAMES ANIMASI HALUS ===== */
    @keyframes cardAppear {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes glowPulse {
        0%, 100% { box-shadow: 0 12px 30px rgba(56, 189, 248, .5); }
        50%      { box-shadow: 0 0 26px rgba(56, 189, 248, .9); }
    }

    @keyframes statusPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 rgba(250, 204, 21, 0); }
        50%      { transform: scale(1.03); box-shadow: 0 0 12px rgba(250, 204, 21, .55); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush


@section('content')
<div class="container py-5">
    <h1 class="page-title mb-3">Riwayat Booking</h1>

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

            // GANTI 'dokumen' kalau nama kolom lampiranmu beda (misal: 'lampiran', 'file_surat', dll)
            $hasLampiran = !empty($booking->dokumen);
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
                        @php
                            // Hitung jam selesai berdasarkan jam_mulai + (jumlah_sks * 50 menit)
                            $jamMulai = \Carbon\Carbon::parse($booking->tanggal . ' ' . $booking->jam_mulai);
                            $jamSelesai = $jamMulai->addMinutes($booking->jumlah_sks * 50);
                        @endphp
                        {{ $booking->jam_mulai }} - {{ $jamSelesai->format('H:i') }}
                    </span>
                </div>

                <div class="booking-meta-row">
                    <strong>Durasi:</strong>
                    <span class="value">
                        {{ $booking->jumlah_sks }} SKS ({{ $booking->jumlah_sks * 50 }} menit)
                    </span>
                </div>

                <div class="booking-purpose">
                    <strong>Keperluan:</strong>
                    <span class="value">{{ $booking->keperluan }}</span>
                </div>

                @if ($hasLampiran)
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
            Belum ada riwayat booking yang tercatat.
        </div>
    @endforelse
</div>
@endsection
