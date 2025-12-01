<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role ?? 'mahasiswa';
        return match($role) {
            'admin' => redirect('/admin/dashboard'),
            'dosen' => redirect('/dosen/dashboard'),
            default => redirect('/mahasiswa/dashboard'),
        };
    }

    return redirect()->route('auth.showLogin');
});

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Simple role dashboards
Route::get('/admin/dashboard', function(){ return view('dashboard.admin'); })->middleware('auth');
Route::get('/dosen/dashboard', function(){ return view('dashboard.dosen'); })->middleware('auth');
Route::get('/mahasiswa/dashboard', function(){ return view('dashboard.mahasiswa'); })->middleware('auth');
