<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\InformasiLembagaController;
use App\Http\Controllers\KontakController;

// =======================
// 🌍 HALAMAN PUBLIK
// =======================

Route::get('/', function () {
    $lembaga = \App\Models\Lembaga::with('kategori', 'informasi')->get();
    return view('public.index', compact('lembaga'));
});

Route::get('/public/lembaga/{id}', function ($id) {
    $lembaga = \App\Models\Lembaga::with('kategori', 'informasi')->findOrFail($id);
    return view('public.show', compact('lembaga'));
})->name('public.lembaga.show');

// =======================
// 🔐 AREA LOGIN
// =======================
Route::middleware(['auth'])->group(function () {

    // =======================
    // Halaman pending untuk lembaga yang belum diverifikasi
    // =======================
    Route::get('/lembaga/pending', function () {
        return view('lembaga.pending');
    })->name('lembaga.pending');

    // =======================
    // DASHBOARD
    // =======================
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return view('dashboard');
        } else {
            return view('lembaga.dashboard');
        }
    })->name('dashboard');

    // =======================
    // PROFILE
    // =======================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =======================
    // 📊 KHUSUS ADMIN
    // =======================
    Route::middleware(['admin'])->group(function () {
        Route::get('/verifikasi', [ProfileController::class, 'verifikasi'])->name('verifikasi');
        Route::put('/verifikasi/{id}', [ProfileController::class, 'toggleStatus'])->name('verifikasi.toggle');
        Route::resource('kategori', KategoriController::class);
        

    });

    // =======================
    // 🏢 LEMBAGA
    // =======================
    Route::resource('lembaga', LembagaController::class);
    
    // =======================
    // 📄 INFORMASI LEMBAGA
    // =======================
    Route::resource('informasi', InformasiLembagaController::class);

});

// =======================
require __DIR__.'/auth.php';