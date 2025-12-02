<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'ruangan_id' => 'required|exists:ruangan,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keperluan' => 'required|string|max:500',
            'dokumen' => 'nullable|file|mimes:pdf|max:5120', // max 5MB
        ]);

        $validated['user_id'] = Auth::id();
        // Handle dokumen upload jika ada
        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('dokumen', 'public');
            $validated['dokumen'] = $path;
        }

        $validated['status'] = 'pending';
        $validated['dibuat'] = Carbon::now();

        Booking::create($validated);

        return redirect()->route('booking.my')->with('success', 'Booking berhasil dibuat, menunggu persetujuan');
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
}
