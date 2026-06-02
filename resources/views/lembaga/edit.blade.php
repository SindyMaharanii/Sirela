@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $lembaga = \App\Models\Lembaga::where('pengguna_id', $user->id)->first();
@endphp

@if($user->status_akun == 'aktif' && $lembaga)
<div class="max-w-6xl mx-auto">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden mb-6">
        <div class="px-6 py-6">
            <div class="flex flex-wrap justify-between items-start gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-building text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $lembaga->nama_lembaga }}</h1>
                    </div>
                </div>
                <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-5 py-2 rounded-xl inline-flex items-center gap-2">
                    <i class="fas fa-edit"></i> Edit Profil Lembaga
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-5">
            <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-info-circle text-blue-500 text-sm"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Informasi Dasar</h3>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-400">📍 Lokasi</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->lokasi ?? $lembaga->alamat ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">📞 Kontak</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->kontak ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                    <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tags text-emerald-500 text-sm"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Kategori</h3>
                </div>
                <div class="flex flex-wrap gap-2">
                    @forelse($lembaga->kategori as $kat)
                        <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1.5 rounded-lg text-sm">{{ $kat->nama_kategori }}</span>
                    @empty
                        <span class="text-gray-500 text-sm">-</span>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-5">
            @if($lembaga->visi)
            <div class="bg-white rounded-2xl shadow-md p-5">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-eye text-indigo-500"></i>
                    <h3 class="font-bold">Visi</h3>
                </div>
                <p class="text-gray-700">{{ $lembaga->visi }}</p>
            </div>
            @endif

            @if($lembaga->misi)
            <div class="bg-white rounded-2xl shadow-md p-5">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-bullseye text-rose-500"></i>
                    <h3 class="font-bold">Misi</h3>
                </div>
                <p class="text-gray-700">{{ $lembaga->misi }}</p>
            </div>
            @endif

            @if($lembaga->deskripsi)
            <div class="bg-white rounded-2xl shadow-md p-5">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-file-alt text-cyan-500"></i>
                    <h3 class="font-bold">Deskripsi</h3>
                </div>
                <p class="text-gray-700">{{ $lembaga->deskripsi }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@elseif($user->status_akun == 'aktif' && !$lembaga)
<div class="bg-white rounded-xl shadow-md p-8 text-center">
    <h4 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Profil Lembaga</h4>
    <a href="{{ route('lembaga.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-lg">Buat Profil Lembaga</a>
</div>
@endif
@endsection