<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Filter Bulan & Tahun
        $bulan = (int) $request->input('bulan', date('m'));
        $tahun = (int) $request->input('tahun', date('Y'));

        // 2. Query Laporan Booking Bulanan
        $laporanBooking = Booking::with(['user', 'ruangan'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('status', 'disetujui') // Hanya yang disetujui yang masuk laporan
            ->orderBy('tanggal', 'asc')
            ->get();

        // 3. Rekap Penggunaan Ruangan (Dalam bulan tersebut)
        $rekapRuangan = Ruangan::withCount(['bookings' => function ($query) use ($bulan, $tahun) {
            $query->whereYear('tanggal', $tahun)
                  ->whereMonth('tanggal', $bulan)
                  ->where('status', 'disetujui');
        }])->get();

        return view('admin.laporan.index', compact('laporanBooking', 'rekapRuangan', 'bulan', 'tahun'));
    }

    public function cetak(Request $request)
    {
        // Versi print friendly
        $bulan = (int) $request->input('bulan', date('m'));
        $tahun = (int) $request->input('tahun', date('Y'));

        $laporanBooking = Booking::with(['user', 'ruangan'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('status', 'disetujui')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('admin.laporan.cetak', compact('laporanBooking', 'bulan', 'tahun'));
    }


}
