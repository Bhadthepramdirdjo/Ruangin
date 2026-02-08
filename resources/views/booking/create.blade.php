@extends('layouts.app')

@section('title', 'Ajukan Peminjaman - ' . $ruangan->nama_ruang)

@push('styles')
<style>
    .booking-header {
        background: linear-gradient(135deg, rgba(99,102,241,0.1) 0%, rgba(56,189,248,0.1) 100%);
        border-bottom: 1px solid rgba(148,163,184,0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .booking-title {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
        -webkit-background-clip: text;
        color: transparent;
    }

    .booking-form-container {
        background: radial-gradient(circle at top left, rgba(129,140,248,0.15), transparent 60%),
                    rgba(30,41,59,0.4);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 16px;
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .ruangan-info-box {
        background: rgba(30,41,59,0.5);
        border-left: 4px solid rgba(99,102,241,0.6);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .ruangan-info-box .label {
        color: #cbd5f5;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .ruangan-info-box .value {
        color: #e5e7eb;
        font-size: 1.25rem;
        font-weight: 600;
        margin-top: 0.25rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }

    .form-control {
        background: rgba(30,41,59,0.5);
        border: 1px solid rgba(148,163,184,0.3);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        color: #e5e7eb;
        font-size: 0.9rem;
        width: 100%;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        background: rgba(30,41,59,0.6);
        border-color: rgba(99,102,241,0.6);
        color: #f9fafb;
        outline: none;
        box-shadow: 0 0 20px rgba(99,102,241,0.2);
    }

    .form-control::placeholder {
        color: #64748b;
    }

    .form-error {
        color: #f87171;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    /* TIME SLOT STYLES */
    .time-slots-wrapper {
        background: rgba(30,41,59,0.3);
        border: 1px solid rgba(148,163,184,0.2);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .time-slots-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .time-slot-btn {
        background: rgba(30,41,59,0.6);
        border: 2px solid rgba(148,163,184,0.3);
        border-radius: 8px;
        padding: 0.75rem;
        color: #cbd5f5;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-align: center;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .time-slot-btn:hover {
        border-color: rgba(99,102,241,0.6);
        color: #e5e7eb;
        background: rgba(99,102,241,0.1);
    }

    .time-slot-btn.selected {
        background: linear-gradient(135deg, rgba(99,102,241,0.8), rgba(56,189,248,0.8));
        border-color: rgba(99,102,241,1);
        color: #0b1120;
        font-weight: 700;
        box-shadow: 0 0 20px rgba(99,102,241,0.4);
    }

    .time-slot-info {
        background: rgba(56,189,248,0.15);
        border: 1px solid rgba(56,189,248,0.3);
        border-radius: 8px;
        padding: 0.75rem;
        color: #cbd5f5;
        font-size: 0.85rem;
        margin-bottom: 1rem;
        display: none;
    }

    .time-slot-info.show {
        display: block;
    }

    .time-slot-info.show .jam-display {
        color: #22d3ee;
        font-weight: 600;
    }

    /* SKS SELECTOR */
    .sks-selector {
        background: rgba(30,41,59,0.5);
        border: 2px solid rgba(99,102,241,0.3);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .sks-selector.has-time {
        background: rgba(30,41,59,0.8);
        border-color: rgba(99,102,241,0.6);
        box-shadow: 0 0 20px rgba(99,102,241,0.2);
    }

    .sks-input-group {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .sks-slider-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .sks-slider-track {
        position: relative;
        height: 12px;
        background: rgba(148,163,184,0.15);
        border-radius: 6px;
        overflow: hidden;
    }

    .sks-slider-fill {
        position: absolute;
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #0ea5e9);
        border-radius: 6px;
        pointer-events: none;
        left: 0;
    }

    .sks-slider {
        position: relative;
        z-index: 5;
        width: 100%;
        height: 12px;
        border-radius: 6px;
        background: transparent;
        outline: none;
        -webkit-appearance: none;
        appearance: none;
    }

    .sks-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #0ea5e9);
        cursor: pointer;
        box-shadow: 0 0 16px rgba(99,102,241,0.6), 0 0 30px rgba(56,189,248,0.3);
        border: 2px solid rgba(255,255,255,0.3);
        transition: all 0.2s ease;
    }

    .sks-slider::-webkit-slider-thumb:hover {
        width: 30px;
        height: 30px;
        box-shadow: 0 0 20px rgba(99,102,241,0.8), 0 0 40px rgba(56,189,248,0.5);
        border-color: rgba(255,255,255,0.6);
    }

    .sks-slider::-webkit-slider-thumb:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    .sks-slider::-moz-range-thumb {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #0ea5e9);
        cursor: pointer;
        border: 2px solid rgba(255,255,255,0.3);
        box-shadow: 0 0 16px rgba(99,102,241,0.6), 0 0 30px rgba(56,189,248,0.3);
        transition: all 0.2s ease;
    }

    .sks-slider::-moz-range-thumb:hover {
        width: 30px;
        height: 30px;
        box-shadow: 0 0 20px rgba(99,102,241,0.8), 0 0 40px rgba(56,189,248,0.5);
        border-color: rgba(255,255,255,0.6);
    }

    .sks-slider::-moz-range-thumb:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    .sks-slider:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .sks-slider-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #64748b;
    }

    .sks-display {
        background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(56,189,248,0.2));
        border: 1px solid rgba(99,102,241,0.4);
        border-radius: 8px;
        padding: 0.75rem 1.25rem;
        min-width: 140px;
        text-align: center;
        color: #cbd5f5;
        font-weight: 600;
    }

    .sks-display .sks-value {
        color: #22d3ee;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .sks-display .sks-duration {
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(56,189,248,0.5));
        border: 1px solid rgba(99,102,241,0.8);
        border-radius: 12px;
        color: #e5e7eb;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, rgba(99,102,241,0.7), rgba(56,189,248,0.7));
        border-color: rgba(99,102,241,1);
        transform: translateY(-2px);
        color: #f9fafb;
    }

    .submit-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
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

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.5);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert-error li {
        color: #fca5a5;
        font-size: 0.9rem;
    }

    /* File Upload */
    .file-upload-wrapper {
        position: relative;
        width: 100%;
    }

    .file-upload-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-upload-display {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        background: rgba(30,41,59,0.7);
        border: 1px solid rgba(148,163,184,0.4);
        border-radius: 999px;
        padding: 0.65rem 0.9rem 0.65rem 1.1rem;
        font-size: 0.85rem;
        color: #cbd5f5;
        transition: all .25s ease;
    }

    .file-upload-display:hover {
        border-color: rgba(129,140,248,0.9);
        box-shadow: 0 0 16px rgba(59,130,246,0.4);
    }

    .file-upload-name {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        opacity: .9;
    }

    .file-upload-button {
        flex-shrink: 0;
        padding: 0.4rem 1rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #0ea5e9, #6366f1);
        color: #0b1120;
        font-weight: 600;
        font-size: 0.8rem;
        box-shadow: 0 8px 20px rgba(56,189,248,0.55);
    }

    .file-upload-icon {
        margin-right: 0.4rem;
    }

    /* CUSTOM DATE PICKER */
    .form-label {
        display: block;
        margin-bottom: 0.75rem;
        color: #e5e7eb;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .flatpickr-calendar {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.98), rgba(30, 41, 59, 0.98));
        border: 2px solid rgba(99, 102, 241, 0.6);
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8), 0 0 40px rgba(99, 102, 241, 0.3);
        padding: 1rem;
        width: 100% !important;
        max-width: 380px !important;
    }

    .flatpickr-calendar .numInputWrapper {
        width: auto;
    }

    .flatpickr-calendar .flatpickr-innerContainer {
        width: 100%;
    }

    .flatpickr-calendar .dayContainer {
        width: 100%;
        display: grid !important;
        grid-template-columns: repeat(7, 1fr) !important;
        gap: 0.5rem !important;
        padding: 0 !important;
    }

    .flatpickr-calendar .flatpickr-month {
        background: transparent;
        margin-bottom: 1rem;
    }

    .flatpickr-calendar .flatpickr-months {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .flatpickr-calendar .flatpickr-months .flatpickr-month {
        color: #f0f9ff;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        flex: 1;
        text-align: center;
    }

    .flatpickr-calendar .flatpickr-months .flatpickr-prev-month,
    .flatpickr-calendar .flatpickr-months .flatpickr-next-month {
        color: #22d3ee;
        fill: #22d3ee;
        cursor: pointer;
        width: 28px;
        height: 28px;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .flatpickr-calendar .flatpickr-months .flatpickr-prev-month:hover,
    .flatpickr-calendar .flatpickr-months .flatpickr-next-month:hover {
        color: #0ea5e9;
        fill: #0ea5e9;
        background: rgba(99, 102, 241, 0.2);
    }

    .flatpickr-calendar .flatpickr-weekdays {
        background: rgba(99, 102, 241, 0.1);
        border-radius: 8px;
        padding: 0.75rem 0;
        margin-bottom: 0.5rem;
        display: flex !important;
        justify-content: space-around;
        width: 100%;
    }

    .flatpickr-calendar .flatpickr-weekdays .flatpickr-weekday {
        color: #22d3ee;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        text-align: center;
        padding: 0.5rem 0;
        flex: 1;
        display: inline-block;
    }

    .flatpickr-calendar .dayContainer {
        gap: 0.5rem;
    }

    .flatpickr-calendar .dayContainer .flatpickr-day {
        color: #e0e7ff;
        background: rgba(99, 102, 241, 0.15);
        border: 2px solid rgba(99, 102, 241, 0.2);
        border-radius: 8px;
        transition: all 0.2s ease;
        font-weight: 600;
        font-size: 0.95rem;
        width: 100% !important;
        padding: 0.5rem 0 !important;
        margin: 0 !important;
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .flatpickr-calendar .dayContainer .flatpickr-day:hover:not(.disabled) {
        background: rgba(99, 102, 241, 0.35);
        border-color: rgba(99, 102, 241, 0.8);
        color: #f0f9ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .flatpickr-calendar .dayContainer .flatpickr-day.selected {
        background: linear-gradient(135deg, #6366f1, #0ea5e9);
        border-color: #22d3ee;
        color: #0b1120;
        font-weight: 700;
        box-shadow: 0 0 16px rgba(99, 102, 241, 0.6), 0 0 30px rgba(56, 189, 248, 0.4);
    }

    .flatpickr-calendar .dayContainer .flatpickr-day.today {
        border-color: rgba(56, 189, 248, 0.8);
        background: rgba(56, 189, 248, 0.2);
        color: #22d3ee;
        font-weight: 700;
    }

    /* Disabled dates styling - holidays & sundays */
    .flatpickr-calendar .dayContainer .flatpickr-day.disabled,
    .flatpickr-calendar .dayContainer .flatpickr-day.flatpickr-disabled {
        color: #ff6b6b;
        background: rgba(239, 68, 68, 0.25);
        cursor: not-allowed;
        border: 2px solid rgba(239, 68, 68, 0.6);
        opacity: 1;
        font-weight: 600;
    }

    .flatpickr-calendar .dayContainer .flatpickr-day.disabled:hover,
    .flatpickr-calendar .dayContainer .flatpickr-day.flatpickr-disabled:hover {
        background: rgba(239, 68, 68, 0.35);
        border-color: rgba(239, 68, 68, 0.9);
        color: #ff8787;
    }

    .flatpickr-calendar .dayContainer span.flatpickr-day.inRange {
        background: rgba(99, 102, 241, 0.15);
        color: #e0e7ff;
    }

    .flatpickr-calendar .dayContainer .flatpickr-day.prevMonthDay,
    .flatpickr-calendar .dayContainer .flatpickr-day.nextMonthDay {
        color: #475569;
        background: rgba(30, 41, 59, 0.3);
        border-color: transparent;
        opacity: 0.5;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(30, 41, 59, 0.5);
        border: 2px solid rgba(99, 102, 241, 0.3);
        border-radius: 8px;
        color: #e5e7eb;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        background: rgba(30, 41, 59, 0.7);
        border-color: rgba(99, 102, 241, 0.8);
        box-shadow: 0 0 12px rgba(99, 102, 241, 0.3);
    }

    .form-control::placeholder {
        color: #64748b;
    }
</style>
@endpush

@section('content')
<div class="booking-header">
    <div class="container">
        <a href="{{ route('ruangan.list') }}" class="back-btn">
            <span>←</span> Kembali ke Daftar Ruangan
        </a>
        <h1 class="booking-title">📄 Ajukan Peminjaman</h1>
    </div>
</div>

<div class="container pb-5">
    <div class="booking-form-container">
        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showError("{{ session('error') }}", 'Pemesanan Ditolak');
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showSuccess("{{ session('success') }}", 'Berhasil', 3000);
                });
            </script>
        @endif

        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const errors = {!! json_encode($errors->all()) !!};
                    if (errors.length > 0) {
                        showError(errors[0], 'Validasi Gagal');
                    }
                });
            </script>
        @endif

        <div class="ruangan-info-box">
            <div class="label">Ruangan yang Dipilih</div>
            <div class="value">{{ $ruangan->nama_ruang }}</div>
            <div style="margin-top: 0.5rem; color: #cbd5f5; font-size: 0.9rem;">
                📍 {{ $ruangan->lokasi }} • 👥 {{ $ruangan->kapasitas }} orang
            </div>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
            @csrf

            <input type="hidden" name="ruangan_id" value="{{ $ruangan->id_ruangan }}">
            <input type="hidden" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}">
            <input type="hidden" name="jumlah_sks" id="jumlah_sks" value="{{ old('jumlah_sks', 1) }}">

            <!-- Tanggal Pesan -->
            <div class="form-group">
                <label for="tanggal" class="form-label">📅 Tanggal Pesan</label>
                <input 
                    type="text" 
                    id="tanggal" 
                    name="tanggal" 
                    class="form-control @error('tanggal') border-red-500 @enderror"
                    placeholder="Pilih tanggal"
                    value="{{ old('tanggal') }}"
                    readonly
                    required
                >
                @error('tanggal')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jam Mulai (Slot Time) -->
            <div class="form-group">
                <label class="form-label">⏰ Pilih Jam Mulai (Tersedia: 07:00 - 17:00)</label>
                
                <div class="time-slot-info" id="timeSlotInfo">
                    Anda memilih jam <span class="jam-display" id="selectedTime">-</span>
                </div>

                <div class="time-slots-wrapper">
                    <div class="time-slots-grid" id="timeSlotsGrid">
                        <!-- Generated by JavaScript -->
                    </div>
                </div>

                @error('jam_mulai')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Durasi SKS -->
            <div class="form-group">
                <label class="form-label">⏱️ Durasi Penggunaan (1 SKS = 50 menit)</label>
                
                <div class="sks-selector" id="sksSelector">
                    <div class="sks-input-group">
                        <div class="sks-slider-wrapper">
                            <div class="sks-slider-track">
                                <div class="sks-slider-fill" id="sksSliderFill"></div>
                            </div>
                            <input 
                                type="range" 
                                id="sksSlider" 
                                class="sks-slider"
                                min="1" 
                                max="12" 
                                value="{{ old('jumlah_sks', 1) }}"
                                step="1"
                                disabled
                            >
                            <div class="sks-slider-labels">
                                <span>1 SKS</span>
                                <span id="sksMaxLabel">12 SKS</span>
                            </div>
                        </div>
                        <div class="sks-display">
                            <div class="sks-value" id="sksValue">{{ old('jumlah_sks', 1) }}</div>
                            <div class="sks-duration" id="sksDuration">50 menit</div>
                        </div>
                    </div>
                </div>

                @error('jumlah_sks')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keperluan -->
            <div class="form-group">
                <label for="keperluan" class="form-label">📝 Keperluan / Deskripsi Kegiatan</label>
                <textarea 
                    id="keperluan" 
                    name="keperluan" 
                    class="form-control @error('keperluan') border-red-500 @enderror"
                    rows="4"
                    placeholder="Jelaskan kegiatan atau tujuan penggunaan ruangan..."
                    required
                >{{ old('keperluan') }}</textarea>
                @error('keperluan')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Dokumen -->
            <div class="form-group">
                <label for="dokumen" class="form-label">📎 Lampiran Surat Peminjaman (PDF)</label>

                <div class="file-upload-wrapper @error('dokumen') border-red-500 @enderror">
                    <div class="file-upload-display">
                        <span id="dokumen-filename" class="file-upload-name">
                            Belum ada file dipilih
                        </span>
                        <span class="file-upload-button">
                            <span class="file-upload-icon">📎</span>
                            Pilih File
                        </span>
                    </div>
                    <input
                        type="file"
                        id="dokumen"
                        name="dokumen"
                        accept="application/pdf"
                        class="file-upload-input"
                        required
                    >
                </div>

                <small style="color:#94a3b8; display:block; margin-top:6px;">
                    Upload file PDF sebagai surat permohonan peminjaman (maks 5MB).
                </small>

                @error('dokumen')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                <span>✓</span> Buat Booking
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let unavailableDates = [];

    // Load unavailable dates (holidays + weekends)
    async function loadUnavailableDates() {
        try {
            const today = new Date();
            // Format as YYYY-MM-DD using LOCAL date (not UTC)
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const startDate = `${year}-${month}-${day}`;
            
            // Get dates for the next year
            const endDate = new Date(today.getFullYear() + 1, today.getMonth(), today.getDate());
            const endYear = endDate.getFullYear();
            const endMonth = String(endDate.getMonth() + 1).padStart(2, '0');
            const endDay = String(endDate.getDate()).padStart(2, '0');
            const endDateStr = `${endYear}-${endMonth}-${endDay}`;

            // Add cache busting parameter to force fresh data
            const timestamp = new Date().getTime();
            const response = await fetch(`/booking/api/unavailable-dates?start_date=${startDate}&end_date=${endDateStr}&_t=${timestamp}`);
            const data = await response.json();
            
            console.log('Loaded unavailable dates:', data.unavailable_dates ? data.unavailable_dates.length : 0, 'dates');
            console.log('Unavailable dates full list:', data.unavailable_dates);
            
            if (data.unavailable_dates) {
                unavailableDates = data.unavailable_dates;
                console.log('Sample dates:', unavailableDates.slice(0, 10));
                applyDateRestrictions();
            }
        } catch (error) {
            console.error('Gagal memuat tanggal yang tidak tersedia:', error);
        }
    }

    // Apply date restrictions to date input with Flatpickr
    function applyDateRestrictions() {
        const tanggalInput = document.getElementById('tanggal');
        const today = new Date();
        
        console.log('=== Flatpickr Debug Info ===');
        console.log('Total unavailable dates:', unavailableDates.length);
        console.log('Sample unavailable dates:', unavailableDates.slice(0, 20));
        
        // Count Sundays in unavailable
        const februarySundays = ['2026-02-01', '2026-02-08', '2026-02-15', '2026-02-22'];
        const februaryMondays = ['2026-02-02', '2026-02-09', '2026-02-16', '2026-02-23'];
        
        console.log('Sundays in unavailable:', februarySundays.filter(d => unavailableDates.includes(d)));
        console.log('Mondays in unavailable:', februaryMondays.filter(d => unavailableDates.includes(d)));
        
        // Initialize Flatpickr dengan unavailable dates
        flatpickr(tanggalInput, {
            locale: 'id',
            minDate: today,
            maxDate: new Date(today.getFullYear() + 1, today.getMonth(), today.getDate()),
            dateFormat: 'Y-m-d',
            disable: [
                function(date) {
                    // Format date as YYYY-MM-DD using LOCAL date (not UTC)
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    const dateStr = `${year}-${month}-${day}`;
                    
                    return unavailableDates.includes(dateStr);
                }
            ],
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                // Format date as YYYY-MM-DD using LOCAL date (not UTC)
                const year = dayElem.dateObj.getFullYear();
                const month = String(dayElem.dateObj.getMonth() + 1).padStart(2, '0');
                const day = String(dayElem.dateObj.getDate()).padStart(2, '0');
                const dateStr = `${year}-${month}-${day}`;
                
                // Add custom class untuk dates yang unavailable
                if (unavailableDates.includes(dateStr)) {
                    dayElem.classList.add('unavailable-date');
                }
            }
        });

        console.log('Flatpickr initialized');
    }

    // Generate time slots dari 07:00 sampai 17:00 dengan interval 50 menit (1 SKS)
    function generateTimeSlots() {
        const grid = document.getElementById('timeSlotsGrid');
        const startHour = 7; // 07:00
        const endHour = 17; // 17:00
        const minutesPerSks = 50;

        let currentHour = startHour;
        let currentMinute = 0;

        while (currentHour < endHour || (currentHour === endHour && currentMinute === 0)) {
            const timeStr = String(currentHour).padStart(2, '0') + ':' + String(currentMinute).padStart(2, '0');
            
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'time-slot-btn';
            button.textContent = timeStr;
            button.dataset.time = timeStr;
            
            button.addEventListener('click', function(e) {
                e.preventDefault();
                selectTimeSlot(timeStr, button);
            });

            grid.appendChild(button);

            // Increment untuk slot berikutnya
            currentMinute += minutesPerSks;
            if (currentMinute >= 60) {
                currentHour += 1;
                currentMinute = currentMinute - 60;
            }
        }
    }

    // Load occupied slots untuk tanggal yang dipilih
    async function loadOccupiedSlots() {
        const tanggal = document.getElementById('tanggal').value;
        const ruanganId = document.querySelector('input[name="ruangan_id"]').value;

        if (!tanggal || !ruanganId) {
            return;
        }

        try {
            const response = await fetch(`/booking/api/available-slots?ruangan_id=${ruanganId}&tanggal=${tanggal}`);
            const data = await response.json();
            
            if (data.occupied_slots) {
                markOccupiedSlots(data.occupied_slots);
            }
        } catch (error) {
            console.warn('Gagal memuat slot yang tersedia:', error);
        }
    }

    // Mark slots as occupied (disabled)
    function markOccupiedSlots(occupiedSlots) {
        const buttons = document.querySelectorAll('.time-slot-btn');
        buttons.forEach(button => {
            const time = button.dataset.time;
            if (occupiedSlots.includes(time)) {
                button.disabled = true;
                button.style.opacity = '0.5';
                button.style.cursor = 'not-allowed';
                button.style.background = 'rgba(239, 68, 68, 0.2)';
                button.style.borderColor = 'rgba(239, 68, 68, 0.5)';
                button.style.color = '#94a3b8';
                button.title = 'Waktu ini sudah dibooking';
            } else {
                button.disabled = false;
                button.style.opacity = '1';
                button.style.cursor = 'pointer';
                button.style.background = '';
                button.style.borderColor = '';
                button.style.color = '';
                button.title = '';
            }
        });
    }

    // Select time slot
    function selectTimeSlot(time, button) {
        if (button.disabled) {
            showWarning('Waktu ini sudah dibooking. Silakan pilih waktu lain.', 'Waktu Sudah Booked');
            return;
        }

        // Remove previous selection
        document.querySelectorAll('.time-slot-btn').forEach(btn => {
            btn.classList.remove('selected');
        });

        // Add selection to clicked button
        button.classList.add('selected');
        document.getElementById('jam_mulai').value = time;

        // Reset SKS slider ke 1 ketika jam berubah
        const sksSlider = document.getElementById('sksSlider');
        sksSlider.value = 1;
        document.getElementById('jumlah_sks').value = 1;
        document.getElementById('sksValue').textContent = 1;

        // Update max SKS berdasarkan jam yang dipilih
        updateMaxSks(time);

        // Update display SKS setelah reset
        updateSksDisplay();

        // Show info
        document.getElementById('selectedTime').textContent = time;
        document.getElementById('timeSlotInfo').classList.add('show');
    }

    // Hitung max SKS berdasarkan jam mulai
    function updateMaxSks(jamMulaiStr) {
        // Parse jam mulai
        const [hour, minute] = jamMulaiStr.split(':').map(Number);
        const jamMulai = new Date();
        jamMulai.setHours(hour, minute, 0);

        // Jam operasional akhir: 18:00
        const jamAkhir = new Date();
        jamAkhir.setHours(18, 0, 0);

        // Hitung selisih menit
        const diffMinutes = (jamAkhir - jamMulai) / (1000 * 60);
        
        // Hitung max SKS (setiap SKS = 50 menit)
        const maxSks = Math.max(1, Math.floor(diffMinutes / 50));

        // Update slider
        const sksSlider = document.getElementById('sksSlider');
        const sksSelector = document.getElementById('sksSelector');
        
        // Enable slider dan set max value
        sksSlider.disabled = false;
        sksSlider.max = maxSks;
        sksSelector.classList.add('has-time');
        
        // Reset nilai slider jika melebihi max
        if (parseInt(sksSlider.value) > maxSks) {
            sksSlider.value = maxSks;
            updateSksDisplay();
        }

        // Update label max SKS
        document.getElementById('sksMaxLabel').textContent = `${maxSks} SKS`;

        // Tampilkan warning jika max SKS terbatas
        const timeSlotInfo = document.getElementById('timeSlotInfo');
        if (maxSks < 12) {
            timeSlotInfo.innerHTML = `Anda memilih jam <span class="jam-display" id="selectedTime">${jamMulaiStr}</span> • Maksimal durasi: <strong>${maxSks} SKS</strong> (${maxSks * 50} menit, selesai jam ${String(jamAkhir.getHours()).padStart(2, '0')}:${String(jamAkhir.getMinutes()).padStart(2, '0')})`;
        } else {
            timeSlotInfo.innerHTML = `Anda memilih jam <span class="jam-display" id="selectedTime">${jamMulaiStr}</span>`;
        }
    }

    // Update display SKS
    function updateSksDisplay() {
        const sksSlider = document.getElementById('sksSlider');
        const sks = parseInt(sksSlider.value);
        const maxSks = parseInt(sksSlider.max);
        const minutes = sks * 50;
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;

        document.getElementById('sksValue').textContent = sks;
        document.getElementById('jumlah_sks').value = sks;
        
        // Update slider fill width
        const fillPercentage = (sks / maxSks) * 100;
        document.getElementById('sksSliderFill').style.width = fillPercentage + '%';

        let durationText = '';
        if (hours > 0 && mins > 0) {
            durationText = `${hours}j ${mins}m`;
        } else if (hours > 0) {
            durationText = `${hours} jam`;
        } else {
            durationText = `${mins} menit`;
        }

        document.getElementById('sksDuration').textContent = durationText;
    }

    // SKS slider handler
    document.getElementById('sksSlider').addEventListener('input', function() {
        updateSksDisplay();
    });

    // Tanggal change handler - reload occupied slots
    document.getElementById('tanggal').addEventListener('change', function() {
        loadOccupiedSlots();
    });

    // File upload handler
    const dokumenInput = document.getElementById('dokumen');
    const dokumenFilename = document.getElementById('dokumen-filename');

    if (dokumenInput && dokumenFilename) {
        dokumenInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                dokumenFilename.textContent = this.files[0].name;
            } else {
                dokumenFilename.textContent = 'Belum ada file dipilih';
            }
        });
    }

    // Form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const jamMulai = document.getElementById('jam_mulai').value;
        const jumlahSks = document.getElementById('jumlah_sks').value;
        const sksSlider = document.getElementById('sksSlider');
        const tanggal = document.getElementById('tanggal').value;

        console.log('Form submit - tanggal:', tanggal, 'unavailableDates:', unavailableDates);

        if (!tanggal) {
            e.preventDefault();
            showWarning('Silakan pilih tanggal terlebih dahulu!', 'Tanggal Belum Dipilih');
            return false;
        }

        if (unavailableDates.includes(tanggal)) {
            e.preventDefault();
            showWarning('Tanggal yang dipilih adalah hari libur, akhir pekan, atau tanggal merah. Silakan pilih tanggal lain.', 'Tanggal Tidak Tersedia');
            console.warn('Booking pada tanggal tidak tersedia:', tanggal);
            return false;
        }

        if (!jamMulai) {
            e.preventDefault();
            showWarning('Silakan pilih jam mulai terlebih dahulu!', 'Jam Belum Dipilih');
            return false;
        }

        if (!jumlahSks || jumlahSks < 1) {
            e.preventDefault();
            showWarning('Silakan pilih durasi SKS!', 'SKS Belum Dipilih');
            return false;
        }

        // Validasi SKS tidak melebihi max
        if (parseInt(jumlahSks) > parseInt(sksSlider.max)) {
            e.preventDefault();
            showWarning(`SKS tidak boleh melebihi ${sksSlider.max} SKS untuk jam ${jamMulai}`, 'SKS Melebihi Batas');
            return false;
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadUnavailableDates();
        generateTimeSlots();
        loadOccupiedSlots();

        // Set selected time if already chosen
        const selectedTime = document.getElementById('jam_mulai').value;
        if (selectedTime) {
            const button = document.querySelector(`[data-time="${selectedTime}"]`);
            if (button && !button.disabled) {
                button.classList.add('selected');
                document.getElementById('selectedTime').textContent = selectedTime;
                document.getElementById('timeSlotInfo').classList.add('show');
                updateMaxSks(selectedTime);
            }
        }

        // Update display SKS dan slider fill
        updateSksDisplay();
    });
</script>
@endpush

