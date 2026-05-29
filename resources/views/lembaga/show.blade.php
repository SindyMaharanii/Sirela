@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="{{ route('lembaga.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Daftar Lembaga
        </a>

        <!-- Header Profil -->
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
                    <div class="flex gap-3">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('informasi.show', $lembaga->lembaga_id) }}" 
                               class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-5 py-2 rounded-xl transition-all duration-200 inline-flex items-center gap-2 shadow-md hover:shadow-lg">
                                <i class="fas fa-hand-holding-heart"></i> Lihat Donasi
                            </a>
                        @else
                            <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-xl transition inline-flex items-center gap-2">
                                <i class="fas fa-edit"></i> Edit Lembaga
                            </a>
                            <a href="{{ route('informasi.show', $lembaga->lembaga_id) }}" 
                               class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl transition inline-flex items-center gap-2">
                                <i class="fas fa-hand-holding-heart"></i> Lihat Donasi
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Utama 2 Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri (Informasi Dasar & Kontak) -->
            <div class="lg:col-span-1 space-y-5">
                <!-- Card Informasi Dasar -->
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
                            <p class="text-gray-800 font-medium">{{ $lembaga->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card Info Pengguna -->
                <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                        <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-circle text-purple-500 text-sm"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Info Pengguna</h3>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Pengguna</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga->user->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Status Akun</p>
                            @if($lembaga->user && $lembaga->user->status_akun == 'aktif')
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-circle text-[6px] text-green-500"></i> Aktif
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-circle text-[6px] text-red-500"></i> Nonaktif
                                </span>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Jenis Lembaga</p>
                            <p class="text-gray-800 font-medium">{{ ucfirst($lembaga->user->jenis_lembaga ?? '-') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Tahun Berdiri</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga->user->tahun_berdiri ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan (Kategori, Visi, Misi, Deskripsi) -->
            <div class="lg:col-span-2 space-y-5">
                <!-- Card Kategori -->
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

                <!-- Card Visi -->
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

                <!-- Card Misi -->
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

                <!-- Card Deskripsi -->
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

        <!-- ==================== CARD DATA LEGALITAS & PENGURUS ==================== -->
        <!-- Card ini hanya TAMPAK untuk ADMIN (karena data sensitif) -->
        @if(Auth::user()->role == 'admin')
        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100 mt-6">
            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-purple-500 text-sm"></i>
                </div>
                <h3 class="font-bold text-gray-800">Data Legalitas & Pengurus</h3>
                <span class="ml-2 text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">Khusus Admin</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Alamat Lengkap -->
                <div class="col-span-2">
                    <p class="text-xs text-gray-400 uppercase tracking-wider">📍 Alamat Lengkap</p>
                    <p class="text-gray-800 font-medium">{{ $lembaga->user->alamat ?? '-' }}</p>
                </div>

                <!-- Provinsi, Kota, Kode Pos -->
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Provinsi</p>
                    <p class="text-gray-800 font-medium">{{ $lembaga->user->provinsi ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Kota/Kabupaten</p>
                    <p class="text-gray-800 font-medium">{{ $lembaga->user->kota ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Kode Pos</p>
                    <p class="text-gray-800 font-medium">{{ $lembaga->user->kode_pos ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Telepon Lembaga</p>
                    <p class="text-gray-800 font-medium">{{ $lembaga->user->telepon_lembaga ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Email Lembaga</p>
                    <p class="text-gray-800 font-medium">{{ $lembaga->user->email_lembaga ?? '-' }}</p>
                </div>
                @if($lembaga->user->website)
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Website</p>
                    <p class="text-gray-800 font-medium">
                        <a href="{{ $lembaga->user->website }}" target="_blank" class="text-blue-500 hover:underline">{{ $lembaga->user->website }}</a>
                    </p>
                </div>
                @endif
            </div>

            <!-- KHUSUS PEMERINTAH -->
            @if(($lembaga->user->jenis_lembaga ?? '') == 'pemerintah')
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-landmark text-blue-500"></i> Data Lembaga Pemerintah
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400">Kementerian/Instansi Induk</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->kementerian ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Eselon</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->eselon ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Nomor SOTK</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nomor_sotk ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">NIP Pimpinan</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nip_pimpinan ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-400">File SOTK</p>
                        @if($lembaga->user->file_sotk)
                            <a href="{{ Storage::url($lembaga->user->file_sotk) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                <i class="fas fa-file-pdf text-red-500"></i> Lihat / Unduh File SOTK
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- KHUSUS SWASTA -->
            @if(($lembaga->user->jenis_lembaga ?? '') == 'swasta')
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-building text-green-500"></i> Data Lembaga Swasta
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400">Tipe Lembaga</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->tipe_swasta ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Nomor Akta Pendirian</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nomor_akta ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">NPWP Lembaga</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->npwp_lembaga ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Nama Pimpinan</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nama_pimpinan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">NIK Pimpinan</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nik_pimpinan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Rekening Lembaga</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->rekening_lembaga ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">File Akta</p>
                        @if($lembaga->user->file_akta)
                            <a href="{{ Storage::url($lembaga->user->file_akta) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                <i class="fas fa-file-pdf text-red-500"></i> Lihat File
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">File NPWP</p>
                        @if($lembaga->user->file_npwp)
                            <a href="{{ Storage::url($lembaga->user->file_npwp) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                <i class="fas fa-file-pdf text-red-500"></i> Lihat File
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-400">File KTP Pimpinan</p>
                        @if($lembaga->user->file_ktp_pimpinan)
                            <a href="{{ Storage::url($lembaga->user->file_ktp_pimpinan) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                <i class="fas fa-id-card text-blue-500"></i> Lihat KTP
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- KHUSUS KOMUNITAS -->
            @if(($lembaga->user->jenis_lembaga ?? '') == 'komunitas')
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-users text-purple-500"></i> Data Komunitas Sosial
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400">Nomor SK KEMENSOS</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nomor_sk ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Tanggal SK</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->tanggal_sk ? \Carbon\Carbon::parse($lembaga->user->tanggal_sk)->format('d M Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Nama Koordinator</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nama_koordinator ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">NIK Koordinator</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->nik_koordinator ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Rekening Komunitas</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga->user->rekening_komunitas ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">File SK</p>
                        @if($lembaga->user->file_sk)
                            <a href="{{ Storage::url($lembaga->user->file_sk) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                <i class="fas fa-file-pdf text-red-500"></i> Lihat File
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-400">File KTP Koordinator</p>
                        @if($lembaga->user->file_ktp_koordinator)
                            <a href="{{ Storage::url($lembaga->user->file_ktp_koordinator) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                <i class="fas fa-id-card text-blue-500"></i> Lihat KTP
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

    </div>
</div>
@endsection