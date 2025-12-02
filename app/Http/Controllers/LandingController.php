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
        // 1. Ruangan aktif (sama untuk semua user)
        $totalRuanganAktif = Ruangan::count();

        // 2. Default (untuk guest / belum login)
        $bookingHariIni = 12;
        $bookingPending = 6;

        // 3. Kalau user sudah login, hitung booking miliknya sendiri
        if (Auth::check()) {
            $bookingHariIni = Booking::where('user_id', Auth::id())
                ->whereDate('tanggal', Carbon::today())
                ->count();

            $bookingPending = Booking::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->count();
        }

        return view('landing', compact(
            'totalRuanganAktif',
            'bookingHariIni',
            'bookingPending'
        ));
    }
}
