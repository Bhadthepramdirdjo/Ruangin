<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Ruangin.app - Booking Ruangan Kampus')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --bg-main: #050816;
            --accent-purple: #a855f7;
            --accent-blue: #22d3ee;
            --accent-pink: #ec4899;
            --text-muted: #9ca3af;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #e5e7eb;
            background:
                radial-gradient(circle at 0% 0%, rgba(168,85,247,0.4), transparent 55%),
                radial-gradient(circle at 100% 100%, rgba(56,189,248,0.4), transparent 55%),
                radial-gradient(circle at 0% 100%, rgba(236,72,153,0.35), transparent 55%),
                var(--bg-main);
            background-attachment: fixed;
            animation: bgPulse 16s ease-in-out infinite alternate;
        }

        @keyframes bgPulse {
            0% {
                background-position: 0% 0%, 100% 100%, 0% 100%;
            }
            100% {
                background-position: 10% 5%, 90% 95%, 5% 90%;
            }
        }

        .navbar-custom {
            background: rgba(10, 10, 26, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(148,163,184,0.22);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-size: 0.8rem;
            color: #e5e7eb !important;
        }

        .navbar-brand span {
            background: linear-gradient(120deg, var(--accent-purple), var(--accent-blue));
            -webkit-background-clip: text;
            color: transparent;
        }

        .nav-link {
            color: #cbd5f5 !important;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            color: var(--accent-blue) !important;
        }

        .btn-ghost {
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.5);
            font-size: 0.85rem;
            color: #e5e7eb;
            background: transparent;
        }

        .btn-ghost:hover {
            border-color: var(--accent-blue);
            color: var(--accent-blue);
            background: rgba(15,23,42,0.8);
        }

        .gradient-btn {
            border-radius: 999px;
            border: none;
            padding-inline: 1.6rem;
            background-image: linear-gradient(120deg, var(--accent-purple), var(--accent-blue));
            color: white;
            font-weight: 600;
            box-shadow: 0 16px 40px rgba(59,130,246,0.4);
            position: relative;
            overflow: hidden;
        }

        .gradient-btn::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 0 0, rgba(255,255,255,0.35), transparent 55%);
            opacity: 0;
            transition: opacity 0.25s ease-out;
        }

        .gradient-btn:hover::after {
            opacity: 1;
        }

        .page-wrapper {
            padding-block: 2.5rem 3rem;
        }

        .card-glass {
            position: relative;
            background: radial-gradient(circle at top left, rgba(148,163,184,0.18), transparent 55%),
                        radial-gradient(circle at bottom right, rgba(30,64,175,0.4), transparent 55%),
                        rgba(15,23,42,0.88);
            border-radius: 22px;
            border: 1px solid rgba(148,163,184,0.28);
            box-shadow:
                0 18px 50px rgba(15,23,42,0.9),
                0 0 0 1px rgba(15,23,42,0.9);
        }

        .section-title {
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 0.6rem;
            background: linear-gradient(120deg, #e5e7eb, #c4b5fd, #22d3ee);
            -webkit-background-clip: text;
            color: transparent;
        }

        .section-subtitle {
            color: var(--text-muted);
            max-width: 560px;
        }

        footer {
            border-top: 1px solid rgba(148,163,184,0.3);
            background: rgba(5,6,24,0.9);
        }

        .fade-in-up {
            opacity: 0;
            transform: translateY(12px);
            animation: fadeInUp 0.7s ease-out forwards;
        }

        .fade-in-up.delay-1 { animation-delay: 0.15s; }
        .fade-in-up.delay-2 { animation-delay: 0.3s; }
        .fade-in-up.delay-3 { animation-delay: 0.45s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-orb {
            position: absolute;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, #ffffff, transparent 60%);
            opacity: 0.08;
            filter: blur(1px);
            animation: floatOrb 12s ease-in-out infinite alternate;
        }

        .floating-orb.orb-1 {
            top: -40px;
            right: -20px;
        }

        .floating-orb.orb-2 {
            bottom: -40px;
            left: -10px;
            animation-delay: 1.5s;
        }

        @keyframes floatOrb {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(20px, -10px, 0); }
        }

        /* biar toggler icon kelihatan */
        .navbar-toggler {
            border-color: rgba(148,163,184,0.6);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28248,250,252, 0.7%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>

    @stack('styles')
</head>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const counters = document.querySelectorAll('.js-countup');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target') || '0', 10);

        // Kalau target-nya 0, tidak usah animasi panjang2
        if (!target) {
            counter.textContent = '0';
            return;
        }

        const duration = 1200; // total durasi animasi (ms)
        const startTime = performance.now();

        // Easing: cepat di awal, melambat di akhir
        function easeOutQuad(t) {
            return t * (2 - t); // 0..1 -> 0..1
        }

        function update(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);   // 0..1
            const eased = easeOutQuad(progress);
            const value = Math.floor(eased * target);

            // Format angka pakai locale Indonesia (pakai titik ribuan kalau besar)
            counter.textContent = value.toLocaleString('id-ID');

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                // pastikan akhir tepat di target
                counter.textContent = target.toLocaleString('id-ID');
            }
        }

        requestAnimationFrame(update);
    });
});
</script>
@endpush

<body>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">
            RUANGIN<span>.APP</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('landing') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ruangan.list') }}">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking.my') }}">Booking Saya</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown">
                            {{ auth()->user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="px-3 py-2 text-muted small">
                                Role: {{ auth()->user()->role }}
                            </li>
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('ruangan.index') }}">
                                        Kelola Ruangan
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-3">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-link p-0 text-danger text-decoration-none">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-ghost me-2" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="gradient-btn" href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="page-wrapper">
    @yield('content')
</main>

<footer class="text-center text-muted py-4">
    <small>© {{ date('Y') }} Ruangin.app · Sistem Booking Ruangan Kampus</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
