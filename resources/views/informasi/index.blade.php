@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
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
            @auth
                @if(Auth::user()->status_akun == 'aktif')
                <a href="{{ route('informasi.create') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Informasi
                </a>
                @endif
            @endauth
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @auth
    @if(Auth::user()->status_akun != 'aktif')
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-8 text-center">
            <p class="text-gray-500">Akun Anda masih menunggu verifikasi dari administrator.</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-6 py-2 rounded-lg">Logout</button>
            </form>
        </div>
    @else
        <div class="space-y-6">
            @forelse($informasi as $item)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-5 py-3">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-white">{{ $item->lembaga->nama_lembaga ?? 'Lembaga' }}</h3>
                        <a href="{{ route('informasi.edit', $item->informasi_id) }}" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1 rounded-lg text-sm">Edit</a>
                    </div>
                </div>

                <div class="p-5">
                    <!-- Statistik -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-blue-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-blue-600">{{ $item->jumlah_anak_asuh ?? 0 }}</p>
                            <p class="text-xs text-gray-500">Jumlah Anak Asuh</p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-emerald-600">{{ $item->rentang_usia ?? '-' }}</p>
                            <p class="text-xs text-gray-500">Rentang Usia</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-3 text-center">
                            <p class="text-xs font-bold text-purple-600">{{ \Carbon\Carbon::parse($item->tanggal_update ?? now())->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">Update</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        @if($item->status_kolaborasi == 'dibuka')
                            <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                <span class="text-green-700 text-sm">✓ Dibuka untuk Kolaborasi</span>
                            </div>
                        @else
                            <div class="bg-red-50 border border-red-200 rounded-lg p-2 text-center">
                                <span class="text-red-700 text-sm">✗ Tidak Membuka Kolaborasi</span>
                            </div>
                        @endif
                    </div>

                    <!-- Tabel Kebutuhan Donasi (SEDERHANA) -->
                    <div>
                        <p class="font-semibold text-gray-700 mb-2">Daftar Kebutuhan Donasi</p>
                        @php
                            $donasiList = [];
                            if(is_string($item->kebutuhan_donasi_list)) {
                                $donasiList = json_decode($item->kebutuhan_donasi_list, true);
                                if(!is_array($donasiList)) $donasiList = [];
                            }
                        @endphp
                        
                        @if(count($donasiList) > 0)
                        <table style="width:100%; border-collapse:collapse; border:1px solid #d1d5db;">
                            <thead>
                                <tr style="background:linear-gradient(90deg, #0f2b5c, #1e3a8a, #2563eb);">
                                    <th style="border:1px solid #d1d5db; padding:8px; text-align:left; color:white;">Nama Kebutuhan</th>
                                    <th style="border:1px solid #d1d5db; padding:8px; text-align:center; color:white;">Jumlah</th>
                                    <th style="border:1px solid #d1d5db; padding:8px; text-align:center; color:white;">Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donasiList as $idx => $d)
                                <tr style="background-color:{{ $idx%2==0 ? 'white' : '#f9fafb' }};">
                                    <td style="border:1px solid #d1d5db; padding:8px;">{{ $d['nama'] ?? '-' }}</td>
                                    <td style="border:1px solid #d1d5db; padding:8px; text-align:center;">{{ $d['target'] ?? 0 }}</td>
                                    <td style="border:1px solid #d1d5db; padding:8px; text-align:center;">{{ $d['satuan'] ?? 'unit' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div style="background:#f9fafb; padding:16px; text-align:center; border-radius:12px;">
                            <p style="color:#6b7280;">Belum ada data kebutuhan donasi</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <p class="text-gray-500">Belum ada informasi donasi</p>
                <a href="{{ route('informasi.create') }}" class="text-blue-600 mt-2 inline-block">Tambah sekarang</a>
            </div>
            @endforelse
        </div>
    @endif
    @endauth
</div>
@endsection