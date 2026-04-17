<x-app-layout>
<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-black">Dashboard Lembaga</h2>
        <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}</p>
    </div>

    @if(Auth::user()->status_akun != 'aktif')
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Akun Belum Diverifikasi</h3>
                            <p class="text-yellow-100 text-sm">Status: Menunggu Verifikasi Admin</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-semibold text-yellow-800">Perhatian!</p>
                                <p class="text-yellow-700 text-sm mt-1">
                                    Akun Anda masih dalam proses verifikasi oleh admin. Beberapa fitur akan aktif setelah akun diverifikasi.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🔒</span>
                                <h4 class="font-semibold text-gray-700">Fitur yang Belum Bisa Diakses</h4>
                            </div>
                            <ul class="space-y-2 text-sm text-gray-600 ml-8">
                                <li class="flex items-center gap-2">
                                    <span class="text-red-500">✗</span> Membuat & Mengedit Profil Lembaga
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-red-500">✗</span> Mengelola Informasi Donasi
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-red-500">✗</span> Mengelola Data Anak Asuh
                                </li>
                            </ul>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">✅</span>
                                <h4 class="font-semibold text-gray-700">Yang Bisa Dilakukan</h4>
                            </div>
                            <ul class="space-y-2 text-sm text-gray-600 ml-8">
                                <li class="flex items-center gap-2">
                                    <span class="text-green-500">✓</span> Mengedit Profil Akun
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-green-500">✓</span> Menunggu Verifikasi Admin
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-green-500">✓</span> Logout & Login Kembali
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="bg-gray-100 rounded-lg p-4 text-center">
                        <p class="text-gray-600 text-sm mb-3">
                            Silakan hubungi admin untuk informasi lebih lanjut atau tunggu notifikasi verifikasi.
                        </p>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    style="background-color: #2563eb !important; color: white !important; font-weight: 500 !important; padding: 8px 20px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important;">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        @php
            $lembaga = App\Models\Lembaga::with('informasi')->where('pengguna_id', Auth::id())->first();
        @endphp

        @if(!$lembaga)
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded">
                <p class="font-semibold">📝 Lengkapi Profil Lembaga</p>
                <p class="text-sm mb-3">Silakan buat profil lembaga Anda terlebih dahulu untuk mulai menggunakan sistem.</p>
                <a href="{{ route('lembaga.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm inline-block">
                    + Buat Profil Lembaga
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Card Profil Lembaga -->
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-start mb-4">
        <h3 class="text-xl font-bold text-black flex items-center gap-2">
            🏢 Profil Lembaga
        </h3>
        <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" 
           style="background-color: #eab308 !important; color: white !important; padding: 8px 20px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-flex !important; align-items: center !important; gap: 8px !important; font-size: 14px !important; font-weight: 500 !important;">
            <svg style="width: 14px; height: 14px; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
        </a>
    </div>
    <div class="space-y-3">
        <p class="text-gray-800 text-base font-semibold">📛 {{ $lembaga->nama_lembaga }}</p>
        <p class="text-gray-600 text-sm flex items-start gap-2">📍 <span>{{ $lembaga->lokasi ?? $lembaga->alamat ?? 'Lokasi belum diisi' }}</span></p>
        <p class="text-gray-600 text-sm flex items-start gap-2">📞 <span>{{ $lembaga->kontak ?? 'Kontak belum diisi' }}</span></p>
    </div>
</div>

                <!-- Card Informasi Donasi -->
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-start mb-4">
        <h3 class="text-xl font-bold text-black flex items-center gap-2">
            📦 Informasi Donasi & Kolaborasi
        </h3>
        <a href="{{ route('informasi.index') }}" 
           style="background-color: #eab308 !important; color: white !important; padding: 8px 20px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-flex !important; align-items: center !important; gap: 8px !important; font-size: 14px !important; font-weight: 500 !important;">
            <svg style="width: 14px; height: 14px; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
            Kelola
        </a>
    </div>
    @if($lembaga->informasi)
        <div class="space-y-3">
            <p class="text-gray-700 text-sm flex items-start gap-2">👶 <span class="font-medium">Jumlah Anak:</span> <span>{{ $lembaga->informasi->jumlah_anak_asuh ?? 0 }} anak</span></p>
            <p class="text-gray-700 text-sm flex items-start gap-2">📊 <span class="font-medium">Rentang Usia:</span> <span>{{ $lembaga->informasi->rentang_usia ?? '-' }}</span></p>
            <p class="text-gray-700 text-sm flex items-start gap-2">🤝 <span class="font-medium">Status:</span> 
                @if(($lembaga->informasi->status_kolaborasi ?? '') == 'dibuka')
                    <span class="text-green-600 font-semibold">Dibuka</span>
                @else
                    <span class="text-red-600 font-semibold">Ditutup</span>
                @endif
            </p>
        </div>
    @else
        <p class="text-gray-500 text-sm">Belum ada informasi.</p>
        <a href="{{ route('informasi.create') }}" class="text-blue-600 text-sm mt-2 inline-block">+ Tambah Informasi</a>
    @endif
</div>

            <!-- Menu Cepat -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-black mb-4">⚡ Menu Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        ✏️ Edit Profil Lembaga
                    </a>
                    <a href="{{ route('informasi.index') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        📊 Kelola Informasi Donasi
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        ⚙️ Pengaturan Akun
                    </a>
                </div>
            </div>
        @endif
    @endif
</div>
</x-app-layout>