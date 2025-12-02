@extends('layouts.app')

@section('title', 'Tentang Kami - Ruangin.app')

@push('styles')
<style>
    /* Container utama section */
    .team-section {
        max-width: 1100px;
        margin: 0 auto;
        padding: 4rem 0 5rem;
        text-align: center;
    }

    .team-badge {
        color:#a5b4fc;
        font-size:.8rem;
        letter-spacing:.14em;
        text-transform:uppercase;
        margin-bottom:.5rem;
    }

    .team-title {
        font-size:2.1rem;
        font-weight:800;
        color:#f9fafb;
        margin-bottom:.8rem;
    }

    .team-subtitle {
        max-width: 660px;
        margin: 0 auto 3rem;
        color:#cbd5f5;
        font-size:.95rem;
        line-height:1.6;
    }

    /* Grid tim */
    .team-grid {
        display:grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap:1.5rem;
    }

    /* Baris kedua otomatis 2 kartu dan center di layar kecil-menengah */
    @media (max-width: 992px) {
        .team-grid {
            grid-template-columns: repeat(2, minmax(0,1fr));
        }
    }
    @media (max-width: 640px) {
        .team-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Kartu anggota tim */
    .team-card {
        position:relative;
        border-radius: 26px;
        padding: 2.2rem 1.6rem 2.1rem;
        background:
            radial-gradient(circle at top left, rgba(59,130,246,.35), transparent 55%),
            radial-gradient(circle at bottom right, rgba(56,189,248,.45), transparent 55%),
            rgba(15,23,42,.98);
        border: 1px solid rgba(129,140,248,.7);
        box-shadow: 0 24px 65px rgba(15,23,42,.95);
        overflow:hidden;
        text-align:center;
        transition:
            transform .22s ease-out,
            box-shadow .22s ease-out,
            border-color .22s ease-out;
    }

    .team-card::before {
        content:"";
        position:absolute;
        inset:-40%;
        background: radial-gradient(circle at top, rgba(255,255,255,.11), transparent 60%);
        opacity:.35;
        mix-blend-mode:soft-light;
        pointer-events:none;
    }

    .team-card-inner {
        position:relative;
        z-index:1;
    }

    .team-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 30px 80px rgba(15,23,42,.98);
        border-color: rgba(129,230,217,1);
    }

    /* Avatar warna-warni */
    .team-avatar-wrap {
        margin-bottom:1.1rem;
    }

    .team-avatar-ring {
        width:86px;
        height:86px;
        margin:0 auto;
        border-radius:999px;
        padding:3px;
        background: conic-gradient(
            from 180deg,
            #22d3ee, #6366f1, #a855f7, #f97316, #22c55e, #22d3ee
        );
        box-shadow:0 0 24px rgba(56,189,248,.6);
    }

    .team-avatar-core {
        width:100%;
        height:100%;
        border-radius:999px;
        background:
            radial-gradient(circle at 30% 0%, rgba(255,255,255,.45), transparent 70%),
            radial-gradient(circle at 90% 120%, rgba(56,189,248,.7), transparent 65%),
            #020617;
    }

    /* Teks kartu */
    .team-name {
        font-weight:700;
        color:#f9fafb;
        font-size:1.02rem;
        margin-bottom:.15rem;
    }

    .team-role {
        font-size:.86rem;
        color:#a5b4fc;
        margin-bottom:1.1rem;
    }

    .team-divider {
        height:1px;
        width:100%;
        margin:0 auto 1.1rem;
        background: linear-gradient(to right,
            transparent,
            rgba(148,163,184,.7),
            transparent
        );
    }

    .team-meta {
        font-size:.82rem;
        color:#e5e7eb;
        line-height:1.6;
    }

    .team-meta span {
        display:block;
    }

    .team-meta-label {
        color:#9ca3af;
        font-size:.8rem;
    }

    /* Animasi masuk halus */
    .team-card {
        opacity:0;
        transform: translateY(26px);
    }

    .team-card.is-visible {
        opacity:1;
        transform: translateY(0);
        transition:
            opacity .55s ease-out,
            transform .55s ease-out,
            box-shadow .22s ease-out,
            border-color .22s ease-out;
    }
</style>
@endpush

@section('content')
<div class="team-section">

    <div class="team-badge">TIM PENGEMBANG RUANGIN.APP</div>
    <h1 class="team-title">Kenali Tim Kami</h1>
    <p class="team-subtitle">
        Sinergi antara kode, desain, dan pengalaman pengguna. Tim kecil ini merancang Ruangin.app
        untuk membantu pemesanan ruangan kampus menjadi lebih sederhana, rapih, dan nyaman dipakai
        oleh mahasiswa, dosen, maupun admin.
    </p>

    <div class="team-grid" id="team-grid">
        {{-- Anggota 1 --}}
        <div class="team-card">
            <div class="team-card-inner">
                <div class="team-avatar-wrap">
                    <div class="team-avatar-ring">
                        <div class="team-avatar-core"></div>
                    </div>
                </div>
                <div class="team-name">Frendly Great</div>
                <div class="team-role">Project Manager</div>

                <div class="team-divider"></div>

                <div class="team-meta">
                    <span class="team-meta-label">NIM</span>
                    <span>10123381</span>
                    <span class="team-meta-label mt-2">Kelas</span>
                    <span>IF-2A</span>
                </div>
            </div>
        </div>

        {{-- Anggota 2 --}}
        <div class="team-card">
            <div class="team-card-inner">
                <div class="team-avatar-wrap">
                    <div class="team-avatar-ring">
                        <div class="team-avatar-core"></div>
                    </div>
                </div>
                <div class="team-name">Nama Anggota 2</div>
                <div class="team-role">Backend Developer</div>

                <div class="team-divider"></div>

                <div class="team-meta">
                    <span class="team-meta-label">NIM</span>
                    <span>1012xxxx</span>
                    <span class="team-meta-label mt-2">Kelas</span>
                    <span>IF-2A</span>
                </div>
            </div>
        </div>

        {{-- Anggota 3 --}}
        <div class="team-card">
            <div class="team-card-inner">
                <div class="team-avatar-wrap">
                    <div class="team-avatar-ring">
                        <div class="team-avatar-core"></div>
                    </div>
                </div>
                <div class="team-name">Nama Anggota 3</div>
                <div class="team-role">Frontend Developer</div>

                <div class="team-divider"></div>

                <div class="team-meta">
                    <span class="team-meta-label">NIM</span>
                    <span>1012xxxx</span>
                    <span class="team-meta-label mt-2">Kelas</span>
                    <span>IF-2A</span>
                </div>
            </div>
        </div>

        {{-- Anggota 4 --}}
        <div class="team-card">
            <div class="team-card-inner">
                <div class="team-avatar-wrap">
                    <div class="team-avatar-ring">
                        <div class="team-avatar-core"></div>
                    </div>
                </div>
                <div class="team-name">Nama Anggota 4</div>
                <div class="team-role">UI/UX Designer</div>

                <div class="team-divider"></div>

                <div class="team-meta">
                    <span class="team-meta-label">NIM</span>
                    <span>1012xxxx</span>
                    <span class="team-meta-label mt-2">Kelas</span>
                    <span>IF-2A</span>
                </div>
            </div>
        </div>

        {{-- Anggota 5 --}}
        <div class="team-card">
            <div class="team-card-inner">
                <div class="team-avatar-wrap">
                    <div class="team-avatar-ring">
                        <div class="team-avatar-core"></div>
                    </div>
                </div>
                <div class="team-name">Nama Anggota 5</div>
                <div class="team-role">Quality Assurance</div>

                <div class="team-divider"></div>

                <div class="team-meta">
                    <span class="team-meta-label">NIM</span>
                    <span>1012xxxx</span>
                    <span class="team-meta-label mt-2">Kelas</span>
                    <span>IF-2A</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Animasi masuk kartu tim ketika muncul di viewport
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.team-card');

        if (!('IntersectionObserver' in window)) {
            cards.forEach(c => c.classList.add('is-visible'));
            return;
        }

        const obs = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.25 });

        cards.forEach(card => obs.observe(card));
    });
</script>
@endpush
