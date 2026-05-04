@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Dashboard Admin</h2>
                <p class="text-blue-100 text-sm">Selamat datang, {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Card Total Lembaga -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Lembaga</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Lembaga::count() }}</p>
                </div>
                <i class="fas fa-building text-4xl text-white/30"></i>
            </div>
        </div>

        <!-- Card Lembaga Aktif -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm">Lembaga Aktif</p>
                    <p class="text-3xl font-bold">{{ \App\Models\User::where('role', 'lembaga')->where('status_akun', 'aktif')->count() }}</p>
                </div>
                <i class="fas fa-check-circle text-4xl text-white/30"></i>
            </div>
        </div>

        <!-- Card Lembaga Pending -->
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm">Menunggu Verifikasi</p>
                    <p class="text-3xl font-bold">{{ \App\Models\User::where('role', 'lembaga')->where('status_akun', 'nonaktif')->count() }}</p>
                </div>
                <i class="fas fa-clock text-4xl text-white/30"></i>
            </div>
        </div>

        <!-- Card Total Kategori -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Total Kategori</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Kategori::count() }}</p>
                </div>
                <i class="fas fa-tags text-4xl text-white/30"></i>
            </div>
        </div>
    </div>

    <!-- Lembaga Terbaru -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-clock text-blue-500"></i> Lembaga Terbaru
        </h3>
        <div class="space-y-3">
            @forelse(\App\Models\Lembaga::with('user')->latest()->limit(5)->get() as $lembaga_item)
            <div class="flex items-center justify-between p-3 border-b border-gray-100">
                <div>
                    <p class="font-semibold text-gray-800">{{ $lembaga_item->nama_lembaga }}</p>
                    <p class="text-sm text-gray-500">{{ $lembaga_item->user->email ?? '-' }}</p>
                </div>
                <span class="text-xs {{ $lembaga_item->user && $lembaga_item->user->status_akun == 'aktif' ? 'text-green-600' : 'text-red-600' }}">
                    {{ $lembaga_item->user && $lembaga_item->user->status_akun == 'aktif' ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-building text-4xl text-gray-300 mb-2"></i>
                <p class="text-gray-500">Belum ada lembaga terdaftar</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection