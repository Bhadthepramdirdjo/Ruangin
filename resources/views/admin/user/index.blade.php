@extends('layouts.app')

@section('title', 'Manajemen User - Admin')

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

    .table-container {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        overflow: hidden;
    }

    .table-wrapper {
        max-height: 460px;                 /* tinggi area tabel */
        overflow-y: auto;
        overflow-x: auto;
        scrollbar-width: thin;
        scrollbar-color: #64748b #020617;
    }

    .table-wrapper::-webkit-scrollbar {
        height: 8px;
        width: 8px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: #020617;
        border-radius: 999px;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: #64748b;
        border-radius: 999px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table thead {
        background: rgba(30,41,59,0.6);
        border-bottom: 1px solid rgba(148,163,184,0.3);
    }

    table thead th {
        position: sticky;
        top: 0;
        z-index: 5;
        background: rgba(15,23,42,0.96);
        backdrop-filter: blur(4px);
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

    .badge-mahasiswa {
        background: rgba(99,102,241,0.15);
        color: #a5b4fc;
    }

    .badge-dosen {
        background: rgba(139,92,246,0.15);
        color: #d8b4fe;
    }

    .select-role {
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 6px;
        color: #e5e7eb;
        padding: 0.4rem 0.6rem;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.8rem;
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
        .btn-verify-success {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: 1px solid #16a34a;
        color: #ecfdf5;
        box-shadow: 0 10px 24px rgba(34,197,94,0.45);
    }

    .btn-verify-success:hover {
        filter: brightness(1.05);
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(22,163,74,0.65);
        color: #f0fdf4;
    }

    .btn-verify-pending {
        background: linear-gradient(135deg, #fb923c, #f97316);
        border: 1px solid #f97316;
        color: #fff7ed;
        box-shadow: 0 10px 24px rgba(248,153,51,0.5);
    }

    .btn-verify-pending:hover {
        filter: brightness(1.05);
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(248,153,51,0.75);
        color: #fffbeb;
    }


    .btn-primary:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.7), rgba(56,189,248,0.7));
        color: #f9fafb;
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
        gap: 0.75rem;
    }

    .table-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(168, 85, 247, 0.5);
    }

    .table-avatar-fallback {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #a855f7, #22d3ee);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1rem;
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    /* ====== PAGINATION KUSTOM RUANGIN ====== */
    .pagination-ruangin {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 0.8rem;
        border-radius: 999px;
        background: rgba(15,23,42,0.9);
        border: 1px solid rgba(148,163,184,0.35);
        box-shadow: 0 14px 35px rgba(15,23,42,0.9);
        animation: fadeInUp .3s ease-out;
    }

    .page-arrow,
    .page-dot {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        outline: none;
        text-decoration: none;
        cursor: pointer;
        transition: all .18s ease-out;
    }

    .page-arrow {
        background: radial-gradient(circle at top, #1e293b, #020617);
        color: #e5e7eb;
    }
    .page-arrow:hover:not(.disabled) {
        transform: translateY(-1px) scale(1.03);
        box-shadow: 0 0 14px rgba(96,165,250,0.65);
        color: #bfdbfe;
    }
    .page-arrow.disabled {
        opacity: .3;
        cursor: default;
    }

    .page-dot {
        background: transparent;
        color: #cbd5f5;
        border: 1px solid transparent;
    }
    .page-dot:hover {
        border-color: rgba(148,163,184,0.6);
        background: rgba(15,23,42,0.9);
    }
    .page-dot.active {
        background: radial-gradient(circle at top, #38bdf8, #6366f1);
        color: #0b1120;
        box-shadow: 0 0 18px rgba(56,189,248,0.85);
        animation: pulseGlow 2s ease-in-out infinite;
    }

    /* Animasi halus */
    @keyframes pulseGlow {
        0%,100% { transform: scale(1); box-shadow: 0 0 16px rgba(56,189,248,0.7); }
        50%     { transform: scale(1.06); box-shadow: 0 0 26px rgba(56,189,248,1); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <div class="container">
        <h1 class="page-title">👥 Manajemen User</h1>
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

    <!-- Header -->
    <h2 style="font-size: 1.5rem; font-weight: 700; color: #e5e7eb; margin-bottom: 1.5rem;">
        Daftar User (Non-Admin)
    </h2>

    <!-- Search Form -->
    <div style="margin-bottom: 2rem;">
        <form method="GET" action="{{ route('admin.user.index') }}"
              style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <input type="text" name="search" placeholder="Cari berdasarkan nama..."
                   value="{{ request('search') }}"
                   style="flex: 1; min-width: 250px; padding: 0.6rem 1rem;
                          background: rgba(30,41,59,0.5);
                          border: 1px solid rgba(148,163,184,0.3);
                          border-radius: 6px; color: #e5e7eb; font-size: 0.9rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.6rem 1.5rem;">
                🔍 Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.user.index') }}"
                   class="btn btn-primary"
                   style="padding: 0.6rem 1.5rem;
                          background: rgba(148,163,184,0.3);
                          border-color: rgba(148,163,184,0.5);">
                    ✕ Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    @if ($users->count() > 0)
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role Saat Ini</th>
                            <th>Verifikasi</th>
                            <th>Ubah Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                 alt="Avatar" class="table-avatar">
                                        @else
                                            <div class="table-avatar-fallback">
                                                {{ substr($user->nama, 0, 1) }}
                                            </div>
                                        @endif

                                        <strong>{{ $user->nama }}</strong>
                                    </div>
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @if ($user->role === 'mahasiswa')
                                        <span class="badge badge-mahasiswa">Mahasiswa</span>
                                    @elseif ($user->role === 'dosen')
                                        <span class="badge badge-dosen">Dosen</span>
                                    @endif
                                </td>

                               <td>
                                    @if ($user->role === 'dosen')
                                        @if ($user->is_verified)
                                            <form action="{{ route('admin.user.verify', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_verified" value="0">
                                                <button class="btn btn-verify-success">
                                                    Terverifikasi
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.user.verify', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_verified" value="1">
                                                <button class="btn btn-verify-pending">
                                                    Verifikasi
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>


                                <td>
                                    <form action="{{ route('admin.user.update-role', $user->id) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                                            <select name="role" class="select-role">
                                                <option value="mahasiswa" {{ $user->role === 'mahasiswa' ? 'selected' : '' }}>
                                                    Mahasiswa
                                                </option>
                                                <option value="dosen" {{ $user->role === 'dosen' ? 'selected' : '' }}>
                                                    Dosen
                                                </option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination kustom -->
        @if ($users->hasPages())
            <div style="display: flex; justify-content: center; margin-top: 2rem;">
                <div class="pagination-ruangin">
                    {{-- Previous --}}
                    @if ($users->onFirstPage())
                        <span class="page-arrow disabled">❮</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="page-arrow">❮</a>
                    @endif

                    {{-- Page numbers --}}
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
                            <span class="page-dot active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-dot">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="page-arrow">❯</a>
                    @else
                        <span class="page-arrow disabled">❯</span>
                    @endif
                </div>
            </div>
        @endif
    @else
        <div class="empty-state">
            <p>👤 Belum ada user selain admin</p>
        </div>
    @endif
</div>
@endsection
