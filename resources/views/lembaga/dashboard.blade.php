@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header dengan gradasi biru SAMA seperti sidebar -->
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Dashboard Lembaga</h2>
                <p class="text-blue-100 text-sm">Selamat datang, {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>

    @php
        $lembaga = \App\Models\Lembaga::where('pengguna_id', Auth::id())->first();
    @endphp

    @if(Auth::user()->status_akun != 'aktif')
        <!-- HALAMAN MENUNGGU VERIFIKASI -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-5 py-3">
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock text-white text-lg"></i>
                    <h3 class="text-lg font-bold text-white">Menunggu Verifikasi</h3>
                </div>
            </div>

            <div class="p-5 text-center">
                <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-check text-amber-500 text-3xl"></i>
                </div>

                <h4 class="text-xl font-bold text-gray-800 mb-2">Akun Belum Diverifikasi</h4>
                <p class="text-gray-500 text-sm mb-5 max-w-md mx-auto">
                    Akun Anda masih menunggu verifikasi dari administrator. 
                    Silakan tunggu proses verifikasi.
                </p>

                <div class="bg-amber-50 rounded-xl p-4 mb-5 max-w-sm mx-auto">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Status Akun:</span>
                        <span class="text-xs bg-amber-200 text-amber-800 px-2 py-1 rounded-full font-medium">Menunggu Verifikasi</span>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-xl p-4 mb-5 max-w-sm mx-auto text-left">
                    <p class="font-semibold text-blue-800 text-sm mb-2 flex items-center gap-2">
                        <i class="fas fa-star text-yellow-500 text-xs"></i> Fitur setelah verifikasi:
                    </p>
                    <ul class="space-y-1">
                        <li class="flex items-center gap-2 text-sm text-gray-700">
                            <i class="fas fa-check-circle text-green-500 text-xs"></i> Membuat / Mengedit Profil Lembaga
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-700">
                            <i class="fas fa-check-circle text-green-500 text-xs"></i> Mengelola Informasi Donasi & Anak Asuh
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-700">
                            <i class="fas fa-check-circle text-green-500 text-xs"></i> Mengakses Dashboard Lembaga
                        </li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-lg transition shadow-md">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>

                <p class="text-xs text-gray-400 mt-5">
                    <i class="fas fa-envelope mr-1"></i> Hubungi admin: 
                    <a href="mailto:admin@sisorel.com" class="text-blue-500 hover:underline">admin@sisorel.com</a>
                </p>
            </div>
        </div>
    @elseif(!$lembaga)
        <!-- Belum Punya Profil Lembaga -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-5 py-3">
                <div class="flex items-center gap-2">
                    <i class="fas fa-building text-white text-lg"></i>
                    <h3 class="text-lg font-bold text-white">Buat Profil Lembaga</h3>
                </div>
            </div>
            <div class="p-5 text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-blue-500 text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Profil Lembaga</h4>
                <p class="text-gray-500 text-sm mb-5">Silakan buat profil lembaga Anda terlebih dahulu untuk mulai mengelola informasi donasi.</p>
                <a href="{{ route('lembaga.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] hover:from-[#1e3a8a] hover:to-[#3b82f6] text-white rounded-lg transition shadow-md">
                    <i class="fas fa-plus"></i> Buat Profil Lembaga
                </a>
            </div>
        </div>
    @else
        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-gradient-to-r from-[#0f2b5c] to-[#1e3a8a] rounded-xl p-5 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Jumlah Anak Asuh</p>
                        <p class="text-3xl font-bold">{{ $lembaga->informasi->jumlah_anak_asuh ?? 0 }}</p>
                    </div>
                    <i class="fas fa-child text-4xl text-white/30"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-5 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm">Kebutuhan Donasi</p>
                        <p class="text-3xl font-bold">
                            @php
                                $donasi = json_decode($lembaga->informasi->kebutuhan_donasi_list ?? '', true);
                                echo is_array($donasi) ? count($donasi) : 0;
                            @endphp
                        </p>
                    </div>
                    <i class="fas fa-boxes text-4xl text-white/30"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-5 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Status Kolaborasi</p>
                        <p class="text-3xl font-bold">{{ ($lembaga->informasi->status_kolaborasi ?? '') == 'dibuka' ? 'Dibuka' : 'Ditutup' }}</p>
                    </div>
                    <i class="fas fa-handshake text-4xl text-white/30"></i>
                </div>
            </div>
        </div>

        <!-- Profil & Informasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-building text-blue-500"></i> Profil Lembaga
                </h3>
                <p class="font-semibold">{{ $lembaga->nama_lembaga }}</p>
                <p class="text-gray-500 text-sm mt-1"><i class="fas fa-map-marker-alt mr-2"></i> {{ $lembaga->lokasi ?? $lembaga->alamat ?? '-' }}</p>
                <p class="text-gray-500 text-sm"><i class="fas fa-phone mr-2"></i> {{ $lembaga->kontak ?? '-' }}</p>
                <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" class="inline-flex items-center gap-2 text-blue-600 text-sm mt-3 hover:underline">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-hand-holding-heart text-green-500"></i> Informasi Donasi
                </h3>
                <p><i class="fas fa-child mr-2"></i> Jumlah Anak: {{ $lembaga->informasi->jumlah_anak_asuh ?? 0 }}</p>
                <p class="mt-1"><i class="fas fa-calendar mr-2"></i> Update Terakhir: {{ \Carbon\Carbon::parse($lembaga->informasi->tanggal_update ?? now())->format('d M Y') }}</p>
                <a href="{{ route('informasi.index') }}" class="inline-flex items-center gap-2 text-blue-600 text-sm mt-3 hover:underline">
                    <i class="fas fa-edit"></i> Kelola Informasi
                </a>
            </div>
        </div>
    @endif
</div>
@endsection