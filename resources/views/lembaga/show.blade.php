@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ route('lembaga.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Daftar Lembaga
        </a>

        <!-- Header Profil -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden mb-6">
    <div class="px-6 py-6">
        <div class="flex flex-wrap justify-between items-start gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-building text-white text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $lembaga->nama_lembaga }}</h1>
                    <div class="flex items-center gap-2 mt-2">
                        @php
                            $statusKolab = '';
                            if(isset($lembaga->informasi) && isset($lembaga->informasi->status_kolaborasi)) {
                                $statusKolab = $lembaga->informasi->status_kolaborasi;
                            }
                        @endphp
                        @if($statusKolab == 'dibuka')
    <div class="bg-green-100 border-l-4 border-green-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
        <i class="fas fa-handshake text-green-600 text-sm"></i>
        <span class="text-green-700 font-semibold text-sm">Dibuka untuk Kolaborasi</span>
    </div>
@elseif($statusKolab == 'ditutup')
    <div class="bg-red-100 border-l-4 border-red-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
        <i class="fas fa-lock text-red-600 text-sm"></i>
        <span class="text-red-700 font-semibold text-sm">Tidak Membuka Kolaborasi</span>
    </div>
@else
    <div class="bg-gray-100 border-l-4 border-gray-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
        <i class="fas fa-clock text-gray-600 text-sm"></i>
        <span class="text-gray-700 font-semibold text-sm">Belum Ada Informasi Kolaborasi</span>
    </div>
@endif
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                @if(Auth::user()->role == 'admin')
        <a href="{{ route('informasi.show', $lembaga->lembaga_id) }}" 
           class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-5 py-2 rounded-xl transition-all duration-200 inline-flex items-center gap-2 shadow-md hover:shadow-lg">
            <i class="fas fa-hand-holding-heart"></i> Lihat Donasi
        </a>
                @else
                    <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-xl transition inline-flex items-center gap-2">
                        <i class="fas fa-edit"></i> Edit Lembaga
                    </a>
                    <a href="{{ route('informasi.show', $lembaga->lembaga_id) }}" 
                       class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl transition inline-flex items-center gap-2">
                        <i class="fas fa-hand-holding-heart"></i> Lihat Donasi
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

        <!-- Konten Utama 2 Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri (Informasi Dasar & Kontak) -->
            <div class="lg:col-span-1 space-y-5">
                <!-- Card Informasi Dasar -->
                <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                        <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-info-circle text-blue-500 text-sm"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Informasi Dasar</h3>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">📍 Lokasi</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga->lokasi ?? $lembaga->alamat ?? 'Tidak tersedia' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">📞 Kontak</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga->kontak ?? 'Tidak tersedia' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">📧 Email Lembaga</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card Info Pengguna -->
                <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                        <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-circle text-purple-500 text-sm"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Info Pengguna</h3>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Pengguna</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga->user->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Status Akun</p>
                            @if($lembaga->user && $lembaga->user->status_akun == 'aktif')
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-circle text-[6px] text-green-500"></i> Aktif
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-circle text-[6px] text-red-500"></i> Nonaktif
                                </span>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Jenis Lembaga</p>
                            <p class="text-gray-800 font-medium">{{ ucfirst($lembaga->user->jenis_lembaga ?? '-') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Tahun Berdiri</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga->user->tahun_berdiri ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan (Kategori, Visi, Misi, Deskripsi) -->
            <div class="lg:col-span-2 space-y-5">
                <!-- Card Kategori -->
                <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tags text-emerald-500 text-sm"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Kategori Lembaga</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @forelse($lembaga->kategori as $kat)
                            <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium shadow-sm">
                                {{ $kat->nama_kategori }}
                            </span>
                        @empty
                            <span class="text-gray-500 text-sm">Tidak ada kategori</span>
                        @endforelse
                    </div>
                </div>

                <!-- Card Visi -->
                @if($lembaga->visi)
                <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                        <div class="w-8 h-8 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-eye text-indigo-500 text-sm"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Visi</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">{{ $lembaga->visi }}</p>
                </div>
                @endif

                <!-- Card Misi -->
                @if($lembaga->misi)
                <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                        <div class="w-8 h-8 bg-rose-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-bullseye text-rose-500 text-sm"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Misi</h3>
                    </div>
                    <div class="space-y-2">
                        @php
                            $misiList = explode("\n", $lembaga->misi);
                        @endphp
                        @foreach($misiList as $index => $misi)
                            @if(trim($misi))
                            <div class="flex items-start gap-2">
                                <div class="w-5 h-5 bg-rose-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-rose-500 text-xs font-bold">{{ $index + 1 }}</span>
                                </div>
                                <p class="text-gray-700">{{ trim($misi) }}</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Card Deskripsi -->
                @if($lembaga->deskripsi)
                <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                        <div class="w-8 h-8 bg-cyan-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-align-left text-cyan-500 text-sm"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Deskripsi</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">{{ $lembaga->deskripsi }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection