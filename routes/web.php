<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminLaporanController;



// =====================
// HALAMAN UMUM (BOLEH TANPA LOGIN)
// =====================

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// About (boleh dibuka siapa saja)
Route::view('/about', 'about')->name('about');

// =====================
// AUTH (REGISTER & LOGIN)
// =====================

// Penting: nama route GET login harus "login" untuk redirect middleware auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// ROUTE YANG WAJIB LOGIN
// =====================

Route::middleware('auth')->group(function () {

    // Dashboard Mahasiswa
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    // --- Booking Ruangan (User) ---
    Route::get('/ruangan', [BookingController::class, 'listRuangan'])->name('ruangan.list');
    Route::get('/booking/ruangan/{id_ruangan}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/booking/api/available-slots', [BookingController::class, 'getAvailableSlots'])->name('booking.available-slots');
    Route::get('/booking/api/unavailable-dates', [BookingController::class, 'getUnavailableDates'])->name('booking.unavailable-dates');

        // Dokumen booking (lihat & download)
    Route::get('/booking/{booking}/dokumen', [BookingController::class, 'showDokumen'])
        ->name('booking.dokumen.show');

    Route::get('/booking/{booking}/dokumen/download', [BookingController::class, 'downloadDokumen'])
        ->name('booking.dokumen.download');

    // Fitur Profil
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');

});

// =====================
// ADMIN ROUTES (WAJIB ADMIN)
// =====================

Route::middleware(['auth', 'is.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Ruangan management
    Route::get('/ruangan', [AdminDashboardController::class, 'ruanganIndex'])->name('admin.ruangan.index');
    Route::get('/ruangan/create', [AdminDashboardController::class, 'ruanganCreate'])->name('admin.ruangan.create');
    Route::post('/ruangan', [AdminDashboardController::class, 'ruanganStore'])->name('admin.ruangan.store');
    Route::get('/ruangan/{id}/edit', [AdminDashboardController::class, 'ruanganEdit'])->name('admin.ruangan.edit');
    Route::put('/ruangan/{id}', [AdminDashboardController::class, 'ruanganUpdate'])->name('admin.ruangan.update');
    Route::delete('/ruangan/{id}', [AdminDashboardController::class, 'ruanganDelete'])->name('admin.ruangan.destroy');

    // Booking management
    Route::get('/booking', [AdminDashboardController::class, 'bookingIndex'])->name('admin.booking.index');
    Route::get('/booking/{id}', [AdminDashboardController::class, 'bookingShow'])->name('admin.booking.show');
    Route::delete('/booking/{id}', [AdminDashboardController::class, 'bookingDestroy'])
    ->name('admin.booking.destroy');
    Route::post('/booking/{id}/approve', [AdminDashboardController::class, 'bookingApprove'])->name('admin.booking.approve');
    Route::post('/booking/{id}/reject', [AdminDashboardController::class, 'bookingReject'])->name('admin.booking.reject');

    // User role management
    Route::get('/user', [AdminDashboardController::class, 'userIndex'])->name('admin.user.index');
    Route::put('/user/{id}/role', [AdminDashboardController::class, 'userUpdateRole'])->name('admin.user.update-role');
    // Verify/unverify dosen accounts
    Route::put('/user/{id}/verify', [AdminDashboardController::class, 'userVerify'])->name('admin.user.verify');

    // Laporan
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/cetak', [AdminLaporanController::class, 'cetak'])->name('admin.laporan.cetak');
});

