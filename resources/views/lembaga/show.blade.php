<x-app-layout>
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ route('lembaga.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
            ← Kembali ke Daftar Lembaga
        </a>

        <!-- Card Profil Lembaga -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <div class="flex justify-between items-center flex-wrap gap-3">
                    <h1 class="text-2xl font-bold text-white">{{ $lembaga->nama_lembaga }}</h1>
                    @php
                        $statusKolab = '';
                        if(isset($lembaga->informasi) && isset($lembaga->informasi->status_kolaborasi)) {
                            $statusKolab = $lembaga->informasi->status_kolaborasi;
                        }
                    @endphp
                    @if($statusKolab == 'dibuka')
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✓ Dibuka untuk Kolaborasi</span>
                    @elseif($statusKolab == 'ditutup')
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">✗ Tidak Membuka Kolaborasi</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">✗ Belum Ada Info</span>
                    @endif
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">📍 Lokasi</p>
                        <p class="text-gray-800">{{ $lembaga->lokasi ?? $lembaga->alamat ?? 'Tidak tersedia' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">📞 Kontak</p>
                        <p class="text-gray-800">{{ $lembaga->kontak ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-gray-500 text-sm mb-2">🏷️ Kategori Lembaga</p>
                    <div class="flex flex-wrap gap-2">
                        @forelse($lembaga->kategori as $kat)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $kat->nama_kategori }}</span>
                        @empty
                            <span class="text-gray-500 text-sm">Tidak ada kategori</span>
                        @endforelse
                    </div>
                </div>

                @if($lembaga->visi)
                <div class="mt-4">
                    <p class="text-gray-500 text-sm">🎯 Visi</p>
                    <p class="text-gray-700">{{ $lembaga->visi }}</p>
                </div>
                @endif
                
                @if($lembaga->misi)
                <div class="mt-4">
                    <p class="text-gray-500 text-sm">📋 Misi</p>
                    <p class="text-gray-700">{{ $lembaga->misi }}</p>
                </div>
                @endif
                
                @if($lembaga->deskripsi)
                <div class="mt-4">
                    <p class="text-gray-500 text-sm">📝 Deskripsi</p>
                    <p class="text-gray-700">{{ $lembaga->deskripsi }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Tombol ke Detail Informasi -->
        <div class="mt-6 text-center">
            <a href="{{ route('informasi.show', $lembaga->lembaga_id) }}" 
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Lihat Detail Informasi (Anak Asuh & Donasi)
            </a>
        </div>
    </div>
</div>
</x-app-layout>