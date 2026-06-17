@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Detail Donasi</h2>
                <p class="text-blue-100 text-sm">{{ $kebutuhan->nama }} - {{ $kebutuhan->lembaga->nama_lembaga }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Bulan</label>
                <select name="bulan" class="w-full border rounded-lg px-3 py-2">
                    <option value="01" {{ $bulan == '01' ? 'selected' : '' }}>Januari</option>
                    <option value="02" {{ $bulan == '02' ? 'selected' : '' }}>Februari</option>
                    <option value="03" {{ $bulan == '03' ? 'selected' : '' }}>Maret</option>
                    <option value="04" {{ $bulan == '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ $bulan == '05' ? 'selected' : '' }}>Mei</option>
                    <option value="06" {{ $bulan == '06' ? 'selected' : '' }}>Juni</option>
                    <option value="07" {{ $bulan == '07' ? 'selected' : '' }}>Juli</option>
                    <option value="08" {{ $bulan == '08' ? 'selected' : '' }}>Agustus</option>
                    <option value="09" {{ $bulan == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun</label>
                <select name="tahun" class="w-full border rounded-lg px-3 py-2">
                    @for($i = 2023; $i <= date('Y'); $i++)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg w-full">Filter</button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 text-white">
            <p class="text-sm">Target</p>
            <p class="text-2xl font-bold">
                @if($kebutuhan->jenis == 'uang')
                    Rp {{ number_format($kebutuhan->target, 0, ',', '.') }}
                @else
                    {{ number_format($kebutuhan->target, 0, ',', '.') }} {{ $kebutuhan->satuan }}
                @endif
            </p>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 text-white">
            <p class="text-sm">Terkumpul</p>
            <p class="text-2xl font-bold">
                @if($kebutuhan->jenis == 'uang')
                    Rp {{ number_format($kebutuhan->terkumpul, 0, ',', '.') }}
                @else
                    {{ number_format($kebutuhan->terkumpul, 0, ',', '.') }} {{ $kebutuhan->satuan }}
                @endif
            </p>
        </div>
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-4 text-white">
            <p class="text-sm">Persentase</p>
            <p class="text-2xl font-bold">{{ $persentase }}%</p>
            <div class="w-full bg-white/30 rounded-full h-1 mt-1">
                <div class="bg-white rounded-full h-1" style="width: {{ $persentase }}%"></div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-5 py-3">
            <h3 class="text-lg font-bold text-white">Daftar Donatur</h3>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Nama Donatur</th>
                        <th class="border px-4 py-2">Kontak</th>
                        <th class="border px-4 py-2">Jumlah/Nominal</th>
                        <th class="border px-4 py-2">Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donasi as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="border px-4 py-2">{{ $item->nama_donatur }}</td>
                        <td class="border px-4 py-2">{{ $item->no_hp }}</td>
                        <td class="border px-4 py-2">
                            @if($item->kebutuhan_jenis == 'barang')
                                {{ number_format($item->jumlah_barang, 0, ',', '.') }} {{ $item->satuan_barang }}
                            @else
                                Rp {{ number_format($item->nominal_uang, 0, ',', '.') }}
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $item->pesan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-8 text-center text-gray-500">Belum ada donasi untuk kebutuhan ini pada periode yang dipilih</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 text-right">
        <a href="{{ route('laporan.rekapitulasi') }}" class="text-blue-600 hover:underline">← Kembali ke Rekapitulasi</a>
    </div>
</div>
@endsection