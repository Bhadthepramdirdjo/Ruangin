<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    // Dashboard - Overview (Command Center)
    public function dashboard()
    {
        // Overview Stats
        $totalRuangan = Ruangan::count();
        $ruanganAktif = Ruangan::where('status', 'aktif')->count();
        $totalUser = User::where('role', '!=', 'admin')->count();
        $newUsers = User::where('role', '!=', 'admin')->latest()->limit(30)->count(); // users dari 30 hari terakhir
        $totalBooking = Booking::count();
        $pendingBooking = Booking::where('status', 'pending')->count();
        $approvedBooking = Booking::where('status', 'disetujui')->count();
        $rejectedBooking = Booking::where('status', 'ditolak')->count();
        $bookingHariIni = Booking::whereDate('tanggal', Carbon::today())->count();
        $bookingDenganDokumen = Booking::whereNotNull('dokumen')->count();

        // Pending Bookings (untuk task list)
        $bookingPending = Booking::with('ruangan', 'user')
            ->where('status', 'pending')
            ->latest('dibuat')
            ->limit(5)
            ->get();

        // New Users (untuk task list)
        $userBaru = User::where('role', '!=', 'admin')
            ->latest('dibuat')
            ->limit(5)
            ->get();

        // Recent Bookings (untuk tabel)
        $recentBookings = Booking::with('ruangan', 'user')
            ->latest('dibuat')
            ->limit(20)
            ->get();

        // Ruangan List (untuk status table)
        $ruanganList = Ruangan::with(['bookings' => function($query) {
            $query->whereDate('tanggal', Carbon::today());
        }])->get();

        // Add booking count for each ruangan
        $ruanganList->each(function($ruangan) {
            $ruangan->bookingHariIni = $ruangan->bookings->count();
        });

        return view('admin.dashboard', compact(
            'totalRuangan',
            'ruanganAktif',
            'totalUser',
            'newUsers',
            'totalBooking',
            'pendingBooking',
            'approvedBooking',
            'rejectedBooking',
            'bookingHariIni',
            'bookingDenganDokumen',
            'bookingPending',
            'userBaru',
            'recentBookings',
            'ruanganList'
        ));
    }

    // Ruangan - List
    public function ruanganIndex()
    {
        $ruangans = Ruangan::paginate(10);
        return view('admin.ruangan.index', compact('ruangans'));
    }

    // Ruangan - Create
    public function ruanganCreate()
    {
        return view('admin.ruangan.create');
    }

    // Ruangan - Store
    public function ruanganStore(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:100',
            'kode' => 'required|string|max:50|unique:ruangan,kode',
            'kapasitas' => 'required|integer|min:1|max:500',
            'tipe' => 'required|string|in:kelas,laboratorium,seminar,meeting',
            'status' => 'required|string|in:aktif,nonaktif',
        ]);

        $validated['dibuat'] = Carbon::now();
        $validated['diubah'] = Carbon::now();

        Ruangan::create($validated);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    // Ruangan - Edit
    public function ruanganEdit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    // Ruangan - Update
    public function ruanganUpdate(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:100',
            'kode' => 'required|string|max:50|unique:ruangan,kode,' . $id . ',id',
            'kapasitas' => 'required|integer|min:1|max:500',
            'tipe' => 'required|string|in:kelas,laboratorium,seminar,meeting',
            'status' => 'required|string|in:aktif,nonaktif',
        ]);

        $validated['diubah'] = Carbon::now();
        $ruangan->update($validated);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    // Ruangan - Delete
    public function ruanganDelete($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }

    // Booking - List
    public function bookingIndex(Request $request)
    {
        $status = $request->get('status');
        $query = Booking::with('ruangan', 'user');

        if ($status) {
            $query->where('status', $status);
        }

        $bookings = $query->latest('tanggal')->paginate(10);
        $statuses = ['pending', 'disetujui', 'ditolak'];

        return view('admin.booking.index', compact('bookings', 'status', 'statuses'));
    }

    // Booking - Show & Approve/Reject
    public function bookingShow($id)
    {
        $booking = Booking::with('ruangan', 'user')->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    public function bookingApprove($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'disetujui', 'diubah' => Carbon::now()]);

        return redirect()->route('admin.booking.index')->with('success', 'Booking disetujui.');
    }

    public function bookingReject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'ditolak', 'diubah' => Carbon::now()]);

        return redirect()->route('admin.booking.index')->with('success', 'Booking ditolak.');
    }

    // User - List & Manage Role
    public function userIndex(Request $request)
    {
        $query = User::where('role', '!=', 'admin');

        // Search by name
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function userUpdateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role' => 'required|in:mahasiswa,dosen',
        ]);

        $user->update($validated);

        return redirect()->route('admin.user.index')->with('success', 'Role user berhasil diperbarui.');
    }

    /**
     * Verify or unverify a user (used for dosen verification).
     */
    public function userVerify(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'is_verified' => 'required|boolean',
        ]);

        $user->is_verified = $validated['is_verified'];
        $user->save();

        $msg = $user->is_verified ? 'Akun berhasil diverifikasi.' : 'Akun diverifikasi dibatalkan.';
        return redirect()->route('admin.user.index')->with('success', $msg);
    }
    public function bookingDestroy($id)
{
    $booking = Booking::findOrFail($id);

    // kalau ada dokumen lampiran dan ingin ikut dihapus, bisa ditambahkan di sini

    $booking->delete();

    return redirect()->route('admin.booking.index')
                     ->with('success', 'Booking berhasil dihapus.');
}

}
