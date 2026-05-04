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
                <h2 class="text-xl font-bold text-white">Dashboard Lembaga</h2>
                <p class="text-blue-100 text-sm">Selamat datang, {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>

    @php
        $lembaga = \App\Models\Lembaga::where('pengguna_id', Auth::id())->first();
    @endphp

    @if(Auth::user()->status_akun != 'aktif')
        <!-- Akun Belum Diverifikasi -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-6 text-center max-w-2xl mx-auto">
            <i class="fas fa-clock text-4xl text-yellow-600 mb-3"></i>
            <h2 class="text-xl font-bold text-yellow-800 mb-2">Akun Belum Diverifikasi</h2>
            <p class="text-yellow-700">Akun Anda masih menunggu verifikasi dari admin. Fitur akan aktif setelah diverifikasi.</p>
        </div>
    @elseif(!$lembaga)
        <!-- Belum Punya Profil Lembaga -->
        <div class="bg-blue-50 rounded-xl p-6 text-center max-w-2xl mx-auto">
            <i class="fas fa-building text-4xl text-blue-600 mb-3"></i>
            <h2 class="text-xl font-bold text-blue-800 mb-2">Belum Ada Profil Lembaga</h2>
            <p class="text-blue-700 mb-4">Silakan buat profil lembaga Anda terlebih dahulu</p>
            <a href="{{ route('lembaga.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-xl inline-flex items-center gap-2 hover:shadow-lg transition">
                <i class="fas fa-plus"></i> Buat Profil Lembaga
            </a>
        </div>
    @else
        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-5 text-white shadow-lg">
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