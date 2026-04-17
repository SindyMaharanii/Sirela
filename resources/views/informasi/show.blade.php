<x-app-layout>
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ route('lembaga.show', $informasi->lembaga_id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
            ← Kembali ke Profil Lembaga
        </a>

        <!-- Card Informasi Anak Asuh -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">👶</span>
                    <h2 class="text-lg font-bold text-white">Data Anak Asuh</h2>
                </div>
            </div>
            <div class="p-6">
                <!-- 3 Kotak Data SEJAJAR KE SAMPING dengan BACKGROUND GRADIEN TIPIS + BORDER -->
                <div class="flex flex-wrap gap-4 items-stretch">
                    <!-- Kotak Jumlah Anak Asuh (Background biru tipis + border biru) -->
                    <div class="flex-1 rounded-xl p-5 text-center min-w-[180px] shadow-sm" 
                         style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #bfdbfe;">
                        <p class="text-3xl font-bold text-blue-600">{{ $informasi->jumlah_anak_asuh ?? 0 }}</p>
                        <p class="text-gray-500 text-sm mt-2">Jumlah Anak Asuh</p>
                    </div>
                    
                    <!-- Kotak Rentang Usia (Background hijau tipis + border hijau) -->
                    <div class="flex-1 rounded-xl p-5 text-center min-w-[180px] shadow-sm" 
                         style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #bbf7d0;">
                        <p class="text-3xl font-bold text-green-600">{{ $informasi->rentang_usia ?? '-' }}</p>
                        <p class="text-gray-500 text-sm mt-2">Rentang Usia</p>
                    </div>
                    
                    <!-- Kotak Terakhir Update (Background ungu tipis + border ungu) -->
                    <div class="flex-1 rounded-xl p-5 text-center min-w-[180px] shadow-sm" 
                         style="background: linear-gradient(135deg, #faf5ff, #f3e8ff); border: 1px solid #e9d5ff;">
                        <p class="text-base font-bold text-purple-600">
                            @php
                                $tgl = isset($informasi->tanggal_update) ? $informasi->tanggal_update : '-';
                            @endphp
                            @if($tgl && $tgl != '-')
                                {{ \Carbon\Carbon::parse($tgl)->format('d M Y') }}
                            @else
                                -
                            @endif
                        </p>
                        <p class="text-gray-500 text-sm mt-2">Terakhir Update</p>
                    </div>
                </div>

                <!-- Deskripsi Profil Anak Asuh -->
                @if(!empty($informasi->profil_anak))
                <div class="mt-6 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm">📝</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Deskripsi</p>
                            <p class="text-gray-700">{{ $informasi->profil_anak }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

       <!-- Card Status Kolaborasi -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
        <div class="flex items-center gap-2">
            <span class="text-xl">🤝</span>
            <h2 class="text-lg font-bold text-white">Status Kolaborasi</h2>
        </div>
    </div>
    <div class="p-6">
        @if($informasi->status_kolaborasi == 'dibuka')
            <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-5 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p style="color: #22c55e !important; font-weight: bold !important; font-size: 1.125rem !important;">✓ Dibuka untuk Kolaborasi</p>
                <p class="text-green-600 text-sm mt-1">Lembaga ini sedang membuka peluang kolaborasi untuk relawan, donatur, atau mitra kerja sama.</p>
            </div>
        @elseif($informasi->status_kolaborasi == 'ditutup')
            <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-xl p-5 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-3">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p style="color: #ef4444 !important; font-weight: bold !important; font-size: 1.125rem !important;">✗ Tidak Membuka Kolaborasi</p>
                <p class="text-red-600 text-sm mt-1">Saat ini lembaga belum membuka peluang kolaborasi untuk pihak luar.</p>
            </div>
        @else
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl p-5 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-3">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p style="color: #6b7280 !important; font-weight: bold !important; font-size: 1.125rem !important;">Belum Ada Informasi</p>
                <p class="text-gray-500 text-sm mt-1">Lembaga belum mengupdate status kolaborasi.</p>
            </div>
        @endif
    </div>
</div>

        <!-- Card Tabel Kebutuhan Donasi -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">📦</span>
                    <h2 class="text-lg font-bold text-white">Daftar Kebutuhan Donasi</h2>
                </div>
            </div>
            <div class="p-6">
                @php
                    $donasiList = [];
                    if(isset($informasi->kebutuhan_donasi_list) && !empty($informasi->kebutuhan_donasi_list)) {
                        $donasiList = json_decode($informasi->kebutuhan_donasi_list, true);
                        if(!is_array($donasiList)) {
                            $donasiList = [];
                        }
                    }
                @endphp
                @if(count($donasiList) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-100 to-gray-200">
                                    <th class="border border-gray-300 px-4 py-3 text-left text-gray-700 font-semibold">Nama Kebutuhan</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left text-gray-700 font-semibold">Jumlah</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left text-gray-700 font-semibold">Satuan</th>
                                <tr>
                            </thead>
                            <tbody>
                                @foreach($donasiList as $index => $item)
                                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition">
                                    <td class="border border-gray-300 px-4 py-3 text-gray-800">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">📦</span>
                                            {{ $item['nama'] ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-800 font-semibold">{{ $item['jumlah'] ?? 0 }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-gray-800">{{ $item['satuan'] ?? 'unit' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </tr>
                    </div>
                @else
                    <div class="text-center py-10">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada data kebutuhan donasi</p>
                        <p class="text-gray-400 text-sm mt-1">Lembaga belum menambahkan daftar kebutuhan donasi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>