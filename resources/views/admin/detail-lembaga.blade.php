@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <a href="{{ route('verifikasi') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Verifikasi Akun
        </a>

        <div class="bg-gradient-to-r from-purple-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-building text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $user->nama_lembaga ?? $user->name }}</h1>
                        <p class="text-purple-200 mt-1">Data Lengkap Registrasi Lembaga</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fas fa-file-alt"></i> Data Registrasi Lengkap Lembaga
                </h2>
            </div>
            <div class="p-6">
                
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-user-circle text-blue-500"></i> Akun Login
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Nama Pengguna</p>
                            <p class="text-gray-800 font-medium">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Email Login</p>
                            <p class="text-gray-800 font-medium">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Role</p>
                            <p class="text-gray-800 font-medium">{{ ucfirst($user->role) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Status Akun</p>
                            @if($user->status_akun == 'aktif')
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-semibold">✓ Aktif</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold">✗ Nonaktif</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Tanggal Bergabung</p>
                            <p class="text-gray-800 font-medium">{{ $user->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-building text-emerald-500"></i> Data Lembaga (Registrasi)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Nama Lembaga</p>
                            <p class="text-gray-800 font-medium">{{ $user->nama_lembaga ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Jenis Lembaga</p>
                            <p class="text-gray-800 font-medium">{{ ucfirst($user->jenis_lembaga ?? '-') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Tahun Berdiri</p>
                            <p class="text-gray-800 font-medium">{{ $user->tahun_berdiri ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Alamat Lengkap</p>
                            <p class="text-gray-800 font-medium">{{ $user->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Provinsi</p>
                            <p class="text-gray-800 font-medium">{{ $user->provinsi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Kota/Kabupaten</p>
                            <p class="text-gray-800 font-medium">{{ $user->kota ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Kode Pos</p>
                            <p class="text-gray-800 font-medium">{{ $user->kode_pos ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Telepon Lembaga</p>
                            <p class="text-gray-800 font-medium">{{ $user->telepon_lembaga ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Email Lembaga</p>
                            <p class="text-gray-800 font-medium">{{ $user->email_lembaga ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Website</p>
                            <p class="text-gray-800 font-medium">
                                @if($user->website)
                                    <a href="{{ $user->website }}" target="_blank" class="text-blue-500 hover:underline">{{ $user->website }}</a>
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-gavel text-purple-500"></i> Data Legalitas & Pengurus
                    </h3>

                    @if($user->jenis_lembaga == 'pemerintah')
                        <div class="bg-blue-50 rounded-xl p-4">
                            <p class="font-semibold text-blue-800 mb-3">📋 Data Lembaga Pemerintah</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">Kementerian/Instansi Induk</p>
                                    <p class="text-gray-800">{{ $user->kementerian ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Eselon</p>
                                    <p class="text-gray-800">{{ $user->eselon ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nomor SOTK</p>
                                    <p class="text-gray-800">{{ $user->nomor_sotk ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NIP Pimpinan</p>
                                    <p class="text-gray-800">{{ $user->nip_pimpinan ?? '-' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500">File SOTK</p>
                                    @if($user->file_sotk)
                                        <a href="{{ Storage::url($user->file_sotk) }}" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                            <i class="fas fa-file-pdf text-red-500"></i> Lihat / Unduh File SOTK
                                        </a>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @elseif($user->jenis_lembaga == 'swasta')
                        <div class="bg-green-50 rounded-xl p-4">
                            <p class="font-semibold text-green-800 mb-3">📋 Data Lembaga Swasta</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">Tipe Lembaga</p>
                                    <p class="text-gray-800">{{ $user->tipe_swasta ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nomor Akta Pendirian</p>
                                    <p class="text-gray-800">{{ $user->nomor_akta ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NPWP Lembaga</p>
                                    <p class="text-gray-800">{{ $user->npwp_lembaga ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nama Pimpinan</p>
                                    <p class="text-gray-800">{{ $user->nama_pimpinan ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NIK Pimpinan</p>
                                    <p class="text-gray-800">{{ $user->nik_pimpinan ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Rekening Lembaga</p>
                                    <p class="text-gray-800">{{ $user->rekening_lembaga ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">File Akta</p>
                                    @if($user->file_akta)
                                        <a href="{{ Storage::url($user->file_akta) }}" target="_blank" class="text-blue-500 hover:underline">📄 Lihat File</a>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">File NPWP</p>
                                    @if($user->file_npwp)
                                        <a href="{{ Storage::url($user->file_npwp) }}" target="_blank" class="text-blue-500 hover:underline">📄 Lihat File</a>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500">File KTP Pimpinan</p>
                                    @if($user->file_ktp_pimpinan)
                                        <a href="{{ Storage::url($user->file_ktp_pimpinan) }}" target="_blank" class="text-blue-500 hover:underline">🪪 Lihat KTP</a>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @elseif($user->jenis_lembaga == 'komunitas')
                        <div class="bg-purple-50 rounded-xl p-4">
                            <p class="font-semibold text-purple-800 mb-3">📋 Data Komunitas Sosial</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">Nomor SK KEMENSOS</p>
                                    <p class="text-gray-800">{{ $user->nomor_sk ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Tanggal SK</p>
                                    <p class="text-gray-800">{{ $user->tanggal_sk ? \Carbon\Carbon::parse($user->tanggal_sk)->format('d M Y') : '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nama Koordinator</p>
                                    <p class="text-gray-800">{{ $user->nama_koordinator ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NIK Koordinator</p>
                                    <p class="text-gray-800">{{ $user->nik_koordinator ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Rekening Komunitas</p>
                                    <p class="text-gray-800">{{ $user->rekening_komunitas ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">File SK</p>
                                    @if($user->file_sk)
                                        <a href="{{ Storage::url($user->file_sk) }}" target="_blank" class="text-blue-500 hover:underline">📄 Lihat File</a>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500">File KTP Koordinator</p>
                                    @if($user->file_ktp_koordinator)
                                        <a href="{{ Storage::url($user->file_ktp_koordinator) }}" target="_blank" class="text-blue-500 hover:underline">🪪 Lihat KTP</a>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada data legalitas</p>
                    @endif
                </div>

                @if($lembaga)
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-flag-checkered text-orange-500"></i> Visi, Misi & Deskripsi (Profil)
                    </h3>
                    <div class="space-y-4">
                        @if($lembaga->visi)
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Visi</p>
                            <p class="text-gray-600">{{ $lembaga->visi }}</p>
                        </div>
                        @endif
                        @if($lembaga->misi)
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Misi</p>
                            <p class="text-gray-600">{{ $lembaga->misi }}</p>
                        </div>
                        @endif
                        @if($lembaga->deskripsi)
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Deskripsi</p>
                            <p class="text-gray-600">{{ $lembaga->deskripsi }}</p>
                        </div>
                        @endif
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Kategori</p>
                            <div class="flex flex-wrap gap-1 mt-1">
                                @forelse($lembaga->kategori as $kat)
                                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ $kat->nama_kategori }}</span>
                                @empty
                                    <span class="text-gray-500">-</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection