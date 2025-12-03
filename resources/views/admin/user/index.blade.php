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
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
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
    <h2 style="font-size: 1.5rem; font-weight: 700; color: #e5e7eb; margin-bottom: 1.5rem;">Daftar User (Non-Admin)</h2>

    <!-- Search Form -->
    <div style="margin-bottom: 2rem;">
        <form method="GET" action="{{ route('admin.user.index') }}" style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <input type="text" name="search" placeholder="Cari berdasarkan nama..." 
                   value="{{ request('search') }}" 
                   style="flex: 1; min-width: 250px; padding: 0.6rem 1rem; background: rgba(30,41,59,0.5); border: 1px solid rgba(148,163,184,0.3); border-radius: 6px; color: #e5e7eb; font-size: 0.9rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.6rem 1.5rem;">🔍 Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary" style="padding: 0.6rem 1.5rem; background: rgba(148,163,184,0.3); border-color: rgba(148,163,184,0.5);">✕ Reset</a>
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
                            <th>Ubah Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><strong>{{ $user->nama }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 'mahasiswa')
                                        <span class="badge badge-mahasiswa">Mahasiswa</span>
                                    @elseif ($user->role === 'dosen')
                                        <span class="badge badge-dosen">Dosen</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.user.update-role', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                                            <select name="role" class="select-role">
                                                <option value="mahasiswa" {{ $user->role === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                                <option value="dosen" {{ $user->role === 'dosen' ? 'selected' : '' }}>Dosen</option>
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

        <!-- Pagination -->
        <div style="display: flex; justify-content: center; margin-top: 2rem;">
            {{ $users->links() }}
        </div>
    @else
        <div class="empty-state">
            <p>👤 Belum ada user selain admin</p>
        </div>
    @endif
</div>
@endsection
