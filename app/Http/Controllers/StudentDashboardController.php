<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // 1. RINGKASAN STATUS BOOKING
        $pendingBookings = Booking::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $todayBookings = Booking::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->where('status', 'disetujui')
            ->count();

        $rejectedBookings = Booking::where('user_id', $user->id)
            ->where('status', 'ditolak')
            ->count();

        $activeBookings = Booking::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->where('tanggal', '>', $today)
            ->count();

        // 2. BOOKING PENDING (untuk ditampilkan detail)
        $bookingsPending = Booking::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('ruangan')
            ->orderBy('dibuat', 'desc')
            ->get();

        // 3. BOOKING HARI INI
        $bookingsToday = Booking::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->where('status', 'disetujui')
            ->with('ruangan')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // 4. BOOKING AKTIF TERDEKAT (jadwal masih jauh)
        $upcomingBookings = Booking::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->where('tanggal', '>', $today)
            ->with('ruangan')
            ->orderBy('tanggal', 'asc')
            ->limit(5)
            ->get();

        // 5. RIWAYAT SINGKAT (3-5 terakhir)
        $recentBookings = Booking::where('user_id', $user->id)
            ->with('ruangan')
            ->orderBy('dibuat', 'desc')
            ->limit(5)
            ->get();

        // 6. RUANGAN YANG SERING DIPAKE
        $frequentRooms = Booking::select('ruangan_id')
            ->where('user_id', $user->id)
            ->groupBy('ruangan_id')
            ->orderByRaw('count(*) desc')
            ->limit(4)
            ->pluck('ruangan_id')
            ->toArray();

        $frequentRoomDetails = Ruangan::whereIn('id', $frequentRooms)
            ->get()
            ->keyBy('id')
            ->map(function($room) use ($frequentRooms) {
                $room->count = Booking::where('user_id', Auth::id())
                    ->where('ruangan_id', $room->id)
                    ->count();
                return $room;
            })
            ->sortByDesc('count');

        // 7. NOTIFIKASI PENTING
        $notifications = $this->generateNotifications($user->id, $today);

        return view('dashboard.student', compact(
            'user',
            'pendingBookings',
            'todayBookings',
            'rejectedBookings',
            'activeBookings',
            'bookingsPending',
            'bookingsToday',
            'upcomingBookings',
            'recentBookings',
            'frequentRoomDetails',
            'notifications'
        ));
    }

    private function generateNotifications($userId, $today)
    {
        $notifications = [];

        // Notifikasi booking disetujui hari ini
        $approvedToday = Booking::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->whereDate('tanggal', $today)
            ->count();

        if ($approvedToday > 0) {
            $notifications[] = [
                'type' => 'success',
                'message' => "Anda memiliki $approvedToday booking yang disetujui untuk hari ini."
            ];
        }

        // Notifikasi booking pending
        $pending = Booking::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        if ($pending > 0) {
            $notifications[] = [
                'type' => 'info',
                'message' => "Ada $pending booking Anda yang masih menunggu persetujuan."
            ];
        }

        // Notifikasi booking ditolak
        $rejected = Booking::where('user_id', $userId)
            ->where('status', 'ditolak')
            ->count();

        if ($rejected > 0) {
            $notifications[] = [
                'type' => 'warning',
                'message' => "$rejected booking Anda telah ditolak. Silakan buat booking baru."
            ];
        }

        return $notifications;
    }
}
