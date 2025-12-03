<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminDashboardController;


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
    Route::get('/booking/saya', [BookingController::class, 'myBookings'])->name('booking.my');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');

        // Dokumen booking (lihat & download)
    Route::get('/booking/{booking}/dokumen', [BookingController::class, 'showDokumen'])
        ->name('booking.dokumen.show');

    Route::get('/booking/{booking}/dokumen/download', [BookingController::class, 'downloadDokumen'])
        ->name('booking.dokumen.download');

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
    Route::post('/booking/{id}/approve', [AdminDashboardController::class, 'bookingApprove'])->name('admin.booking.approve');
    Route::post('/booking/{id}/reject', [AdminDashboardController::class, 'bookingReject'])->name('admin.booking.reject');

    // User role management
    Route::get('/user', [AdminDashboardController::class, 'userIndex'])->name('admin.user.index');
    Route::put('/user/{id}/role', [AdminDashboardController::class, 'userUpdateRole'])->name('admin.user.update-role');
});

