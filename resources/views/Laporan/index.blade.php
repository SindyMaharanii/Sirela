@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-file-alt text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Laporan Donasi</h2>
                <p class="text-blue-100 text-sm">Hasil donasi dan persentase ketercapaian dari lembaga Anda</p>
            </div>
        </div>
    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Bulan</label>
                <select name="bulan" class="w-full border rounded-lg px-3 py-2">
                    <option value="1" {{ ($bulan ?? date('m')) == '1' ? 'selected' : '' }}>Januari</option>
                    <option value="2" {{ ($bulan ?? date('m')) == '2' ? 'selected' : '' }}>Februari</option>
                    <option value="3" {{ ($bulan ?? date('m')) == '3' ? 'selected' : '' }}>Maret</option>
                    <option value="4" {{ ($bulan ?? date('m')) == '4' ? 'selected' : '' }}>April</option>
                    <option value="5" {{ ($bulan ?? date('m')) == '5' ? 'selected' : '' }}>Mei</option>
                    <option value="6" {{ ($bulan ?? date('m')) == '6' ? 'selected' : '' }}>Juni</option>
                    <option value="7" {{ ($bulan ?? date('m')) == '7' ? 'selected' : '' }}>Juli</option>
                    <option value="8" {{ ($bulan ?? date('m')) == '8' ? 'selected' : '' }}>Agustus</option>
                    <option value="9" {{ ($bulan ?? date('m')) == '9' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ ($bulan ?? date('m')) == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ ($bulan ?? date('m')) == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ ($bulan ?? date('m')) == '12' ? 'selected' : '' }}>Desember</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun</label>
                <select name="tahun" class="w-full border rounded-lg px-3 py-2">
                    @foreach($tahunList as $thn)
                        <option value="{{ $thn }}" {{ ($tahun ?? date('Y')) == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Tampilkan</button>
                <a href="{{ route('laporan.download-excel', request()->all()) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">Excel</a>
                <a href="{{ route('laporan.download-pdf', request()->all()) }}" class="bg-red-500 text-white px-4 py-2 rounded-lg">PDF</a>
            </div>
        </form>
    </div>

    <!-- 6 CARD STATISTIK -->
       <!-- 6 CARD STATISTIK - FONT & ICON BESAR, CARD TETAP -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <!-- Card 1: Total Target -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 text-white shadow-md flex flex-col">
            <p class="text-sm font-bold opacity-80 tracking-wide mb-3">🎯 TOTAL TARGET</p>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-extrabold">{{ number_format($totalTarget, 0, ',', '.') }}</p>
                <i class="fas fa-bullseye text-6xl opacity-40"></i>
            </div>
        </div>

        <!-- Card 2: Total Terkumpul -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-4 text-white shadow-md flex flex-col">
            <p class="text-sm font-bold opacity-80 tracking-wide mb-3">✅ TOTAL TERKUMPUL</p>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-extrabold">{{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
                <i class="fas fa-check-circle text-6xl opacity-40"></i>
            </div>
        </div>

        <!-- Card 3: Total Donasi Uang -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 text-white shadow-md flex flex-col">
            <p class="text-sm font-bold opacity-80 tracking-wide mb-3">💰 DONASI UANG</p>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-extrabold">Rp {{ number_format($totalDonasiUang, 0, ',', '.') }}</p>
                <i class="fas fa-money-bill-wave text-6xl opacity-40"></i>
            </div>
        </div>

        <!-- Card 4: Total Donasi Barang -->
        <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-xl p-4 text-white shadow-md flex flex-col">
            <p class="text-sm font-bold opacity-80 tracking-wide mb-3">📦 DONASI BARANG</p>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-extrabold">{{ number_format($totalDonasiBarang, 0, ',', '.') }}</p>
                <i class="fas fa-box text-6xl opacity-40"></i>
            </div>
        </div>

        <!-- Card 5: Total Donatur -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 text-white shadow-md flex flex-col">
            <p class="text-sm font-bold opacity-80 tracking-wide mb-3">👥 TOTAL DONATUR</p>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-extrabold">{{ $totalDonatur }}</p>
                <i class="fas fa-users text-6xl opacity-40"></i>
            </div>
        </div>

        <!-- Card 6: Persentase Ketercapaian -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-4 text-white shadow-md flex flex-col">
            <p class="text-sm font-bold opacity-80 tracking-wide mb-3">📊 PERSENTASE</p>
            <div class="flex items-center justify-between">
                <p class="text-4xl font-extrabold">{{ min($persentase, 100) }}%</p>
                <i class="fas fa-chart-line text-6xl opacity-40"></i>
            </div>
            <div class="mt-3">
                <div class="w-full bg-white/30 rounded-full h-2">
                    <div class="bg-white rounded-full h-2 transition-all duration-500" style="width: {{ min($persentase, 100) }}%"></div>
                </div>
                <p class="text-[11px] mt-1 opacity-80 text-right">
                    {{ $persentase >= 100 ? '🎉 Target Tercapai!' : 'Sisa ' . number_format(max(0, $totalTarget - $totalTerkumpul), 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-5 py-3">
            <h3 class="text-lg font-bold text-white">📋 Detail Donasi</h3>
            <p class="text-blue-100 text-sm">Periode: {{ $namaBulan }} {{ $tahun }}</p>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2 text-left">No</th>
                        <th class="border px-4 py-2 text-left">Tanggal</th>
                        <th class="border px-4 py-2 text-left">Donatur</th>
                        <th class="border px-4 py-2 text-left">Kebutuhan</th>
                        <th class="border px-4 py-2 text-center">Jumlah/Nominal</th>
                        <th class="border px-4 py-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donasi as $index => $d)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $d->created_at->format('d/m/Y H:i') }}</td>
                        <td class="border px-4 py-2">{{ $d->nama_donatur }}</td>
                        <td class="border px-4 py-2">{{ $d->kebutuhan_nama }}</td>
                        <td class="border px-4 py-2 text-center">
                            @if($d->kebutuhan_jenis == 'barang')
                                <span class="font-semibold text-blue-600">{{ number_format($d->jumlah_barang, 0, ',', '.') }} {{ $d->satuan_barang }}</span>
                            @else
                                <span class="font-semibold text-green-600">Rp {{ number_format($d->nominal_uang, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if($d->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">⏳ Pending</span>
                            @elseif($d->status == 'dikonfirmasi')
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">✓ Dikonfirmasi</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">✔ Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            Belum ada data donasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@php
    $namaBulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $namaBulan = $namaBulanList[(int)($bulan ?? date('m')) - 1];
@endphp
@endsection