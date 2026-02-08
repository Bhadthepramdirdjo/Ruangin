@extends('layouts.app')

@section('title', 'Laporan Bulanan - Admin')

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
    }

    .table-container {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th {
        background: rgba(15,23,42,0.95);
        color: #e5e7eb;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        border-bottom: 1px solid rgba(148,163,184,0.3);
    }

    table td {
        color: #cbd5f5;
        padding: 1rem;
        border-bottom: 1px solid rgba(148,163,184,0.2);
    }
    
    .filter-card {
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        gap: 1rem;
        align-items: flex-end;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #cbd5f5;
        font-size: 0.9rem;
    }

    .form-control-dark {
        background-color: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(148, 163, 184, 0.3);
        color: #e5e7eb;
        border-radius: 8px;
        padding: 0.6rem 1rem;
    }

    .btn-primary {
         background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
         color: white;
         border: 1px solid rgba(99,102,241,0.8);
         padding: 0.6rem 1.2rem;
         border-radius: 8px;
         text-decoration: none;
         font-weight: 600;
         display: inline-flex;
         align-items: center;
         gap: 0.5rem;
    }
    
    .btn-print {
        background: rgba(30, 41, 59, 0.6); 
        border: 1px solid rgba(148,163,184,0.4);
        color: #e5e7eb;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }
    .btn-print:hover {
        background: rgba(148,163,184,0.2);
    }

    .filter-controls {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-controls-buttons {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
        margin-left: auto;
    }
</style>
@endpush

@section('content')
<div class="admin-header">
    <div class="container">
        <h1 class="page-title">📈 Laporan Bulanan</h1>
        <p class="text-muted">Rekapitulasi peminjaman ruangan</p>
    </div>
</div>

<div class="container pb-5">
    @include('admin.partials.navigation')

    <!-- Filter Form -->
    <form action="{{ route('admin.laporan.index') }}" method="GET" class="filter-card">
        <div class="filter-controls">
            <div class="form-group">
                <label>Bulan</label>
                <select name="bulan" class="form-control-dark">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <select name="tahun" class="form-control-dark">
                    @for($i = date('Y'); $i >= date('Y')-5; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn-primary">Tampilkan</button>
        </div>

        <div class="filter-controls-buttons">
            <a href="{{ route('admin.laporan.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="btn-print">
                🖨️ Cetak
            </a>
        </div>
    </form>

    <h3 class="mb-3 text-white">1. Daftar Peminjaman Disetujui</h3>
    <div class="table-container">
        @if($laporanBooking->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Ruangan</th>
                    <th>Peminjam</th>
                    <th>Keperluan</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporanBooking as $index => $bg)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($bg->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $bg->ruangan->nama_ruang }}</td>
                    <td>
                        {{ $bg->user->nama }} <br>
                        <small class="text-muted">{{ $bg->user->role }}</small>
                    </td>
                    <td>{{ $bg->keperluan }}</td>
                    <td>
                        @php
                            $jamMulai = \Carbon\Carbon::parse($bg->tanggal . ' ' . $bg->jam_mulai);
                            $jamSelesai = $jamMulai->copy()->addMinutes($bg->jumlah_sks * 50);
                        @endphp
                        {{ $jamMulai->format('H:i') }} - {{ $jamSelesai->format('H:i') }} ({{ $bg->jumlah_sks }} SKS)
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="p-4 text-center text-muted">Tidak ada data peminjaman di bulan terpilih.</div>
        @endif
    </div>

    <h3 class="mb-3 text-white mt-5">2. Statistik Penggunaan Ruangan</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Ruangan</th>
                    <th>Kode</th>
                    <th>Kapasitas</th>
                    <th class="text-center">Total Peminjaman (Kali)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapRuangan as $ruangan)
                <tr>
                    <td><strong>{{ $ruangan->nama_ruang }}</strong></td>
                    <td>{{ $ruangan->kode_ruang }}</td>
                    <td>{{ $ruangan->kapasitas }} Orang</td>
                    <td class="text-center">
                        <span class="badge bg-info text-dark" style="font-size: 1rem; width: 40px;">
                            {{ $ruangan->bookings_count }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
