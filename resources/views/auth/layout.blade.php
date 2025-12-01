<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ruangin') }}</title>
    @php
      $hasHot = file_exists(public_path('hot'));
      $hasManifest = file_exists(public_path('build/manifest.json'));
    @endphp

    @if ($hasHot || $hasManifest)
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      {{-- Fallback to plain assets to avoid Vite manifest exception during dev setup --}}
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
  </head>
  <body class="min-h-screen bg-[#020202] text-white font-sans">
    <div class="absolute inset-0 overflow-hidden">
      <!-- floating orbs / mesh gradients -->
      <div class="pointer-events-none absolute -left-10 -top-10 w-72 h-72 rounded-full bg-gradient-to-br from-indigo-600 via-pink-500 to-cyan-400 opacity-30 blur-3xl animate-blob" style="filter: blur(60px);"></div>
      <div class="pointer-events-none absolute -right-20 -bottom-10 w-96 h-96 rounded-full bg-gradient-to-tr from-cyan-400 via-indigo-600 to-pink-500 opacity-20 blur-3xl animate-blob animation-delay-2000" style="filter: blur(80px);"></div>
    </div>

    <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
      <div class="w-full max-w-md">
        <div class="backdrop-blur-[20px] bg-white/5 border border-white/10 rounded-xl p-8 shadow-2xl">
          <div class="mb-6 text-center">
            <h1 class="text-3xl font-extrabold text-white">@yield('page_title', config('app.name', 'Ruangin'))</h1>
            <p class="text-sm text-slate-300">Sistem pemesanan ruang sederhana</p>
          </div>

          @yield('content')

        </div>
      </div>
    </div>

    <style>
      @keyframes blob { 0%{transform:translate(0px,0px) scale(1)}33%{transform:translate(20px,-10px) scale(1.05)}66%{transform:translate(-20px,10px) scale(0.95)}100%{transform:translate(0px,0px) scale(1)} }
      .animate-blob{ animation: blob 8s infinite; }
      .animation-delay-2000{ animation-delay: 2s; }
    </style>
  </body>
</html>
