@extends('layouts.app')

@section('title', 'Manajemen Booking - Admin')

@push('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(56,189,248,0.1) 100%);
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

   .page-title {
    font-size: 2.2rem;
    font-weight: 800;
    letter-spacing: .02em;
    color: #e5e7eb;
    background: none;
    -webkit-background-clip: initial;
    -webkit-text-fill-color: initial;
}

    .nav-admin {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .nav-admin a {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        color: #cbd5f5;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .nav-admin a:hover {
        background: rgba(30,41,59,0.7);
        border-color: rgba(99,102,241,0.6);
        color: #e5e7eb;
    }

    .nav-admin a.active {
        background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
        border-color: rgba(99,102,241,0.9);
        color: #f9fafb;
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 0.6rem 1.2rem;
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 8px;
        color: #cbd5f5;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-tab:hover {
        background: rgba(30,41,59,0.7);
        border-color: rgba(99,102,241,0.6);
    }

    .filter-tab.active {
        background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
        border-color: rgba(99,102,241,0.9);
        color: #f9fafb;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
        border: 1px solid rgba(99,102,241,0.8);
        color: #e5e7eb;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.7), rgba(56,189,248,0.7));
        color: #f9fafb;
    }

    .btn-success {
        background: rgba(16,185,129,0.2);
        border: 1px solid rgba(16,185,129,0.5);
        color: #10b981;
    }

    .btn-danger {
        background: rgba(239,68,68,0.2);
        border: 1px solid rgba(239,68,68,0.5);
        color: #ef4444;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }

    .table-container {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        overflow: hidden;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table thead {
        background: rgba(30,41,59,0.6);
        border-bottom: 1px solid rgba(148,163,184,0.3);
    }

    table th {
        color: #e5e7eb;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.9rem;
    }

    table td {
        color: #cbd5f5;
        padding: 1rem;
        border-bottom: 1px solid rgba(148,163,184,0.2);
    }

    table tbody tr:hover {
        background: rgba(129,140,248,0.08);
    }

    .badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
        font-size: 0.8rem;
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

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.3);
        color: #10b981;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #cbd5f5;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem; /* Jarak antara foto dan nama */
    }

    .table-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(168, 85, 247, 0.5); /* Border ungu tipis */
    }

    .table-avatar-fallback {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #a855f7, #22d3ee);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.85rem;
        border: 2px solid rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <div class="container">
        <h1 class="page-title">📋 Manajemen Booking</h1>
    </div>
</div>

<div class="container pb-5">
    @include('admin.partials.navigation')

    <!-- Alert -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <a href="{{ route('admin.booking.index') }}" class="filter-tab {{ is_null($status) ? 'active' : '' }}">
            Semua ({{ $bookings->total() }})
        </a>
        @foreach($statuses as $s)
            <a href="{{ route('admin.booking.index', ['status' => $s]) }}" class="filter-tab {{ $status === $s ? 'active' : '' }}">
                {{ ucfirst($s) }}
            </a>
        @endforeach
    </div>

    <!-- Table -->
    @if ($bookings->count() > 0)
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Ruangan</th>
                            <th>User</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td><strong>{{ $booking->ruangan->nama_ruang ?? '-' }}</strong></td>
                                
                                <td>
                                    <div class="user-info">
                                        @if($booking->user && $booking->user->avatar)
                                            <img src="{{ asset('storage/' . $booking->user->avatar) }}" 
                                                alt="Avatar" class="table-avatar">
                                        @else
                                            <div class="table-avatar-fallback">
                                                {{ substr($booking->user->nama ?? 'U', 0, 1) }}
                                            </div>
                                        @endif
                                        
                                        <div>
                                            <div style="font-weight: 600; color: #e5e7eb;">
                                                {{ $booking->user->nama ?? '-' }}
                                            </div>
                                            <div style="font-size: 0.75rem; color: #94a3b8;">
                                                {{ $booking->user->role ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}</td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->jam_mulai)->format('H:i') ?? $booking->jam_mulai }} - 
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->jam_selesai)->format('H:i') ?? $booking->jam_selesai }}
                                </td>
                                <td>
                                    @if ($booking->status === 'pending')
                                        <span class="badge badge-pending">Pending</span>
                                    @elseif ($booking->status === 'disetujui')
                                        <span class="badge badge-approved">Disetujui</span>
                                    @else
                                        <span class="badge badge-rejected">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.booking.show', $booking->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: center; margin-top: 2rem;">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="empty-state">
            <p>📭 Belum ada booking</p>
        </div>
    @endif
</div>
@endsection
