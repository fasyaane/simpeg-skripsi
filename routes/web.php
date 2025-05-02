<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard setelah login
Route::get('/dashboard', [PegawaiController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route yang butuh login
Route::middleware('auth')->group(function () {
    // Route profile (sudah ada)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔥 Route resource untuk CRUD data pegawai
    Route::resource('pegawai', PegawaiController::class);
});

// Route auth (login, register, dll)
require __DIR__.'/auth.php';
