@extends('layouts.app')

@section('title', 'Beranda - Ruangin.app')

@push('styles')
<style>
        /* ===== HERO ACTION BUTTONS ===== */
    .hero-actions {
        gap: .9rem;
    }

    .hero-primary-btn {
        border-radius: 999px;
        padding: .75rem 1.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        box-shadow: 0 14px 35px rgba(56,189,248,.55);
        letter-spacing: .01em;
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }

    .hero-primary-btn span.icon {
        font-size: 1.05rem;
        transform: translateX(0);
        transition: transform .18s ease;
    }

    .hero-primary-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 45px rgba(56,189,248,.7);
        filter: brightness(1.05);
    }

    .hero-primary-btn:hover span.icon {
        transform: translateX(3px);
    }

    .hero-secondary-btn {
        border-radius: 999px;
        padding: .75rem 1.7rem;
        font-weight: 500;
        border: 1px solid rgba(148,163,184,.8);
        color: #e5e7eb;
        background: rgba(15,23,42,.5);
        backdrop-filter: blur(12px);
        transition: background .18s ease, border-color .18s ease,
                    color .18s ease, transform .18s ease, box-shadow .18s ease;
    }

    .hero-secondary-btn:hover {
        background: rgba(15,23,42,.9);
        border-color: #7dd3fc;
        color: #f9fafb;
        transform: translateY(-1px);
        box-shadow: 0 14px 32px rgba(15,23,42,.9);
    }

    /* Smooth scroll untuk seluruh halaman */
    html {
        scroll-behavior: smooth;
    }

    /* ===== HERO / ATAS ===== */
    .hero-badge {
        color:#e5e7eb;
        text-transform: uppercase;
        letter-spacing:.14em;
        font-size:.78rem;
    }
    .hero-highlight {
        color:#7dd3fc;
    }
    .hero-list {
        color:#e5e7eb;
    }

    .card-hero {
        position: relative;
        border-radius: 26px;
        background:
            radial-gradient(circle at top left, rgba(148,163,184,0.25), transparent 60%),
            radial-gradient(circle at bottom right, rgba(37,99,235,0.6), transparent 60%),
            rgba(15,23,42,0.96);
        border: 1px solid rgba(148,163,184,0.45);
        box-shadow: 0 22px 55px rgba(15,23,42,0.95);
        overflow: hidden;
    }
    .card-hero-overlay {
        position:absolute;
        inset:0;
        background: radial-gradient(circle at 0 0, rgba(255,255,255,0.35), transparent 60%);
        opacity:.13;
        pointer-events:none;
    }
    .card-hero-body {
        position:relative;
        z-index:1;
    }
    .stats-number {
        color:#fde68a;
        font-weight:800;
        font-size:1.8rem;
        line-height:1.1;
    }
    .stats-label {
        color:#e5e7eb;
        font-size:.8rem;
    }
    .card-hero ul li {
        margin-bottom:.25rem;
    }

    /* ===== SECTION GLOBAL (1–5) ===== */
    .lp-section {
        max-width: 1100px;
        margin: 2.5rem auto 0 auto;  /* jarak antar section + dari hero */
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .lp-section-title {
        font-size: 1.7rem;
        font-weight: 800;
        color: #f9fafb;
        margin-bottom: .5rem;
    }

    .lp-section-sub {
        color: #cbd5f5;
        font-size: .95rem;
        margin-bottom: 2rem;
    }

    /* ===== 1. CARA KERJA ===== */
    .lp-steps-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: 1.2rem;
    }
    @media (max-width: 768px) {
        .lp-steps-grid {
            grid-template-columns: 1fr;
        }
    }

    .lp-step-card {
        border-radius: 20px;
        padding: 1.4rem 1.3rem;
        background:
            radial-gradient(circle at top left, rgba(129,140,248,.4), transparent 55%),
            rgba(15,23,42,.96);
        border: 1px solid rgba(148,163,184,.6);
        color: #e5e7eb;
        box-shadow: 0 18px 40px rgba(15,23,42,.9);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .lp-step-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 26px 60px rgba(15,23,42,.95);
        border-color: rgba(94,234,212,.9);
    }

    .lp-step-number {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: .9rem;
        margin-bottom: .7rem;
        background: linear-gradient(135deg,#6366f1,#22d3ee);
        color: #0b1120;
    }

    .lp-step-title {
        font-weight: 700;
        margin-bottom: .25rem;
    }

    .lp-step-text {
        font-size: .9rem;
        color: #d1d5db;
    }

    /* ===== 2. FITUR UTAMA ===== */
    .lp-feature-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0,1fr));
        gap: 1.1rem;
    }
    @media (max-width: 992px) {
        .lp-feature-grid {
            grid-template-columns: repeat(2, minmax(0,1fr));
        }
    }
    @media (max-width: 576px) {
        .lp-feature-grid {
            grid-template-columns: 1fr;
        }
    }

    .lp-feature-card {
        border-radius: 18px;
        padding: 1.1rem 1rem;
        background: rgba(15,23,42,.95);
        border: 1px solid rgba(55,65,81,.9);
        color: #e5e7eb;
        transition: transform .18s ease, border-color .18s ease, background .18s ease;
    }

    .lp-feature-card:hover {
        transform: translateY(-3px);
        border-color: rgba(129,140,248,1);
        background: radial-gradient(circle at top, rgba(129,140,248,.28), transparent 50%),
                    rgba(15,23,42,.98);
    }

    .lp-feature-icon {
        width: 30px;
        height: 30px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .6rem;
        font-size: 1.05rem;
        background: rgba(37,99,235,.18);
        color: #a5b4fc;
    }

    .lp-feature-title {
        font-weight: 700;
        font-size: .95rem;
        margin-bottom: .25rem;
    }

    .lp-feature-text {
        font-size: .88rem;
        color: #d1d5db;
    }

    /* ===== 3. FAQ ===== */
    .lp-faq-item {
        border-radius: 14px;
        background: rgba(15,23,42,.96);
        border: 1px solid rgba(55,65,81,.9);
        margin-bottom: .7rem;
        overflow: hidden;
    }

    .lp-faq-button {
        width: 100%;
        text-align: left;
        padding: .85rem 1rem;
        background: transparent;
        border: 0;
        color: #e5e7eb;
        font-size: .9rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .lp-faq-button span:first-child {
        flex: 1;
    }

    .lp-faq-icon {
        flex-shrink: 0;
        font-size: 1.05rem;
        color: #a5b4fc;
        transition: transform .18s ease;
        margin-left: auto;
    }

    .lp-faq-button[aria-expanded="true"] .lp-faq-icon {
        transform: rotate(90deg);
    }

    .lp-faq-body {
        padding: 0 1rem 1rem;
        font-size: .88rem;
        color: #d1d5db;
    }

    /* ===== 4. CTA STRIP ===== */
    .lp-cta-strip {
        position: relative;
        border-radius: 26px;
        padding: 1.9rem 1.9rem;
        background: linear-gradient(120deg,#6366f1,#22d3ee);
        color: #0b1120;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1.1rem;
        box-shadow: 0 26px 70px rgba(15,23,42,.95);
        overflow: hidden;
        transition: transform .22s ease, box-shadow .22s ease;
    }

    /* Glow lembut bergerak di belakang */
    .lp-cta-strip::before {
        content: "";
        position: absolute;
        inset: -40%;
        background:
            radial-gradient(circle at 0% 0%, rgba(255,255,255,.28), transparent 60%),
            radial-gradient(circle at 100% 100%, rgba(56,189,248,.35), transparent 60%);
        opacity: .65;
        mix-blend-mode: screen;
        animation: ctaGlow 12s linear infinite;
        pointer-events: none;
    }

    .lp-cta-strip > * {
        position: relative;
        z-index: 1;
    }

    .lp-cta-strip:hover {
        transform: translateY(-4px);
        box-shadow: 0 34px 90px rgba(15,23,42,.97);
    }

    .lp-cta-badge {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .2rem .7rem;
        border-radius: 999px;
        background: rgba(15,23,42,.08);
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .04em;
        text-transform: uppercase;
        margin-bottom: .4rem;
        opacity: .9;
    }

    .lp-cta-badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 999px;
        background: #22c55e;
        box-shadow: 0 0 0 0 rgba(34,197,94,.5);
        animation: pingDot 1.6s infinite;
    }

    .lp-cta-title {
        font-size: 1.25rem;
        font-weight: 800;
        margin-bottom: .2rem;
    }

    .lp-cta-text {
        font-size: .9rem;
        opacity: .9;
    }

    .lp-cta-actions .btn {
        font-size: .9rem;
        padding: .58rem 1.25rem;
        border-radius: 999px;
        transition: transform .18s ease, box-shadow .18s ease, background-color .18s ease, color .18s ease;
    }

    .lp-cta-actions .btn-dark {
        background: #020617;
        border-color: transparent;
        box-shadow: 0 10px 26px rgba(15,23,42,.8);
    }
    .lp-cta-actions .btn-dark:hover {
        transform: translateY(-1px) scale(1.03);
        box-shadow: 0 16px 40px rgba(15,23,42,.95);
        background: #0b1120;
    }

    .lp-cta-actions .btn-outline-light {
        border-width: 1px;
        border-color: rgba(248,250,252,.9);
        color: #0b1120;
        background: rgba(248,250,252,.06);
    }
    .lp-cta-actions .btn-outline-light:hover {
        background: #f9fafb;
        color: #0b1120;
        transform: translateY(-1px) scale(1.03);
        box-shadow: 0 14px 32px rgba(15,23,42,.9);
    }

    @keyframes ctaGlow {
        0%   { transform: translate3d(0,0,0) rotate(0deg); }
        50%  { transform: translate3d(4%,3%,0) rotate(2deg); }
        100% { transform: translate3d(0,0,0) rotate(0deg); }
    }

    @keyframes pingDot {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(34,197,94,.55);
        }
        70% {
            transform: scale(1.5);
            box-shadow: 0 0 0 10px rgba(34,197,94,0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(34,197,94,0);
        }
    }


    /* ===== SCROLL ANIMATION BASE ===== */
    .lp-animate {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity .6s ease-out, transform .6s ease-out;
    }

    .lp-animate.is-visible {
        opacity: 1;
        transform: translate3d(0,0,0);
    }

    /* Section 1 – Cara Kerja (cards) */
    .lp-section-how .lp-step-card {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity .5s ease-out, transform .5s ease-out;
    }
    .lp-section-how.is-visible .lp-step-card {
        opacity: 1;
        transform: translateY(0);
    }
    .lp-section-how.is-visible .lp-step-card:nth-child(2) {
        transition-delay: .08s;
    }
    .lp-section-how.is-visible .lp-step-card:nth-child(3) {
        transition-delay: .16s;
    }

    /* Section 2 – Fitur */
    .lp-section-features .lp-feature-card {
        opacity: 0;
        transform: translateY(18px);
        transition: opacity .45s ease-out, transform .45s ease-out;
    }
    .lp-section-features.is-visible .lp-feature-card {
        opacity: 1;
        transform: translateY(0);
    }
    .lp-section-features.is-visible .lp-feature-card:nth-child(2) {
        transition-delay: .06s;
    }
    .lp-section-features.is-visible .lp-feature-card:nth-child(3) {
        transition-delay: .12s;
    }
    .lp-section-features.is-visible .lp-feature-card:nth-child(4) {
        transition-delay: .18s;
    }

    /* Section 3 – FAQ */
    .lp-section-faq .lp-faq-item {
        opacity: 0;
        transform: translateY(16px);
        transition: opacity .45s ease-out, transform .45s ease-out;
    }
    .lp-section-faq.is-visible .lp-faq-item {
        opacity: 1;
        transform: translateY(0);
    }
    .lp-section-faq.is-visible .lp-faq-item:nth-child(2) {
        transition-delay: .06s;
    }
    .lp-section-faq.is-visible .lp-faq-item:nth-child(3) {
        transition-delay: .12s;
    }

    /* Section 4 – CTA */
    .lp-section-cta .lp-cta-strip {
        opacity: 0;
        transform: translateY(26px) scale(.97);
        transition: opacity .55s ease-out, transform .55s ease-out;
    }
    .lp-section-cta.is-visible .lp-cta-strip {
        opacity: 1;
        transform: translateY(0) scale(1);
    }


</style>
@endpush

@section('content')
<div class="container">
    <div class="row align-items-center" style="min-height: 70vh;">

        {{-- Kiri: teks utama --}}
        <div class="col-lg-7 mb-4 fade-in-up">
            <div class="mb-2 hero-badge">
                SISTEM BOOKING RUANGAN KAMPUS
            </div>

            <h1 class="section-title mb-3" style="font-size:2.8rem;">
                Atur Ruangan Kampus dengan
                <span class="hero-highlight">Satu Aplikasi</span>
            </h1>

            <p class="section-subtitle mb-4" style="color:#e5e7eb;">
                Ruang kelas kecil, lab, hingga ruang rapat. Mahasiswa dan dosen dapat
                mengajukan booking secara online, sementara admin mengelola ruangan,
                jadwal, dan validasi dokumen peminjaman.
            </p>

            <div class="d-flex flex-wrap hero-actions fade-in-up delay-1">
    @guest
        <a href="{{ route('login') }}" class="gradient-btn hero-primary-btn">
            Mulai Booking (Login)
            <span class="icon">→</span>
        </a>
        <a href="{{ route('register') }}" class="hero-secondary-btn">
            Daftar Akun
        </a>
    @else
        <a href="{{ route('ruangan.list') }}" class="gradient-btn hero-primary-btn">
            Booking Ruangan
            <span class="icon">→</span>
        </a>
        <a href="{{ route('booking.my') }}" class="hero-secondary-btn">
            Lihat Booking Saya
        </a>
    @endguest
</div>


            <div class="d-flex flex-wrap gap-3 mt-4 fade-in-up delay-2 small hero-list">
                <div>✓ Cek ketersediaan ruangan real-time</div>
                <div>✓ Upload dokumen peminjaman</div>
                <div>✓ Persetujuan booking oleh admin</div>
            </div>
        </div>

        {{-- Kanan: card kenapa Ruangin --}}
        <div class="col-lg-5 fade-in-up delay-2">
            <div class="card-hero p-4">
                <div class="card-hero-overlay"></div>
                <div class="card-hero-body">
                    <h5 class="mb-2" style="color:#f9fafb;">Kenapa Ruangin.app?</h5>
                    <p class="mb-4" style="color:#e5e7eb; font-size:.9rem;">
                        Ringkas, terpusat, dan mudah digunakan untuk mengelola seluruh
                        kebutuhan ruangan di kampus.
                    </p>

                    <div class="row text-center mb-3">
                        <div class="col-4">
                            <div class="stats-number js-countup"
                                 data-target="{{ $totalRuanganAktif }}">0</div>
                            <div class="stats-label">Ruangan Aktif</div>
                        </div>
                        <div class="col-4">
                            <div class="stats-number js-countup"
                                 data-target="{{ $bookingHariIni }}">0</div>
                            <div class="stats-label">Booking Hari Ini</div>
                        </div>
                        <div class="col-4">
                            <div class="stats-number js-countup"
                                 data-target="{{ $bookingPending }}">0</div>
                            <div class="stats-label">Menunggu<br>Persetujuan</div>
                        </div>
                    </div>

                    <hr class="border-secondary">

                    <ul class="small" style="color:#e5e7eb; padding-left:1.1rem;">
                        <li>Mahasiswa & dosen booking ruangan secara mandiri.</li>
                        <li>Admin mengelola data ruangan dan menyetujui permintaan.</li>
                        <li>Riwayat booking dan jadwal ruangan tercatat rapi.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ================= SECTION 1 – CARA KERJA ================= --}}
<section class="lp-section lp-animate lp-section-how" id="how-it-works">
    <h2 class="lp-section-title">Cara Kerja Ruangin.app</h2>
    <p class="lp-section-sub">
        Hanya dalam tiga langkah sederhana, peminjaman ruangan kampus menjadi lebih cepat dan teratur.
    </p>

    <div class="lp-steps-grid">
        <div class="lp-step-card">
            <div class="lp-step-number">1</div>
            <div class="lp-step-title">Pilih ruangan</div>
            <p class="lp-step-text mb-0">
                Cari ruangan kelas, lab, atau ruang rapat yang tersedia sesuai kebutuhan kegiatan Anda.
            </p>
        </div>
        <div class="lp-step-card">
            <div class="lp-step-number">2</div>
            <div class="lp-step-title">Isi form & upload dokumen</div>
            <p class="lp-step-text mb-0">
                Tentukan tanggal, jam, keperluan peminjaman, dan unggah dokumen pendukung (khusus mahasiswa).
            </p>
        </div>
        <div class="lp-step-card">
            <div class="lp-step-number">3</div>
            <div class="lp-step-title">Tunggu persetujuan admin</div>
            <p class="lp-step-text mb-0">
                Admin memeriksa dan menyetujui permintaan. Status booking dan jadwal ruangan akan diperbarui otomatis.
            </p>
        </div>
    </div>
</section>

{{-- ================= SECTION 2 – FITUR UTAMA ================= --}}
<section class="lp-section lp-animate lp-section-features" id="features">
    <h2 class="lp-section-title">Fitur Utama Ruangin.app</h2>
    <p class="lp-section-sub">
        Dirancang untuk memudahkan mahasiswa, dosen, dan admin dalam mengelola kebutuhan ruangan di kampus.
    </p>

    <div class="lp-feature-grid">
        <div class="lp-feature-card">
            <div class="lp-feature-icon">📅</div>
            <div class="lp-feature-title">Jadwal real-time</div>
            <p class="lp-feature-text mb-0">
                Lihat ketersediaan ruangan secara langsung sehingga terhindar dari bentrok jadwal.
            </p>
        </div>
        <div class="lp-feature-card">
            <div class="lp-feature-icon">📎</div>
            <div class="lp-feature-title">Upload dokumen</div>
            <p class="lp-feature-text mb-0">
                Mahasiswa dapat melampirkan surat permohonan atau dokumen peminjaman sesuai aturan fakultas.
            </p>
        </div>
        <div class="lp-feature-card">
            <div class="lp-feature-icon">🧾</div>
            <div class="lp-feature-title">Riwayat booking tersimpan</div>
            <p class="lp-feature-text mb-0">
                Semua riwayat peminjaman tersimpan rapi dan dapat diakses kembali kapan saja.
            </p>
        </div>
        <div class="lp-feature-card">
            <div class="lp-feature-icon">🔔</div>
            <div class="lp-feature-title">Status transparan</div>
            <p class="lp-feature-text mb-0">
                Pengguna dapat memantau status <em>Menunggu</em>, <em>Disetujui</em>, atau <em>Ditolak</em> secara jelas.
            </p>
        </div>
    </div>
</section>


{{-- ================= SECTION 3 – FAQ ================= --}}
<section class="lp-section lp-animate lp-section-faq" id="faq">
    <h2 class="lp-section-title">Pertanyaan yang sering diajukan</h2>
    <p class="lp-section-sub">
        Masih ragu? Berikut beberapa hal yang sering ditanyakan mengenai penggunaan Ruangin.app.
    </p>

    <div class="lp-faq-item">
        <button class="lp-faq-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1"
                aria-expanded="false" aria-controls="faq1">
            <span>Apakah semua ruangan kampus bisa dibooking lewat Ruangin.app?</span>
            <span class="lp-faq-icon">›</span>
        </button>
        <div class="collapse" id="faq1">
            <div class="lp-faq-body">
                Ruangan yang dapat dibooking adalah ruangan yang sudah didaftarkan oleh admin (misalnya kelas kecil,
                lab komputer, atau ruang rapat tertentu). Jika ada ruangan yang belum tersedia, silakan hubungi admin.
            </div>
        </div>
    </div>

    <div class="lp-faq-item">
        <button class="lp-faq-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq2"
                aria-expanded="false" aria-controls="faq2">
            <span>Apakah mahasiswa wajib mengunggah dokumen peminjaman?</span>
            <span class="lp-faq-icon">›</span>
        </button>
        <div class="collapse" id="faq2">
            <div class="lp-faq-body">
                Ya, mahasiswa biasanya diminta mengunggah surat permohonan atau dokumen lain sesuai aturan
                fakultas. Dosen dapat mengajukan booking tanpa dokumen jika kebijakan kampus mengizinkan.
            </div>
        </div>
    </div>

    <div class="lp-faq-item">
        <button class="lp-faq-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq3"
                aria-expanded="false" aria-controls="faq3">
            <span>Berapa lama status booking diproses oleh admin?</span>
            <span class="lp-faq-icon">›</span>
        </button>
        <div class="collapse" id="faq3">
            <div class="lp-faq-body">
                Waktu persetujuan tergantung kebijakan kampus, namun biasanya dalam rentang beberapa jam
                hingga maksimal 1 hari kerja. Pengguna dapat memantau status booking melalui menu “Booking Saya”.
            </div>
        </div>
    </div>
</section>

{{-- ================= SECTION 4 – CTA STRIP ================= --}}
<section class="lp-section lp-animate lp-section-cta" id="cta">
    <div class="lp-cta-strip">
        <div>
            <div class="lp-cta-badge">
                <span class="lp-cta-badge-dot"></span>
                Mulai booking ruangan dalam hitungan menit
            </div>
            <div class="lp-cta-title">Siap membuat peminjaman ruangan lebih rapi?</div>
            <div class="lp-cta-text">
                Mulai gunakan Ruangin.app untuk mengatur jadwal ruangan kelas, lab, dan ruang rapat di kampus Anda
                tanpa ribet form kertas dan cek ruangan manual.
            </div>
        </div>
        <div class="lp-cta-actions">
            @guest
                <a href="{{ route('login') }}" class="btn btn-dark me-2">
                    Mulai Booking (Login)
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light">
                    Daftar Akun
                </a>
            @else
                <a href="{{ route('ruangan.list') }}" class="btn btn-dark me-2">
                    Booking Ruangan Sekarang
                </a>
                <a href="{{ route('booking.my') }}" class="btn btn-outline-light">
                    Lihat Booking Saya
                </a>
            @endguest
        </div>
    </div>
</section>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    /* ===== ANIMASI ANGKA (COUNT-UP) ===== */
    const counters = document.querySelectorAll('.js-countup');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target') || '0', 10);

        if (!target) {
            counter.textContent = '0';
            return;
        }

        const duration = 1200; // ms
        const startTime = performance.now();

        function easeOutQuad(t) {
            return t * (2 - t);
        }

        function update(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = easeOutQuad(progress);
            const value = Math.floor(eased * target);

            counter.textContent = value.toLocaleString('id-ID');

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                counter.textContent = target.toLocaleString('id-ID');
            }
        }

        requestAnimationFrame(update);
    });

    /* ===== ANIMASI SCROLL (SECTION 1–5) ===== */
    const animatedSections = document.querySelectorAll('.lp-animate');

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target); // animasi sekali saja
                }
            });
        }, { threshold: 0.2 });

        animatedSections.forEach(section => observer.observe(section));
    } else {
        // fallback browser lama
        animatedSections.forEach(section => section.classList.add('is-visible'));
    }
});
</script>
@endpush

@endsection

