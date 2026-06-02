<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\InformasiLembagaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DonasiController;

Route::get('/', function () {
    $lembaga = \App\Models\Lembaga::whereHas('user', function($q) {
        $q->where('status_akun', 'aktif');
    })->with('kategori', 'informasi')->get();
    return view('index', compact('lembaga'));
})->name('home');

Route::get('/public/lembaga/{id}', function ($id) {
    $lembaga = \App\Models\Lembaga::with('kategori', 'informasi')->findOrFail($id);
    if ($lembaga->user && $lembaga->user->status_akun !== 'aktif') {
        return redirect('/')->with('error', 'Lembaga ini sedang tidak aktif.');
    }
    return view('public.show', compact('lembaga'));
})->name('public.lembaga.show');

Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/panduan', [PageController::class, 'panduan'])->name('panduan');

Route::get('/lembaga/pending', function () {
    return view('lembaga.pending');
})->name('lembaga.pending');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return view('dashboard');
        } else {
            $lembaga = \App\Models\Lembaga::where('pengguna_id', auth()->id())->first();
            return view('lembaga.dashboard', compact('lembaga'));
        }
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/verifikasi', [ProfileController::class, 'verifikasi'])->name('verifikasi');
        Route::put('/verifikasi/{id}', [ProfileController::class, 'toggleStatus'])->name('verifikasi.toggle');
        Route::resource('kategori', KategoriController::class);
        Route::get('/admin/detail-lembaga/{id}', [App\Http\Controllers\AdminController::class, 'detailLembaga'])->name('admin.detail.lembaga');
    });

    Route::resource('lembaga', LembagaController::class);
    Route::resource('informasi', InformasiLembagaController::class);
    Route::post('/informasi/kebutuhan/update/{id}', [InformasiLembagaController::class, 'updateKebutuhan'])->name('informasi.kebutuhan.update');
    Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::put('/donasi/konfirmasi/{id}', [DonasiController::class, 'konfirmasi'])->name('donasi.konfirmasi');
    Route::put('/donasi/update-terkumpul/{id}', [DonasiController::class, 'updateTerkumpulManual'])->name('donasi.updateTerkumpul');
});

Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');

Route::get('/verifikasi-test', function () {
    $users = App\Models\User::where('role', 'lembaga')->get();
    
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