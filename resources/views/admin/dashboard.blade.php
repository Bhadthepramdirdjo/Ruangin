@extends('layouts.app')

@section('title', 'Dashboard Admin - Command Center')

@push('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, rgba(99,102,241,0.15) 0%, rgba(56,189,248,0.15) 100%);
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .page-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #f9fafb;          /* teks utama putih */
    margin-bottom: 0.5rem;
}

/* Bagian yang warnanya mirip "Tersedia" */
.page-title-highlight {
    background-image: linear-gradient(90deg, #38bdf8, #22d3ee);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}


    .greeting-text {
        color: #cbd5e1;
        font-size: 0.95rem;
    }

    .nav-admin {
        display: flex;
        gap: 0;
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(148,163,184,0.2);
        flex-wrap: wrap;
    }

    .nav-admin a {
        padding: 1rem 1.5rem;
        color: #cbd5e1;
        text-decoration: none;
        font-weight: 600;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-admin a.active {
        color: #22d3ee;
        border-bottom-color: #22d3ee;
    }

    .nav-admin a:hover {
        color: #e5e7eb;
    }

    .stat-card {
        background: radial-gradient(circle at top right, rgba(99,102,241,0.2), transparent 70%),
                    rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 14px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(99,102,241,0.1), transparent);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .stat-card:hover {
        border-color: rgba(99,102,241,0.6);
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(99,102,241,0.15);
    }

    .stat-icon {
        font-size: 2.5rem;
        position: relative;
        z-index: 1;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(120deg, #c7d2fe, #a5f3fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .stat-label {
        color: #cbd5e1;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .stat-subtitle {
        color: #64748b;
        font-size: 0.8rem;
    }

    .grid-6 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .section-container {
        margin-bottom: 2.5rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-section {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.25rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.4), rgba(56,189,248,0.4));
        border: 1px solid rgba(99,102,241,0.6);
        border-radius: 8px;
        color: #bfdbfe;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-section:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.6), rgba(56,189,248,0.6));
        border-color: rgba(99,102,241,0.8);
    }

    .task-card {
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .task-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .task-item {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(148,163,184,0.15);
        align-items: flex-start;
    }

    .task-item:last-child {
        border-bottom: none;
    }

    .task-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        background: rgba(251, 146, 60, 0.2);
        border: 1px solid rgba(251, 146, 60, 0.5);
        border-radius: 50%;
        color: #fed7aa;
        font-weight: 700;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .task-content {
        flex: 1;
    }

    .task-title {
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .task-desc {
        color: #cbd5e1;
        font-size: 0.85rem;
    }

    .quick-action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem;
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        color: #e5e7eb;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
    }

    .quick-action-btn:hover {
        background: rgba(99,102,241,0.2);
        border-color: rgba(99,102,241,0.5);
        color: #c7d2fe;
        transform: translateY(-4px);
    }

    .quick-action-icon {
        font-size: 2rem;
    }

    .table-container {
        background: rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 1.5rem;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: rgba(15,23,42,0.5);
        color: #cbd5e1;
        font-weight: 600;
        padding: 0.85rem;
        text-align: left;
        border-bottom: 1px solid rgba(148,163,184,0.3);
        font-size: 0.85rem;
    }

    td {
        color: #e5e7eb;
        padding: 0.85rem;
        border-bottom: 1px solid rgba(148,163,184,0.2);
        font-size: 0.85rem;
    }

    tr:hover td {
        background: rgba(99,102,241,0.08);
    }

    .badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-pending {
        background: rgba(251, 146, 60, 0.2);
        color: #fed7aa;
        border: 1px solid rgba(251, 146, 60, 0.5);
    }

    .badge-disetujui {
        background: rgba(34,197,94,0.2);
        color: #86efac;
        border: 1px solid rgba(34,197,94,0.5);
    }

    .badge-ditolak {
        background: rgba(239,68,68,0.2);
        color: #fca5a5;
        border: 1px solid rgba(239,68,68,0.5);
    }

    .badge-baru {
        background: rgba(59,130,246,0.2);
        color: #bfdbfe;
        border: 1px solid rgba(59,130,246,0.5);
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.4rem 0.8rem;
        background: rgba(99,102,241,0.3);
        border: 1px solid rgba(99,102,241,0.5);
        border-radius: 6px;
        color: #bfdbfe;
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-action:hover {
        background: rgba(99,102,241,0.5);
        color: #dbeafe;
    }

    .empty-message {
        text-align: center;
        padding: 2rem;
        color: #94a3b8;
    }

    .alert-info {
        background: rgba(99,102,241,0.1);
        border: 1px solid rgba(99,102,241,0.3);
        border-radius: 8px;
        padding: 1rem;
        color: #bfdbfe;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.75rem;
        }

        .grid-6 {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .grid-2 {
            grid-template-columns: 1fr;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        table {
            font-size: 0.75rem;
        }

        th, td {
            padding: 0.5rem;
        }
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .table-avatar {
        width: 32px; /* Sedikit lebih kecil agar pas di dashboard */
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(168, 85, 247, 0.5);
    }

    .table-avatar-fallback {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #a855f7, #22d3ee);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
        border: 2px solid rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <div class="container">
       <h1 class="page-title">
    🛡️ Admin <span class="page-title-highlight">Command Center</span>
</h1>

    </div>
</div>

<div class="container pb-5">
    @include('admin.partials.navigation')

    <!-- Alert Info -->
    @if($pendingBooking > 0 || $newUsers > 0)
        <div class="alert-info">
            ⚠️ Ada {{ $pendingBooking }} booking menunggu persetujuan dan {{ $newUsers }} user baru yang perlu diverifikasi
        </div>
    @endif

    <!-- QUICK ACTIONS -->
    <div class="section-container">
        <h2 class="section-title">⚡ Aksi Cepat</h2>
        <div class="quick-action-grid">
            <a href="{{ route('admin.ruangan.create') }}" class="quick-action-btn">
                <div class="quick-action-icon">➕</div>
                <div>Tambah Ruangan</div>
            </a>
            <a href="{{ route('admin.booking.index') }}" class="quick-action-btn">
                <div class="quick-action-icon">✓</div>
                <div>Setujui Booking</div>
            </a>
            <a href="{{ route('admin.user.index') }}" class="quick-action-btn">
                <div class="quick-action-icon">👤</div>
                <div>Verifikasi User</div>
            </a>
            <a href="{{ route('admin.booking.index', ['status' => 'pending']) }}" class="quick-action-btn">
                <div class="quick-action-icon">📋</div>
                <div>Lihat Pending</div>
            </a>
        </div>
    </div>

    <!-- OVERVIEW STATISTICS -->
    <div class="section-container">
        <h2 class="section-title">📊 Ringkasan Sistem</h2>
        <div class="grid-6">
            <div class="stat-card">
                <div class="stat-icon">🏛️</div>
                <div class="stat-number">{{ $totalRuangan }}</div>
                <div class="stat-label">Total Ruangan</div>
                <div class="stat-subtitle">{{ $ruanganAktif }} aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-number">{{ $totalUser }}</div>
                <div class="stat-label">Total User</div>
                <div class="stat-subtitle">{{ $newUsers }} baru</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-number">{{ $pendingBooking }}</div>
                <div class="stat-label">Booking Pending</div>
                <div class="stat-subtitle">perlu dikerjakan</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✓</div>
                <div class="stat-number">{{ $bookingHariIni }}</div>
                <div class="stat-label">Booking Hari Ini</div>
                <div class="stat-subtitle">{{ $approvedBooking }} disetujui</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-number">{{ $totalBooking }}</div>
                <div class="stat-label">Total Booking</div>
                <div class="stat-subtitle">semua waktu</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-number">{{ $bookingDenganDokumen }}</div>
                <div class="stat-label">Dokumen</div>
                <div class="stat-subtitle">perlu divalidasi</div>
            </div>
        </div>
    </div>

    <!-- TASKS & NOTIFICATIONS -->
    <div class="grid-2">
        <!-- Booking Menunggu -->
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">⏳ Booking Menunggu Persetujuan</h2>
                <a href="{{ route('admin.booking.index', ['status' => 'pending']) }}" class="btn-section">Lihat Semua</a>
            </div>
            <div class="task-card">
                @if($bookingPending->count() > 0)
                    <ul class="task-list">
                        @foreach($bookingPending->take(5) as $booking)
                            <li class="task-item">
                                <div class="task-badge">{{ $loop->index + 1 }}</div>
                                <div class="task-content">
                                    <div class="task-title">{{ $booking->ruangan->nama_ruang }}</div>
                                    <div class="task-desc">
                                        Oleh <strong>{{ $booking->user->nama }}</strong><br>
                                        📅 {{ $booking->tanggal }} - {{ $booking->jam_mulai }} s/d {{ $booking->jam_selesai }}
                                    </div>
                                    <a href="{{ route('admin.booking.show', $booking->id) }}" class="btn-action" style="margin-top: 0.5rem;">Tinjau</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="empty-message">✓ Tidak ada booking yang menunggu</div>
                @endif
            </div>
        </div>

        <!-- User Baru -->
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">👤 User Baru</h2>
                <a href="{{ route('admin.user.index') }}" class="btn-section">Lihat Semua</a>
            </div>
            <div class="task-card">
                @if($userBaru->count() > 0)
                    <ul class="task-list">
                        @foreach($userBaru->take(5) as $user)
                            <li class="task-item">
                                <div class="task-badge">{{ $loop->index + 1 }}</div>
                                <div class="task-content">
                                    <div class="task-title">{{ $user->nama }}</div>
                                    <div class="task-desc">
                                        <strong>{{ $user->email }}</strong><br>
                                        Role: <span class="badge badge-baru">{{ $user->role }}</span>
                                    </div>
                                    <a href="{{ route('admin.user.index') }}" class="btn-action" style="margin-top: 0.5rem;">Kelola Role</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="empty-message">✓ Tidak ada user baru</div>
                @endif
            </div>
        </div>
    </div>

    <!-- RECENT BOOKINGS TABLE -->
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">📋 Booking Terbaru (Top 10)</h2>
            <a href="{{ route('admin.booking.index') }}" class="btn-section">Lihat Semua</a>
        </div>
        <div class="table-container">
            @if($recentBookings->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Ruangan</th>
                            <th>Peminjam</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings->take(10) as $booking)
                            <tr>
                                <td><strong>{{ $booking->ruangan->nama_ruang }}</strong></td>

                                <td>
                                    <div class="user-info">
                                        @if($booking->user && $booking->user->avatar)
                                            <img src="{{ str_starts_with($booking->user->avatar, 'http') ? $booking->user->avatar : asset('storage/' . $booking->user->avatar) }}"
                                                alt="Avatar" class="table-avatar">
                                        @else
                                            <div class="table-avatar-fallback">
                                                {{ substr($booking->user->nama ?? 'U', 0, 1) }}
                                            </div>
                                        @endif
                                        <span>{{ $booking->user->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                                <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>

                                <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $booking->keperluan }}
                                </td>
                                <td>
                                    @if($booking->status === 'pending')
                                        <span class="badge badge-pending">⏳ Pending</span>
                                    @elseif($booking->status === 'disetujui')
                                        <span class="badge badge-disetujui">✓ Disetujui</span>
                                    @else
                                        <span class="badge badge-ditolak">✕ Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.booking.show', $booking->id) }}" class="btn-action">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-message">Tidak ada booking</div>
            @endif
        </div>
    </div>

    <!-- ROOMS STATUS -->
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">🏛️ Status Ruangan</h2>
            <a href="{{ route('admin.ruangan.index') }}" class="btn-section">Kelola Ruangan</a>
        </div>
        <div class="table-container">
            @if($ruanganList->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Kode</th>
                            <th>Kapasitas</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Booking Hari Ini</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ruanganList->take(8) as $ruangan)
                            <tr>
                                <td><strong>{{ $ruangan->nama_ruang }}</strong></td>
                                <td><code style="background: rgba(99,102,241,0.2); padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $ruangan->kode_ruang }}</code></td>
                                <td>{{ $ruangan->kapasitas }} orang</td>
                                <td>
                                    <span class="badge" style="background: rgba(99,102,241,0.2); color: #c7d2fe; border: 1px solid rgba(99,102,241,0.5);">
                                        {{ ucfirst($ruangan->tipe) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge" style="background: {{ $ruangan->status === 'aktif' ? 'rgba(34,197,94,0.2)' : 'rgba(239,68,68,0.2)' }}; color: {{ $ruangan->status === 'aktif' ? '#86efac' : '#fca5a5' }}; border: 1px solid {{ $ruangan->status === 'aktif' ? 'rgba(34,197,94,0.5)' : 'rgba(239,68,68,0.5)' }};">
                                        {{ $ruangan->status === 'aktif' ? '✓ Aktif' : '✕ Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <strong>{{ $ruangan->bookingHariIni ?? 0 }}</strong> booking
                                </td>
                                <td>
                                    <a href="{{ route('admin.ruangan.edit', $ruangan->id) }}" class="btn-action">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-message">Tidak ada ruangan</div>
            @endif
        </div>
    </div>

    <!-- QUICK STATS FOOTER -->
    <div class="section-container" style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(148,163,184,0.2);">
        <p style="color: #64748b; font-size: 0.85rem; text-align: center;">
            Last updated: <strong>{{ now()->format('H:i:s') }}</strong> |
            Refresh untuk mendapatkan data terbaru
        </p>
    </div>
</div>
@endsection
