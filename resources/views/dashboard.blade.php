@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Lembaga</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Lembaga::count() }}</p>
                    <div class="w-10 h-0.5 bg-white/30 rounded-full mt-2"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fas fa-building text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm">Lembaga Aktif</p>
                    <p class="text-3xl font-bold">{{ \App\Models\User::where('role', 'lembaga')->where('status_akun', 'aktif')->count() }}</p>
                    <div class="w-10 h-0.5 bg-white/30 rounded-full mt-2"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm">Perlu Verifikasi</p>
                    <p class="text-3xl font-bold">{{ \App\Models\User::where('role', 'lembaga')->where('status_akun', 'nonaktif')->count() }}</p>
                    <div class="w-10 h-0.5 bg-white/30 rounded-full mt-2"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="group relative overflow-hidden bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-5 text-white shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Total Kategori</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Kategori::count() }}</p>
                    <div class="w-10 h-0.5 bg-white/30 rounded-full mt-2"></div>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Aksi Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-5 py-3">
                <div class="flex items-center gap-2">
                    <i class="fas fa-user-check text-white text-lg"></i>
                    <h3 class="text-lg font-bold text-white">Verifikasi Akun</h3>
                </div>
            </div>
            <div class="p-5">
                <p class="text-gray-600 text-sm mb-4">
                    Terdapat <span class="font-bold text-amber-600">{{ \App\Models\User::where('role', 'lembaga')->where('status_akun', 'nonaktif')->count() }}</span> lembaga yang menunggu verifikasi.
                    Segera aktifkan akun lembaga agar dapat mengakses fitur lengkap.
                </p>
                <a href="{{ route('verifikasi') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-arrow-right"></i> Kelola Verifikasi
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-5 py-3">
                <div class="flex items-center gap-2">
                    <i class="fas fa-tags text-white text-lg"></i>
                    <h3 class="text-lg font-bold text-white">Kelola Kategori</h3>
                </div>
            </div>
            <div class="p-5">
                <p class="text-gray-600 text-sm mb-4">
                    Kelola kategori lembaga sosial. Saat ini terdapat <span class="font-bold text-purple-600">{{ \App\Models\Kategori::count() }}</span> kategori.
                    Tambah, edit, atau hapus kategori sesuai kebutuhan.
                </p>
                <a href="{{ route('kategori.index') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-arrow-right"></i> Kelola Kategori
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-5 py-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-building text-white text-lg"></i>
                <h3 class="text-lg font-bold text-white">Lembaga Terbaru</h3>
            </div>
        </div>
        <div class="p-4">
            @php
                $lembagaBaru = \App\Models\Lembaga::with('user')->latest()->limit(5)->get();
            @endphp
            @forelse($lembagaBaru as $lembaga_item)
            <div class="flex items-center justify-between p-3 border-b border-gray-100 last:border-0 hover:bg-blue-50 transition rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-building text-blue-500 text-sm"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ $lembaga_item->nama_lembaga }}</p>
                        <p class="text-xs text-gray-500">{{ $lembaga_item->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs {{ $lembaga_item->user && $lembaga_item->user->status_akun == 'aktif' ? 'text-green-600 bg-green-100 px-2 py-1 rounded-full' : 'text-amber-600 bg-amber-100 px-2 py-1 rounded-full' }}">
                        {{ $lembaga_item->user && $lembaga_item->user->status_akun == 'aktif' ? 'Aktif' : 'Menunggu Verifikasi' }}
                    </span>
                    @if($lembaga_item->user && $lembaga_item->user->status_akun != 'aktif')
                    <a href="{{ route('verifikasi') }}" class="text-blue-500 hover:text-blue-700 text-xs">
                        <i class="fas fa-check-circle"></i> Verifikasi
                    </a>
                    @endif
                </div>
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