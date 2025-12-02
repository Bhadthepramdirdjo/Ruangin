@extends('layouts.app')

@section('title', 'Data Ruangan - Ruangin.app')

@section('content')
<div class="container">
    <h2 class="section-title mb-3" style="font-size:1.8rem;">Data Ruangan Kampus</h2>
    <p class="section-subtitle mb-4">
        Daftar ruang kelas, laboratorium, dan ruang rapat yang tersedia di Ruangin.app.
    </p>

    <div class="card card-glass mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-0">Daftar Ruangan</h5>
                <small class="text-muted">Total: {{ $ruangan->count() }} ruangan</small>
            </div>
            <a href="#" class="gradient-btn btn-sm">
                + Tambah Ruangan
            </a>
        </div>
    </div>

    <div class="card card-glass">
        <div class="card-body">
            @if ($ruangan->isEmpty())
                <p class="text-muted mb-0">Belum ada data ruangan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0" style="background:#020617;border-radius:12px;overflow:hidden;">
                        <thead style="background:rgba(15,23,42,0.95);">
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama Ruangan</th>
                                <th>Lokasi</th>
                                <th>Kapasitas</th>
                                <th>Fasilitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ruangan as $index => $r)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="badge bg-primary">{{ $r->kode_ruang }}</span></td>
                                    <td>{{ $r->nama_ruang }}</td>
                                    <td>{{ $r->lokasi }}</td>
                                    <td>{{ $r->kapasitas }}</td>
                                    <td>{{ $r->fasilitas }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="#" class="btn btn-outline-secondary">Edit</a>
                                            <a href="#" class="btn btn-outline-danger">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
