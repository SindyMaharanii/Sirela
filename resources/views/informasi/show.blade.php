@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ route('lembaga.show', $informasi->lembaga_id) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition">
            <i class="fas fa-arrow-left"></i> Kembali ke Profil Lembaga
        </a>

        <!-- Card Informasi Anak Asuh -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-2">
            <i class="fas fa-child text-white text-xl"></i>
            <h2 class="text-xl font-bold text-white">Data Anak Asuh</h2>
        </div>
        @auth
            @if(Auth::user()->role != 'admin')
                <a href="{{ route('informasi.edit', $informasi->informasi_id) }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition inline-flex items-center gap-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
            @endif
        @endauth
    </div>
</div>

            <div class="p-6">
                <!-- 3 Kotak Data -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-xl p-4 text-center border border-blue-200">
                        <p class="text-3xl font-bold text-blue-600">{{ $informasi->jumlah_anak_asuh ?? 0 }}</p>
                        <p class="text-gray-600 text-sm mt-1">👶 Jumlah Anak Asuh</p>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 text-center border border-green-200">
                        <p class="text-3xl font-bold text-green-600">{{ $informasi->rentang_usia ?? '-' }}</p>
                        <p class="text-gray-600 text-sm mt-1">📊 Rentang Usia</p>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 text-center border border-purple-200">
                        <p class="text-base font-bold text-purple-600">
                            📅 {{ \Carbon\Carbon::parse($informasi->tanggal_update ?? now())->format('d M Y') }}
                        </p>
                        <p class="text-gray-600 text-sm mt-1">Terakhir Update</p>
                    </div>
                </div>

                <!-- Profil Anak Asuh -->
                @if($informasi->profil_anak)
                <div class="mb-6 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-edit text-blue-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Deskripsi Anak Asuh</p>
                            <p class="text-gray-700">{{ $informasi->profil_anak }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Card Status Kolaborasi -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-handshake text-white text-xl"></i>
                    <h2 class="text-xl font-bold text-white">Status Kolaborasi</h2>
                </div>
            </div>
            <div class="p-6">
                @if($informasi->status_kolaborasi == 'dibuka')
                    <div class="bg-green-50 border border-green-200 rounded-xl p-5 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-3">
                            <i class="fas fa-handshake text-green-600 text-2xl"></i>
                        </div>
                        <p class="text-green-700 font-bold text-lg">✓ Dibuka untuk Kolaborasi</p>
                        <p class="text-green-600 text-sm mt-1">Lembaga ini sedang membuka peluang kolaborasi untuk relawan, donatur, atau mitra kerja sama.</p>
                    </div>
                @elseif($informasi->status_kolaborasi == 'ditutup')
                    <div class="bg-red-50 border border-red-200 rounded-xl p-5 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-3">
                            <i class="fas fa-handshake text-red-600 text-2xl"></i>
                        </div>
                        <p class="text-red-700 font-bold text-lg">✗ Tidak Membuka Kolaborasi</p>
                        <p class="text-red-600 text-sm mt-1">Saat ini lembaga belum membuka peluang kolaborasi untuk pihak luar.</p>
                    </div>
                @else
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-3">
                            <i class="fas fa-handshake text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 font-bold text-lg">Belum Ada Informasi</p>
                        <p class="text-gray-400 text-sm mt-1">Lembaga belum mengupdate status kolaborasi.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <<!-- Card Tabel Kebutuhan Donasi -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
        <div class="flex items-center gap-2">
            <i class="fas fa-boxes text-white text-xl"></i>
            <h2 class="text-xl font-bold text-white">Daftar Kebutuhan Donasi</h2>
        </div>
    </div>
    <div class="p-6">
        @php
            $donasiList = [];
            if($informasi->kebutuhan_donasi_list) {
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
                    <tr style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                        <th class="border border-blue-400 px-4 py-3 text-left text-white font-semibold rounded-tl-lg">Nama Kebutuhan</th>
                        <th class="border border-blue-400 px-4 py-3 text-left text-white font-semibold">Jumlah</th>
                        <th class="border border-blue-400 px-4 py-3 text-left text-white font-semibold rounded-tr-lg">Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donasiList as $index => $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="border border-gray-200 px-4 py-3 text-gray-700">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-box text-blue-500"></i>
                                {{ $item['nama'] ?? '-' }}
                            </div>
                        </td>
                        <td class="border border-gray-200 px-4 py-3 text-gray-700 font-semibold">{{ $item['jumlah'] ?? 0 }}</td>
                        <td class="border border-gray-200 px-4 py-3 text-gray-700">{{ $item['satuan'] ?? 'unit' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fas fa-box-open text-gray-400 text-3xl"></i>
            </div>
            <p class="text-gray-500 text-lg">Belum ada data kebutuhan donasi</p>
            <p class="text-gray-400 text-sm mt-1">Lembaga belum menambahkan daftar kebutuhan donasi</p>
        </div>
        @endif
    </div>
</div>

        <!-- Tombol Aksi (hanya untuk pemilik lembaga) -->
<div class="mt-6 flex justify-end gap-3">
    @auth
        @if(Auth::user()->role != 'admin')
            <a href="{{ route('informasi.edit', $informasi->informasi_id) }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition inline-flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit Informasi
            </a>
        @endif
    @endauth
</div>
    </div>
</div>
@endsection