<x-app-layout>
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📋 Informasi Donasi & Anak Asuh</h2>
        <a href="{{ route('informasi.create') }}" 
           style="background-color: #2563eb !important; color: white !important; padding: 8px 16px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-flex !important; align-items: center !important; gap: 8px !important; font-weight: 500 !important;">
            <svg style="width: 16px; height: 16px; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Informasi
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @forelse($informasi as $i)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="text-xl">🏢</span>
                    <h3 class="text-xl font-bold text-white">{{ $i->lembaga->nama_lembaga }}</h3>
                </div>
                <a href="{{ route('informasi.edit', $i->informasi_id) }}" 
                   style="background-color: #eab308 !important; color: white !important; padding: 6px 12px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-flex !important; align-items: center !important; gap: 5px !important; font-size: 13px !important;">
                    <svg style="width: 14px; height: 14px; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
            </div>
        </div>
        
        <div class="p-6">
            <!-- 3 Kotak Data SEJAJAR KE SAMPING -->
            <div class="flex flex-wrap gap-4 mb-6 items-stretch">
                <!-- Kotak Jumlah Anak Asuh (Biru tipis) -->
                <div class="flex-1 rounded-xl p-4 text-center min-w-[160px] shadow-sm" 
                     style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #bfdbfe;">
                    <div class="text-2xl font-bold text-blue-600">{{ $i->jumlah_anak_asuh ?? 0 }}</div>
                    <div class="text-gray-600 text-sm mt-1">👶 Jumlah Anak Asuh</div>
                </div>
                
                <!-- Kotak Rentang Usia (Hijau tipis) -->
                <div class="flex-1 rounded-xl p-4 text-center min-w-[160px] shadow-sm" 
                     style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #bbf7d0;">
                    <div class="text-2xl font-bold text-green-600">{{ $i->rentang_usia ?? '-' }}</div>
                    <div class="text-gray-600 text-sm mt-1">📊 Rentang Usia</div>
                </div>
                
                <!-- Kotak Terakhir Update (Ungu tipis) -->
                <div class="flex-1 rounded-xl p-4 text-center min-w-[160px] shadow-sm" 
                     style="background: linear-gradient(135deg, #faf5ff, #f3e8ff); border: 1px solid #e9d5ff;">
                    <div class="text-sm font-semibold text-purple-600">
                        📅 {{ \Carbon\Carbon::parse($i->tanggal_update ?? now())->format('d M Y') }}
                    </div>
                    <div class="text-gray-600 text-sm mt-1">Terakhir Update</div>
                </div>
            </div>

            <!-- Status Kolaborasi -->
<div class="mb-6">
    @if($i->status_kolaborasi == 'dibuka')
        <div style="background: #dcfce7; border: 1px solid #86efac; border-radius: 12px; padding: 12px; text-align: center;">
            <span style="color: #166534 !important; font-weight: 600; font-size: 14px;">✓ Dibuka untuk Kolaborasi</span>
        </div>
    @else
        <div style="background: #dcfce7; border: 1px solid #86efac; border-radius: 12px; padding: 12px; text-align: center;">
            <span style="color: #166534 !important; font-weight: 600; font-size: 14px;">✗ Tidak Membuka Kolaborasi</span>
        </div>
    @endif
</div>

            <!-- Profil Anak Asuh -->
            @if($i->profil_anak)
            <div class="mb-6 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-sm">📝</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Deskripsi Anak Asuh</p>
                        <p class="text-gray-700">{{ $i->profil_anak }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Tabel Kebutuhan Donasi -->
            <div>
                <p class="font-semibold text-gray-700 mb-3">📦 Daftar Kebutuhan Donasi</p>
                @php
                    $donasiList = json_decode($i->kebutuhan_donasi_list, true);
                @endphp
                @if($donasiList && count($donasiList) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                    <th class="border border-gray-300 px-4 py-2 text-left" style="color: white !important;">Nama Kebutuhan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left" style="color: white !important;">Jumlah</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left" style="color: white !important;">Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donasiList as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $item['nama'] ?? '-' }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $item['jumlah'] ?? 0 }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $item['satuan'] ?? 'unit' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm py-4 text-center">Belum ada data kebutuhan donasi</p>
                @endif
            </div>

            <div class="text-right text-xs text-gray-400 mt-4 pt-3 border-t">
                Terakhir update: {{ \Carbon\Carbon::parse($i->tanggal_update)->format('d M Y') ?? '-' }}
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <p class="text-gray-500 text-lg">Belum ada informasi donasi</p>
        <p class="text-gray-400 text-sm mt-1">Silakan tambah informasi donasi dan anak asuh</p>
    </div>
    @endforelse

</div>
</x-app-layout>