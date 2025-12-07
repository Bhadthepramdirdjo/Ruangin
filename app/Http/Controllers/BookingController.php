<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function listRuangan()
    {
        // Ambil semua ruangan dan kelompokkan berdasarkan tipe
        $ruanganByType = Ruangan::all()->groupBy('tipe');
        $allRuangans = Ruangan::all();
        
        return view('booking.list_ruangan', compact('ruanganByType', 'allRuangans'));
    }

    public function create($id_ruangan)
    {
        $ruangan = Ruangan::findOrFail($id_ruangan);
        return view('booking.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ruangan_id'    => 'required|exists:ruangan,id',
            'tanggal'       => 'required|date|after_or_equal:today',
            'jam_mulai'     => 'required|date_format:H:i',
            'jam_selesai'   => 'required|date_format:H:i|after:jam_mulai',
            'keperluan'     => 'required|string|max:500',
            'dokumen'       => 'nullable|file|mimes:pdf|max:5120', // max 5MB
        ]);

        $validated['user_id'] = Auth::id();

        // Handle dokumen upload jika ada
        if ($request->hasFile('dokumen')) {
            // akan menghasilkan path seperti: "dokumen/nama_file_random.pdf"
            $path = $request->file('dokumen')->store('dokumen', 'public');
            $validated['dokumen'] = $path;
        }

        $validated['status'] = 'pending';
        $validated['dibuat'] = Carbon::now();

        Booking::create($validated);

        return redirect()
            ->route('booking.history')
            ->with('success', 'Booking berhasil dibuat, menunggu persetujuan');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('ruangan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('booking.my_bookings', compact('bookings'));
    }

    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('ruangan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('booking.history', compact('bookings'));
    }

    // ================== LIHAT DOKUMEN (LAMPIRAN) ==================
    public function showDokumen(Booking $booking)
    {
        // Opsional: pastikan hanya pemilik booking atau admin yang boleh akses
        if (Auth::check() && $booking->user_id !== Auth::id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$booking->dokumen) {
            abort(404, 'Dokumen tidak tersedia.');
        }

        $disk = Storage::disk('public');

        if (!$disk->exists($booking->dokumen)) {
            abort(404, 'File dokumen tidak ditemukan di server.');
        }

        $fullPath = $disk->path($booking->dokumen);

        // Tampilkan langsung di browser (PDF / gambar)
        return response()->file($fullPath);
    }

    // ================== DOWNLOAD DOKUMEN ==================
    public function downloadDokumen(Booking $booking)
    {
        // Opsional: pastikan hanya pemilik booking atau admin yang boleh download
        if (Auth::check() && $booking->user_id !== Auth::id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (!$booking->dokumen) {
            abort(404, 'Dokumen tidak tersedia.');
        }

        $disk = Storage::disk('public');

        if (!$disk->exists($booking->dokumen)) {
            abort(404, 'File dokumen tidak ditemukan di server.');
        }

        // Tentukan ekstensi file
        $ext = pathinfo($booking->dokumen, PATHINFO_EXTENSION);

        // Ambil nama ruangan & user untuk dijadikan nama file
        $ruanganName = optional($booking->ruangan)->nama_ruangan ?? 'Ruangan';
        $user        = $booking->user ?? null;
        $userName    = $user ? ($user->nama ?? $user->name ?? 'User') : 'User';

        // Format tanggal mis: 20251204
        $tanggal = $booking->tanggal
            ? Carbon::parse($booking->tanggal)->format('Ymd')
            : date('Ymd');

        // Bersihkan karakter aneh dari nama supaya aman untuk nama file
        $slugRuangan = preg_replace('/[^A-Za-z0-9\-]+/', '_', $ruanganName);
        $slugUser    = preg_replace('/[^A-Za-z0-9\-]+/', '_', $userName);

        // Contoh hasil: Booking_LabKomputer_1_20251204_Frendly_Great.pdf
        $filename = "Booking_{$slugRuangan}_{$tanggal}_{$slugUser}." . $ext;

        return $disk->download($booking->dokumen, $filename);
    }
}
