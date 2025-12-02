@extends('layouts.app')

@section('title', 'Daftar Ruangan - Ruangin.app')

@push('styles')
<style>
    .ruangan-header {
        background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(56,189,248,0.1) 100%);
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .ruangan-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
        -webkit-background-clip: text;
        color: transparent;
    }

    .type-section {
        margin-bottom: 3rem;
    }

    .type-header {
        font-size: 1.5rem;
        font-weight: 700;
        color: #e5e7eb;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
        border-bottom: 3px solid rgba(99,102,241,0.5);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .type-icon {
        font-size: 1.75rem;
    }

    .ruangan-card {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .ruangan-card:hover {
        border-color: rgba(148,163,184,0.6);
        background: radial-gradient(circle at top left, rgba(129,140,248,0.25), transparent 60%),
                    rgba(30,41,59,0.5);
        transform: translateY(-4px);
        box-shadow: 0 20px 50px rgba(129,140,248,0.2);
    }

    .ruangan-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #e5e7eb;
        margin-bottom: 1rem;
    }

    .ruangan-info {
        flex-grow: 1;
    }

    .ruangan-info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        font-size: 0.9rem;
        border-bottom: 1px solid rgba(148,163,184,0.15);
    }

    .ruangan-info-item:last-child {
        border-bottom: none;
    }

    .ruangan-label {
        color: #cbd5f5;
        font-weight: 600;
    }

    .ruangan-value {
        color: #e5e7eb;
        font-weight: 500;
    }

    .ruangan-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(56,189,248,0.3));
        border: 1px solid rgba(99,102,241,0.6);
        border-radius: 12px;
        color: #e5e7eb;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        margin-top: 1rem;
        cursor: pointer;
        width: 100%;
    }

    .ruangan-btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
        border-color: rgba(99,102,241,0.9);
        transform: translateY(-2px);
        color: #f9fafb;
        text-decoration: none;
    }

    .ruangan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #cbd5f5;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .back-btn {
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
        margin-bottom: 2rem;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(56,189,248,0.3));
        border-color: rgba(99,102,241,0.8);
        color: #f9fafb;
        text-decoration: none;
    }

    .filter-tabs {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 0.75rem 1.5rem;
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 12px;
        color: #cbd5f5;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .filter-tab:hover {
        background: rgba(30,41,59,0.7);
        border-color: rgba(99,102,241,0.6);
        color: #e5e7eb;
        text-decoration: none;
    }

    .filter-tab.active {
        background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
        border-color: rgba(99,102,241,0.9);
        color: #f9fafb;
    }

    .type-count {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
    }

    .no-ruangan-type {
        background: rgba(30,41,59,0.5);
        border: 1px dashed rgba(148,163,184,0.3);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        color: #cbd5f5;
    }
</style>
@endpush

@section('content')
<div class="ruangan-header">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <span>←</span> Kembali ke Dashboard
        </a>
        <h1 class="ruangan-title">📚 Daftar Ruangan Tersedia</h1>
        <p style="color: #cbd5f5; margin-top: 0.5rem;">Pilih ruangan yang ingin Anda pesan</p>
    </div>
</div>

<div class="container pb-5">
    {{-- Filter Tabs --}}
    @if ($allRuangans->count() > 0)
        <div class="filter-tabs">
            <a href="#semua" class="filter-tab active" onclick="scrollToType('semua'); return false;">
                📋 Semua Ruangan <span class="type-count">({{ $allRuangans->count() }})</span>
            </a>
            @foreach($ruanganByType->keys() as $type)
                @if($type)
                    <a href="#{{ str_replace(' ', '-', strtolower($type)) }}" 
                       class="filter-tab" 
                       onclick="scrollToType('{{ str_replace(' ', '-', strtolower($type)) }}'); return false;">
                        
                        @if(strtolower($type) === 'kelas')
                            🎓
                        @elseif(strtolower($type) === 'laboratorium')
                            🔬
                        @elseif(strtolower($type) === 'seminar')
                            📢
                        @elseif(strtolower($type) === 'meeting')
                            💼
                        @else
                            📌
                        @endif
                        
                        {{ $type }} <span class="type-count">({{ $ruanganByType[$type]->count() }})</span>
                    </a>
                @endif
            @endforeach
        </div>
    @endif

    {{-- Semua Ruangan --}}
    @if ($allRuangans->count() > 0)
        <div class="type-section" id="semua">
            <div class="type-header">
                <span class="type-icon">📋</span>
                Semua Ruangan ({{ $allRuangans->count() }})
            </div>
            <div class="ruangan-grid">
                @foreach ($allRuangans as $ruangan)
                    <div class="ruangan-card">
                        <h2 class="ruangan-name">{{ $ruangan->nama_ruang }}</h2>
                        
                        <div class="ruangan-info">
                            @if ($ruangan->kode_ruang)
                                <div class="ruangan-info-item">
                                    <span class="ruangan-label">Kode:</span>
                                    <span class="ruangan-value">{{ $ruangan->kode_ruang }}</span>
                                </div>
                            @endif

                            <div class="ruangan-info-item">
                                <span class="ruangan-label">Kapasitas:</span>
                                <span class="ruangan-value">👥 {{ $ruangan->kapasitas }} orang</span>
                            </div>

                            <div class="ruangan-info-item">
                                <span class="ruangan-label">Lokasi:</span>
                                <span class="ruangan-value">📍 {{ $ruangan->lokasi }}</span>
                            </div>

                            @if ($ruangan->tipe)
                                <div class="ruangan-info-item">
                                    <span class="ruangan-label">Tipe:</span>
                                    <span class="ruangan-value">{{ $ruangan->tipe }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <a href="{{ route('booking.create', ['id_ruangan' => $ruangan->id_ruangan]) }}" class="ruangan-btn">
                            <span>📄</span> Ajukan Peminjaman
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <p>Tidak ada ruangan yang tersedia saat ini</p>
        </div>
    @endif

    {{-- Ruangan Berdasarkan Tipe --}}
    @foreach($ruanganByType as $type => $ruangans)
        @if($type)
            <div class="type-section" id="{{ str_replace(' ', '-', strtolower($type)) }}">
                <div class="type-header">
                    <span class="type-icon">
                        @if(strtolower($type) === 'kelas')
                            🎓
                        @elseif(strtolower($type) === 'laboratorium')
                            🔬
                        @elseif(strtolower($type) === 'seminar')
                            📢
                        @elseif(strtolower($type) === 'meeting')
                            💼
                        @else
                            📌
                        @endif
                    </span>
                    {{ $type }} ({{ $ruangans->count() }})
                </div>
                <div class="ruangan-grid">
                    @forelse ($ruangans as $ruangan)
                        <div class="ruangan-card">
                            <h2 class="ruangan-name">{{ $ruangan->nama_ruang }}</h2>
                            
                            <div class="ruangan-info">
                                @if ($ruangan->kode_ruang)
                                    <div class="ruangan-info-item">
                                        <span class="ruangan-label">Kode:</span>
                                        <span class="ruangan-value">{{ $ruangan->kode_ruang }}</span>
                                    </div>
                                @endif

                                <div class="ruangan-info-item">
                                    <span class="ruangan-label">Kapasitas:</span>
                                    <span class="ruangan-value">👥 {{ $ruangan->kapasitas }} orang</span>
                                </div>

                                <div class="ruangan-info-item">
                                    <span class="ruangan-label">Lokasi:</span>
                                    <span class="ruangan-value">📍 {{ $ruangan->lokasi }}</span>
                                </div>

                                @if ($ruangan->keterangan)
                                    <div class="ruangan-info-item">
                                        <span class="ruangan-label">Keterangan:</span>
                                        <span class="ruangan-value">{{ Str::limit($ruangan->keterangan, 50) }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <a href="{{ route('booking.create', ['id_ruangan' => $ruangan->id_ruangan]) }}" class="ruangan-btn">
                                <span>📄</span> Ajukan Peminjaman
                            </a>
                        </div>
                    @empty
                        <div class="no-ruangan-type">
                            Tidak ada ruangan untuk tipe {{ $type }}
                        </div>
                    @endforelse
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
    function scrollToType(typeId) {
        const element = document.getElementById(typeId);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        
        // Update active filter tab
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        event.target.closest('.filter-tab').classList.add('active');
    }
</script>
@endsection
