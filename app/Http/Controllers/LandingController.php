<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // Jika user sudah login, redirect ke dashboard mahasiswa
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // 1. Ruangan aktif (sama untuk semua user)
        try {
            $totalRuanganAktif = Ruangan::count();
        } catch (\Exception $e) {
            $totalRuanganAktif = 0;
        }

        // 2. Default (untuk guest / belum login)
        $bookingHariIni = 12;
        $bookingPending = 6;

        return view('landing', compact(
            'totalRuanganAktif',
            'bookingHariIni',
            'bookingPending'
        ));
    }
}
