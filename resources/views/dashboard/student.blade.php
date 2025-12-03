@extends('layouts.app')

@section('title', 'Dashboard - Ruangin.app')

@push('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(56,189,248,0.1) 100%);
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .greeting-text {
        font-size: 1.8rem;
        font-weight: 700;
        color: #e5e7eb; /* Warna default */
    }

    /* Class baru khusus untuk efek warna gradasi pada teks */
    .text-gradient {
        background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .stat-card {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: rgba(148,163,184,0.6);
        background: radial-gradient(circle at top left, rgba(129,140,248,0.25), transparent 60%),
                    rgba(30,41,59,0.5);
        transform: translateY(-2px);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(120deg, #818cf8, #22d3ee);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .stat-label {
        color: #cbd5f5;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .quick-action-btn {
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
        cursor: pointer;
    }

    .quick-action-btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(56,189,248,0.3));
        border-color: rgba(99,102,241,0.8);
        transform: translateY(-2px);
        color: #f9fafb;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #e5e7eb;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(99,102,241,0.5);
    }

    .booking-item {
        background: rgba(30,41,59,0.5);
        border-left: 4px solid rgba(99,102,241,0.6);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .booking-item:hover {
        background: rgba(30,41,59,0.7);
        border-left-color: #818cf8;
    }

    .booking-room {
        font-weight: 600;
        color: #e5e7eb;
        font-size: 1rem;
    }

    .booking-time {
        color: #cbd5f5;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .booking-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    .status-pending {
        background: rgba(249,115,22,0.2);
        color: #fed7aa;
    }

    .status-approved {
        background: rgba(34,197,94,0.2);
        color: #86efac;
    }

    .status-rejected {
        background: rgba(239,68,68,0.2);
        color: #fca5a5;
    }

    .notification-box {
        background: radial-gradient(circle at top right, rgba(56,189,248,0.15), transparent 60%),
                    rgba(30,41,59,0.5);
        border-left: 4px solid #22d3ee;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .notification-box.warning {
        border-left-color: #f59e0b;
        background: radial-gradient(circle at top right, rgba(245,158,11,0.15), transparent 60%),
                    rgba(30,41,59,0.5);
    }

    .notification-box.success {
        border-left-color: #10b981;
        background: radial-gradient(circle at top right, rgba(16,185,129,0.15), transparent 60%),
                    rgba(30,41,59,0.5);
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: #9ca3af;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .frequent-room-card {
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .frequent-room-card:hover {
        border-color: rgba(99,102,241,0.6);
        background: rgba(30,41,59,0.7);
    }

    .room-name {
        font-weight: 600;
        color: #e5e7eb;
        margin-bottom: 0.5rem;
    }

    .room-count {
        color: #cbd5f5;
        font-size: 0.8rem;
    }

    .rules-box {
        background: rgba(30,41,59,0.4);
        border: 1px dashed rgba(148,163,184,0.3);
        border-radius: 8px;
        padding: 1rem;
        font-size: 0.85rem;
        color: #cbd5f5;
    }

    .rules-box ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .rules-box li {
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .greeting-text {
            font-size: 1.3rem;
        }

        .stat-number {
            font-size: 1.8rem;
        }

        .quick-action-btn {
            padding: 0.6rem 1rem;
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="greeting-text">
                    Selamat datang, <span class="text-gradient">{{ explode(' ', $user->nama)[0] }}!</span> 👋
                </h1>
                <p style="color: #cbd5f5; margin-top: 0.5rem;">{{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('ruangan.list') }}" class="quick-action-btn">
                    <span>➕</span> Buat Booking Baru
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    @if($notifications && count($notifications) > 0)
    <div class="row mb-4">
        <div class="col-12">
            @foreach($notifications as $notif)
            <div class="notification-box {{ $notif['type'] }}">
                {{ $notif['message'] }}
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-number">{{ $pendingBookings }}</div>
                <div class="stat-label">⏳ Menunggu Persetujuan</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-number">{{ $todayBookings }}</div>
                <div class="stat-label">📅 Booking Hari Ini</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-number">{{ $rejectedBookings }}</div>
                <div class="stat-label">❌ Ditolak</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-number">{{ $activeBookings }}</div>
                <div class="stat-label">✅ Aktif Mendatang</div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('ruangan.list') }}" class="quick-action-btn">
                    <span>➕</span> Buat Booking Baru
                </a>
                <a href="{{ route('booking.history') }}" class="quick-action-btn">
                    <span>📋</span> Riwayat Booking
                </a>
                <a href="#" class="quick-action-btn">
                    <span>📤</span> Upload Dokumen
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            @if($bookingsPending && count($bookingsPending) > 0)
            <div class="mb-5">
                <h2 class="section-title">⏳ Booking Menunggu Persetujuan</h2>
                @foreach($bookingsPending as $booking)
                <div class="booking-item">
                    <div class="booking-room">{{ $booking->ruangan->nama_ruang ?? 'Ruangan' }}</div>
                    <div class="booking-time">
                        📅 {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }} • 
                        🕐 {{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}
                    </div>
                    <span class="booking-status status-pending">Menunggu Persetujuan</span>
                </div>
                @endforeach
            </div>
            @endif

            @if($bookingsToday && count($bookingsToday) > 0)
            <div class="mb-5">
                <h2 class="section-title">📅 Booking Hari Ini</h2>
                @foreach($bookingsToday as $booking)
                <div class="booking-item" style="border-left-color: #10b981;">
                    <div class="booking-room">{{ $booking->ruangan->nama_ruang ?? 'Ruangan' }}</div>
                    <div class="booking-time">
                        🕐 {{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}
                    </div>
                    <div style="color: #86efac; font-size: 0.8rem; margin-top: 0.5rem;">
                        ✅ Sudah Disetujui - Siap Digunakan
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="mb-5">
                <h2 class="section-title">📅 Booking Hari Ini</h2>
                <div class="empty-state">
                    <div class="empty-state-icon">😴</div>
                    <p>Tidak ada booking untuk hari ini.</p>
                </div>
            </div>
            @endif

            @if($upcomingBookings && count($upcomingBookings) > 0)
            <div class="mb-5">
                <h2 class="section-title">📆 Jadwal Terdekat</h2>
                @foreach($upcomingBookings as $booking)
                <div class="booking-item">
                    <div class="booking-room">{{ $booking->ruangan->nama_ruang ?? 'Ruangan' }}</div>
                    <div class="booking-time">
                        📅 {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }} • 
                        🕐 {{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}
                    </div>
                    <span class="booking-status status-approved">Disetujui</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="col-lg-5">
            @if($frequentRoomDetails && count($frequentRoomDetails) > 0)
            <div class="mb-5">
                <h2 class="section-title">⭐ Ruangan Favorit</h2>
                <div class="row g-2">
                    @foreach($frequentRoomDetails as $room)
                    <div class="col-6">
                        <div class="frequent-room-card">
                            <div class="room-name">{{ $room->nama_ruang }}</div>
                            <div class="room-count">Digunakan {{ $room->count }}x</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="mb-5">
                <h2 class="section-title">📜 Riwayat Terbaru</h2>
                @if($recentBookings && count($recentBookings) > 0)
                @foreach($recentBookings->take(5) as $booking)
                <div class="booking-item" style="margin-bottom: 0.75rem;">
                    <div class="booking-room" style="font-size: 0.9rem;">
                        {{ $booking->ruangan->nama_ruang ?? 'Ruangan' }}
                    </div>
                    <div class="booking-time" style="font-size: 0.8rem;">
                        {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}
                    </div>
                    <span class="booking-status" style="
                        @if($booking->status === 'pending') background: rgba(249,115,22,0.2); color: #fed7aa;
                        @elseif($booking->status === 'disetujui') background: rgba(34,197,94,0.2); color: #86efac;
                        @elseif($booking->status === 'ditolak') background: rgba(239,68,68,0.2); color: #fca5a5;
                        @endif
                    ">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
                @endforeach
                @else
                <div class="empty-state" style="padding: 1rem;">
                    <p>Belum ada riwayat booking.</p>
                </div>
                @endif
            </div>

            <div class="rules-box">
                <strong style="color: #e5e7eb; display: block; margin-bottom: 0.75rem;">📋 Info Penting</strong>
                <ul>
                    <li><strong>Jam Operasional:</strong> 07:00 - 18:00 WIB</li>
                    <li><strong>Batas Booking:</strong> Max 2 minggu sebelumnya</li>
                    <li><strong>Dokumen:</strong> Wajib untuk booking lab</li>
                    <li><strong>Konfirmasi Admin:</strong> 1-2 hari kerja</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection