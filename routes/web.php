<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;


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

    // --- Manajemen Ruangan (Admin) ---
    Route::get('/admin/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/admin/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/admin/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/admin/ruangan/{id_ruangan}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/admin/ruangan/{id_ruangan}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/admin/ruangan/{id_ruangan}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    // --- Booking Ruangan (User) ---
    Route::get('/ruangan', [BookingController::class, 'listRuangan'])->name('ruangan.list');
    Route::get('/booking/ruangan/{id_ruangan}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/saya', [BookingController::class, 'myBookings'])->name('booking.my');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
});

