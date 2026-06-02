@extends('layouts.app')

@section('content')
<div class="p-6">
    @if(Auth::user()->role == 'admin')
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
                $semuaLembaga = \App\Models\Lembaga::with('user', 'kategori', 'informasi')->get();
            @endphp
            
            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl p-4 m-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Total Lembaga Terdaftar</p>
                        <p class="text-3xl font-bold text-white">{{ $semuaLembaga->count() }}</p>
                    </div>
                    <i class="fas fa-building text-4xl text-white/30"></i>
                </div>
            </div>
            
            @if($semuaLembaga->count() > 0)
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
                        @foreach($semuaLembaga as $index => $item)
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
        @php
            $lembaga = \App\Models\Lembaga::where('pengguna_id', Auth::id())->first();
        @endphp

        @if(!$lembaga)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Profil Lembaga</h1>
                            <p class="text-blue-100 text-sm">Informasi profil lembaga Anda</p>
                        </div>
                    </div>
                </div>
                <div class="p-8 text-center">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-blue-500 text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Profil Lembaga</h4>
                    <p class="text-gray-500 mb-6">Silakan buat profil lembaga Anda terlebih dahulu.</p>
                    <a href="{{ route('lembaga.create') }}" class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl inline-flex items-center gap-2 transition shadow-md">
                        <i class="fas fa-plus"></i> Buat Profil Lembaga
                    </a>
                </div>
            </div>
        @else
            <div class="max-w-6xl mx-auto">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition group">
                    <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Dashboard
                </a>

                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden mb-6">
                    <div class="px-6 py-6">
                        <div class="flex flex-wrap justify-between items-start gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <i class="fas fa-building text-white text-3xl"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-white">{{ $lembaga->nama_lembaga }}</h1>
                                    <div class="flex items-center gap-2 mt-2">
                                        @php
                                            $statusKolab = '';
                                            if(isset($lembaga->informasi) && isset($lembaga->informasi->status_kolaborasi)) {
                                                $statusKolab = $lembaga->informasi->status_kolaborasi;
                                            }
                                        @endphp
                                        @if($statusKolab == 'dibuka')
                                            <div class="bg-green-100 border-l-4 border-green-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
                                                <i class="fas fa-handshake text-green-600 text-sm"></i>
                                                <span class="text-green-700 font-semibold text-sm">Dibuka untuk Kolaborasi</span>
                                            </div>
                                        @elseif($statusKolab == 'ditutup')
                                            <div class="bg-red-100 border-l-4 border-red-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
                                                <i class="fas fa-lock text-red-600 text-sm"></i>
                                                <span class="text-red-700 font-semibold text-sm">Tidak Membuka Kolaborasi</span>
                                            </div>
                                        @else
                                            <div class="bg-gray-100 border-l-4 border-gray-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
                                                <i class="fas fa-clock text-gray-600 text-sm"></i>
                                                <span class="text-gray-700 font-semibold text-sm">Belum Ada Informasi Kolaborasi</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" 
                               class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-5 py-2 rounded-xl transition-all duration-200 inline-flex items-center gap-2 shadow-md hover:shadow-lg">
                                <i class="fas fa-edit"></i> Edit Profil Lembaga
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-1 space-y-5">
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-info-circle text-blue-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Informasi Dasar</h3>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📍 Lokasi</p>
                                    <p class="text-gray-800 font-medium">{{ $lembaga->lokasi ?? $lembaga->alamat ?? 'Tidak tersedia' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📞 Kontak</p>
                                    <p class="text-gray-800 font-medium">{{ $lembaga->kontak ?? 'Tidak tersedia' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📧 Email Lembaga</p>
                                    <p class="text-gray-800 font-medium">{{ Auth::user()->email ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📅 Tanggal Bergabung</p>
                                    <p class="text-gray-800 font-medium">{{ $lembaga->created_at ? $lembaga->created_at->format('d M Y') : '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-tags text-emerald-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Kategori Lembaga</h3>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @forelse($lembaga->kategori as $kat)
                                    <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium shadow-sm">
                                        {{ $kat->nama_kategori }}
                                    </span>
                                @empty
                                    <span class="text-gray-500 text-sm">Tidak ada kategori</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-5">
                        @if($lembaga->visi)
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-indigo-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-eye text-indigo-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Visi</h3>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ $lembaga->visi }}</p>
                        </div>
                        @endif

                        @if($lembaga->misi)
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-rose-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-bullseye text-rose-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Misi</h3>
                            </div>
                            <div class="space-y-2">
                                @php
                                    $misiList = explode("\n", $lembaga->misi);
                                @endphp
                                @foreach($misiList as $index => $misi)
                                    @if(trim($misi))
                                    <div class="flex items-start gap-2">
                                        <div class="w-5 h-5 bg-rose-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <span class="text-rose-500 text-xs font-bold">{{ $index + 1 }}</span>
                                        </div>
                                        <p class="text-gray-700">{{ trim($misi) }}</p>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($lembaga->deskripsi)
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-cyan-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-align-left text-cyan-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Deskripsi</h3>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ $lembaga->deskripsi }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection