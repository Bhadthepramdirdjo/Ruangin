@extends('layouts.app')

@section('title', 'Kelola Ruangan - Admin')

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

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .btn-create {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, rgba(34,197,94,0.5), rgba(16,185,129,0.5));
        border: 1px solid rgba(34,197,94,0.8);
        border-radius: 12px;
        color: #e5e7eb;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-create:hover {
        background: linear-gradient(135deg, rgba(34,197,94,0.7), rgba(16,185,129,0.7));
        border-color: rgba(34,197,94,1);
        color: #f9fafb;
    }

    .nav-admin {
        display: flex;
        gap: 0;
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(148,163,184,0.2);
    }

    .nav-admin a {
        padding: 1rem 1.5rem;
        color: #cbd5e1;
        text-decoration: none;
        font-weight: 600;
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-admin a.active {
        color: #22d3ee;
        border-bottom-color: #22d3ee;
    }

    .nav-admin a:hover {
        color: #e5e7eb;
    }

    .table-container {
        background: rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 1.5rem;
        overflow-x: auto;
    }

    .table-wrapper {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: rgba(15,23,42,0.5);
        color: #cbd5e1;
        font-weight: 600;
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid rgba(148,163,184,0.3);
        font-size: 0.9rem;
    }

    td {
        color: #e5e7eb;
        padding: 1rem;
        border-bottom: 1px solid rgba(148,163,184,0.2);
        font-size: 0.9rem;
    }

    tr:hover td {
        background: rgba(99,102,241,0.1);
    }

    .badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-aktif {
        background: rgba(34,197,94,0.2);
        color: #86efac;
        border: 1px solid rgba(34,197,94,0.5);
    }

    .badge-nonaktif {
        background: rgba(239,68,68,0.2);
        color: #fca5a5;
        border: 1px solid rgba(239,68,68,0.5);
    }

    .badge-kelas {
        background: rgba(99,102,241,0.2);
        color: #c7d2fe;
        border: 1px solid rgba(99,102,241,0.5);
    }

    .badge-laboratorium {
        background: rgba(168,85,247,0.2);
        color: #e9d5ff;
        border: 1px solid rgba(168,85,247,0.5);
    }

    .badge-seminar {
        background: rgba(59,130,246,0.2);
        color: #bfdbfe;
        border: 1px solid rgba(59,130,246,0.5);
    }

    .badge-meeting {
        background: rgba(236,72,153,0.2);
        color: #fbcfe8;
        border: 1px solid rgba(236,72,153,0.5);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-sm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.25rem;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-sm-edit {
        background: rgba(59,130,246,0.3);
        color: #bfdbfe;
        border: 1px solid rgba(59,130,246,0.5);
    }

    .btn-sm-edit:hover {
        background: rgba(59,130,246,0.5);
        color: #dbeafe;
    }

    .btn-sm-delete {
        background: rgba(239,68,68,0.3);
        color: #fca5a5;
        border: 1px solid rgba(239,68,68,0.5);
    }

    .btn-sm-delete:hover {
        background: rgba(239,68,68,0.5);
        color: #fecaca;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #94a3b8;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .nav-admin {
            flex-wrap: wrap;
        }

        .nav-admin a {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }

        table {
            font-size: 0.8rem;
        }

        th, td {
            padding: 0.75rem 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-sm {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <div class="container">
        <div class="header-content">
            <h1 class="page-title">🏛️ Kelola Ruangan</h1>
            <a href="{{ route('admin.ruangan.create') }}" class="btn-create">+ Tambah Ruangan Baru</a>
        </div>
    </div>
</div>

<div class="container pb-5">
    @include('admin.partials.navigation')

    @if ($ruangans->count() > 0)
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 20%;">Nama Ruangan</th>
                            <th style="width: 12%;">Kode</th>
                            <th style="width: 12%;">Kapasitas</th>
                            <th style="width: 15%;">Tipe</th>
                            <th style="width: 12%;">Status</th>
                            <th style="width: 29%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangans as $item)
                            <tr>
                                <td style="font-weight: 600;">{{ $item->nama_ruang }}</td>
                                <td><code style="background: rgba(99,102,241,0.2); padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $item->kode_ruang }}</code></td>
                                <td>{{ $item->kapasitas }} orang</td>
                                <td>
                                    <span class="badge badge-{{ $item->tipe }}">{{ ucfirst($item->tipe) }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $item->status }}">
                                        @if ($item->status === 'aktif')
                                            ✓ Aktif
                                        @else
                                            ✕ Nonaktif
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons" style="justify-content: center;">
                                        <a href="{{ route('admin.ruangan.edit', $item->id) }}" class="btn-sm btn-sm-edit">✏️ Edit</a>
                                        <form action="{{ route('admin.ruangan.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-sm-delete">🗑️ Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="table-container">
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <p style="font-size: 1.1rem; margin-bottom: 1rem;">Belum ada ruangan</p>
                <a href="{{ route('admin.ruangan.create') }}" class="btn-create">+ Tambah Ruangan Pertama</a>
            </div>
        </div>
    @endif
</div>
@endsection
