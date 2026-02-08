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
        background: rgba(30,41,59,0.3);
        border: 1px solid rgba(148,163,184,0.2);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .sks-input-group {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 0.75rem;
    }

    .sks-slider {
        flex: 1;
        height: 8px;
        border-radius: 5px;
        background: linear-gradient(to right, rgba(99,102,241,0.3), rgba(56,189,248,0.3));
        outline: none;
        -webkit-appearance: none;
        appearance: none;
    }

    .sks-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #0ea5e9);
        cursor: pointer;
        box-shadow: 0 0 12px rgba(99,102,241,0.4);
    }

    .sks-slider::-moz-range-thumb {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #0ea5e9);
        cursor: pointer;
        border: none;
        box-shadow: 0 0 12px rgba(99,102,241,0.4);
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
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
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
                    type="date" 
                    id="tanggal" 
                    name="tanggal" 
                    class="form-control @error('tanggal') border-red-500 @enderror"
                    value="{{ old('tanggal') }}"
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
                
                <div class="sks-selector">
                    <div class="sks-input-group">
                        <input 
                            type="range" 
                            id="sksSlider" 
                            class="sks-slider"
                            min="1" 
                            max="12" 
                            value="{{ old('jumlah_sks', 1) }}"
                            step="1"
                        >
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

    // Select time slot
    function selectTimeSlot(time, button) {
        // Remove previous selection
        document.querySelectorAll('.time-slot-btn').forEach(btn => {
            btn.classList.remove('selected');
        });

        // Add selection to clicked button
        button.classList.add('selected');
        document.getElementById('jam_mulai').value = time;

        // Show info
        document.getElementById('selectedTime').textContent = time;
        document.getElementById('timeSlotInfo').classList.add('show');
    }

    // SKS slider handler
    document.getElementById('sksSlider').addEventListener('input', function() {
        const sks = this.value;
        const minutes = sks * 50;
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;

        document.getElementById('sksValue').textContent = sks;
        document.getElementById('jumlah_sks').value = sks;

        let durationText = '';
        if (hours > 0 && mins > 0) {
            durationText = `${hours}j ${mins}m`;
        } else if (hours > 0) {
            durationText = `${hours} jam`;
        } else {
            durationText = `${mins} menit`;
        }

        document.getElementById('sksDuration').textContent = durationText;
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

        if (!jamMulai) {
            e.preventDefault();
            alert('Silakan pilih jam mulai terlebih dahulu!');
            return false;
        }

        if (!jumlahSks || jumlahSks < 1) {
            e.preventDefault();
            alert('Silakan pilih durasi SKS!');
            return false;
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        generateTimeSlots();

        // Set selected time if already chosen
        const selectedTime = document.getElementById('jam_mulai').value;
        if (selectedTime) {
            const button = document.querySelector(`[data-time="${selectedTime}"]`);
            if (button) {
                button.classList.add('selected');
                document.getElementById('selectedTime').textContent = selectedTime;
                document.getElementById('timeSlotInfo').classList.add('show');
            }
        }
    });
</script>
@endpush

