@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-hand-holding-heart text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Informasi Donasi & Anak Asuh</h2>
                    <p class="text-blue-100 text-sm">Data donasi dan anak asuh dari lembaga sosial</p>
                </div>
            </div>
            <a href="{{ route('informasi.create') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Informasi
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        @forelse($informasi as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-5 py-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-building text-white text-lg"></i>
                        <h3 class="text-lg font-bold text-white">{{ $item->lembaga->nama_lembaga ?? 'Lembaga' }}</h3>
                    </div>
                    <a href="{{ route('informasi.edit', $item->informasi_id) }}" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1 rounded-lg text-sm transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>

            <div class="p-5">
                <!-- Statistik 3 Kotak -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                    <div class="bg-blue-50 rounded-xl p-4 text-center border border-blue-100">
                        <div class="text-2xl font-bold text-blue-600">{{ $item->jumlah_anak_asuh ?? 0 }}</div>
                        <div class="text-gray-600 text-sm mt-1">👶 Jumlah Anak Asuh</div>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-4 text-center border border-emerald-100">
                        <div class="text-2xl font-bold text-emerald-600">{{ $item->rentang_usia ?? '-' }}</div>
                        <div class="text-gray-600 text-sm mt-1">📊 Rentang Usia</div>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 text-center border border-purple-100">
                        <div class="text-sm font-semibold text-purple-600">
                            📅 {{ \Carbon\Carbon::parse($item->tanggal_update ?? now())->format('d M Y') }}
                        </div>
                        <div class="text-gray-600 text-sm mt-1">Terakhir Update</div>
                    </div>
                </div>

                <!-- Status Kolaborasi -->
                <div class="mb-5">
                    @if($item->status_kolaborasi == 'dibuka')
                        <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-center">
                            <span class="text-green-700 font-semibold">✓ Dibuka untuk Kolaborasi</span>
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-xl p-3 text-center">
                            <span class="text-red-700 font-semibold">✗ Tidak Membuka Kolaborasi</span>
                        </div>
                    @endif
                </div>

                <!-- Profil Anak -->
                @if($item->profil_anak)
                <div class="bg-gray-50 rounded-xl p-4 mb-5 border border-gray-200">
                    <div class="flex items-start gap-2">
                        <i class="fas fa-file-alt text-blue-500 mt-0.5"></i>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Deskripsi Anak Asuh</p>
                            <p class="text-gray-700 text-sm mt-1">{{ $item->profil_anak }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tabel Kebutuhan Donasi dengan border -->
                <div>
                    <p class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fas fa-boxes text-blue-500"></i> Daftar Kebutuhan Donasi
                    </p>
                    @php
                        $donasiList = json_decode($item->kebutuhan_donasi_list, true);
                    @endphp
                    @if($donasiList && count($donasiList) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-600 to-blue-700">
                                    <th class="border border-gray-300 px-4 py-2 text-left text-white">Nama Kebutuhan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center text-white">Jumlah</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-white">Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donasiList as $key => $d)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="border border-gray-300 px-4 py-2">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-xs text-blue-600">{{ $key + 1 }}</span>
                                            {{ $d['nama'] ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center font-semibold">{{ $d['jumlah'] ?? 0 }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $d['satuan'] ?? 'unit' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <i class="fas fa-box-open text-gray-300 text-2xl mb-1"></i>
                        <p class="text-gray-500 text-sm">Belum ada data kebutuhan donasi</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <i class="fas fa-inbox text-5xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Belum ada informasi donasi</p>
            <a href="{{ route('informasi.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">Tambah informasi sekarang</a>
        </div>
        @endforelse
    </div>
</div>
@endsection