<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\InformasiLembagaController;
use App\Http\Controllers\PageController;

// =======================
// 🌍 HALAMAN PUBLIK (Tanpa Login)
// =======================

// Halaman Utama (Landing Page)
Route::get('/', function () {
    $lembaga = \App\Models\Lembaga::with('kategori', 'informasi')->get();
    return view('index', compact('lembaga'));
})->name('home');

// Halaman Detail Lembaga untuk Publik
Route::get('/public/lembaga/{id}', function ($id) {
    $lembaga = \App\Models\Lembaga::with('kategori', 'informasi')->findOrFail($id);
    return view('public.show', compact('lembaga'));
})->name('public.lembaga.show');

// Halaman Statis (Tentang & Panduan)
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/panduan', [PageController::class, 'panduan'])->name('panduan');

// =======================
// 🔐 AREA LOGIN (Harus Login)
// =======================
Route::middleware(['auth'])->group(function () {

    // Halaman Pending untuk Lembaga Belum Diverifikasi
    Route::get('/lembaga/pending', function () {
        return view('lembaga.pending');
    })->name('lembaga.pending');

    // Dashboard (berdasarkan role)
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return view('dashboard');
        } else {
            return view('lembaga.dashboard');
        }
    })->name('dashboard');

    // Profile Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =======================
    // 📊 KHUSUS ADMIN
    // =======================
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/verifikasi', [ProfileController::class, 'verifikasi'])->name('verifikasi');
        Route::put('/verifikasi/{id}', [ProfileController::class, 'toggleStatus'])->name('verifikasi.toggle');
        Route::resource('kategori', KategoriController::class);
    });

    // =======================
    // 🏢 LEMBAGA (Admin & Lembaga)
    // =======================
    Route::resource('lembaga', LembagaController::class);
    
    // =======================
    // 📄 INFORMASI LEMBAGA (Admin & Lembaga)
    // =======================
    Route::resource('informasi', InformasiLembagaController::class);
});
Route::get('/verifikasi-test', function () {
    $users = App\Models\User::where('role', 'lembaga')->get();
    
    // Langsung return JSON biar jelas
    return response()->json([
        'total' => $users->count(),
        'data' => $users->map(function($u) {
            return [
                'name' => $u->name,
                'email' => $u->email,
                'status' => $u->status_akun
            ];
        })
    ]);
});
require __DIR__.'/auth.php';