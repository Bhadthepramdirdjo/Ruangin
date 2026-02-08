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
        $allRuangans   = Ruangan::all();

        return view('booking.list_ruangan', compact('ruanganByType', 'allRuangans'));
    }

    public function create($id_ruangan)
    {
        $ruangan = Ruangan::findOrFail($id_ruangan);
        $user = Auth::user();
        
        // Validasi: Mahasiswa tidak boleh booking LAB
        if ($user->role === 'mahasiswa' && strtolower($ruangan->tipe) === 'lab') {
            return redirect()
                ->route('ruangan.list')
                ->with('error', 'Maaf, Anda (mahasiswa) tidak dapat booking ruangan tipe Lab. Lab hanya dapat di-booking oleh Dosen.');
        }
        
        return view('booking.create', compact('ruangan', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $validated = $request->validate(
            [
                'ruangan_id'  => 'required|exists:ruangan,id',
                'tanggal'     => 'required|date|after_or_equal:today',
                'jam_mulai'   => 'required|date_format:H:i',
                'jumlah_sks'  => 'required|integer|min:1|max:12',
                'keperluan'   => 'required|string|max:500',
                'dokumen'     => 'required|file|mimes:pdf|max:5120', // max 5MB
            ],
            [
                'dokumen.required' => 'Lampiran surat peminjaman wajib diunggah.',
                'dokumen.mimes'    => 'Lampiran harus berupa file PDF.',
                'dokumen.max'      => 'Ukuran lampiran maksimal 5MB.',
                'jumlah_sks.required' => 'Pilih durasi SKS yang diinginkan.',
                'jumlah_sks.min'   => 'Durasi minimal 1 SKS (50 menit).',
                'jumlah_sks.max'   => 'Durasi maksimal 12 SKS.',
            ]
        );

        // Validasi role: Mahasiswa tidak boleh booking Lab
        $user = Auth::user();
        $ruangan = Ruangan::findOrFail($validated['ruangan_id']);
        
        if ($user->role === 'mahasiswa' && strtolower($ruangan->tipe) === 'lab') {
            return redirect()
                ->back()
                ->with('error', 'Maaf, Anda (mahasiswa) tidak dapat booking ruangan tipe Lab.');
        }

        // Validasi durasi SKS: jam_mulai + (jumlah_sks * 50 menit) tidak boleh melebihi jam 18:00
        $jamMulai = Carbon::createFromFormat('H:i', $validated['jam_mulai']);
        $durationMinutes = $validated['jumlah_sks'] * 50;
        $jamSelesai = $jamMulai->copy()->addMinutes($durationMinutes);
        $jamOperasionalAkhir = Carbon::createFromFormat('H:i', '18:00');

        if ($jamSelesai->gt($jamOperasionalAkhir)) {
            $maxSks = floor(($jamOperasionalAkhir->diffInMinutes($jamMulai)) / 50);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "SKS yang Anda pilih melebihi batas jam operasional. Jam mulai {$validated['jam_mulai']} hanya dapat di-booking maksimal {$maxSks} SKS (" . ($maxSks * 50) . " menit).");
        }

        $validated['user_id'] = Auth::id();

        // Simpan file dokumen (wajib ada karena rule "required")
        if ($request->hasFile('dokumen')) {
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
        // boleh diakses pemilik booking atau admin
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

        return response()->file($fullPath);
    }

    // ================== DOWNLOAD DOKUMEN ==================
    public function downloadDokumen(Booking $booking)
    {
        // boleh diakses pemilik booking atau admin
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

        $ext = pathinfo($booking->dokumen, PATHINFO_EXTENSION);

        $ruanganName = optional($booking->ruangan)->nama_ruang ?? 'Ruangan';
        $user        = $booking->user ?? null;
        $userName    = $user ? ($user->nama ?? $user->name ?? 'User') : 'User';

        $tanggal = $booking->tanggal
            ? Carbon::parse($booking->tanggal)->format('Ymd')
            : date('Ymd');

        $slugRuangan = preg_replace('/[^A-Za-z0-9\-]+/', '_', $ruanganName);
        $slugUser    = preg_replace('/[^A-Za-z0-9\-]+/', '_', $userName);

        $filename = "Booking_{$slugRuangan}_{$tanggal}_{$slugUser}." . $ext;

        return $disk->download($booking->dokumen, $filename);
    }
}
