@extends('layouts.app')

@section('content')
<div class="p-6">
    @if(Auth::user()->role == 'admin')
        <!-- ==================== TAMPILAN UNTUK ADMIN ==================== -->
        <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-building text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Semua Lembaga</h2>
                    <p class="text-blue-100 text-sm">Daftar semua lembaga sosial yang terdaftar di sistem</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @php
                $lembaga = \App\Models\Lembaga::with('user', 'kategori', 'informasi')->get();
            @endphp
            
            <!-- Statistik card -->
            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl p-4 m-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Total Lembaga Terdaftar</p>
                        <p class="text-3xl font-bold text-white">{{ $lembaga->count() }}</p>
                    </div>
                    <i class="fas fa-building text-4xl text-white/30"></i>
                </div>
            </div>
            
            @if($lembaga->count() > 0)
            <div class="overflow-x-auto p-4">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] text-white">
                            <th class="border border-gray-300 px-4 py-3 text-left">No</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Nama Lembaga</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Email</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Lokasi</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Kontak</th>
                            <th class="border border-gray-300 px-4 py-3 text-center">Status</th>
                            <th class="border border-gray-300 px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lembaga as $index => $item)
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                            <td class="border border-gray-300 px-4 py-3 text-gray-600">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-building text-blue-500 text-sm"></i>
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $item->nama_lembaga }}</span>
                                </div>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-gray-600">{{ $item->user->email ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-gray-600">{{ $item->lokasi ?? $item->alamat ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-gray-600">{{ $item->kontak ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                @if($item->user && $item->user->status_akun == 'aktif')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                        <i class="fas fa-circle text-[6px] text-green-500"></i> Aktif
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                        <i class="fas fa-circle text-[6px] text-red-500"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('lembaga.show', $item->lembaga_id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition inline-flex items-center" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus lembaga {{ $item->nama_lembaga }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition inline-flex items-center" title="Hapus Lembaga">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-gray-400 text-3xl"></i>
                </div>
                <p class="text-gray-500">Belum ada lembaga yang terdaftar</p>
                <p class="text-sm text-gray-400 mt-1">Silakan daftar sebagai lembaga terlebih dahulu</p>
            </div>
            @endif
        </div>

    @else
        <!-- ==================== TAMPILAN UNTUK LEMBAGA (BIASA) ==================== -->
        <!-- (Kode untuk lembaga biasa tetap sama) -->
    @endif
</div>
@endsection