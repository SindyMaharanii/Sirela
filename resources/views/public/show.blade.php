@extends('layouts.app')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <!-- Tombol Kembali -->
    <a href="/" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-6 hover:gap-3 transition-all duration-300">
        <i class="fas fa-arrow-left text-sm"></i>
        <span>Kembali ke Daftar Lembaga</span>
    </a>

    <!-- Card Profil Lembaga -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 px-6 py-5">
            <div class="flex flex-wrap justify-between items-start gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-building text-white text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white">{{ $lembaga['nama_lembaga'] }}</h1>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <!-- STATUS KOLABORASI -->
            @php
                $statusKolab = '';
                if(isset($lembaga['informasi']) && isset($lembaga['informasi']['status_kolaborasi'])) {
                    $statusKolab = $lembaga['informasi']['status_kolaborasi'];
                }
            @endphp
            
            <div class="mb-6 p-4 rounded-xl {{ $statusKolab == 'dibuka' ? 'bg-green-50 border border-green-200' : ($statusKolab == 'ditutup' ? 'bg-gray-50 border border-gray-200' : 'bg-yellow-50 border border-yellow-200') }}">
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="flex-shrink-0">
                        @if($statusKolab == 'dibuka')
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-md">
                                <i class="fas fa-handshake text-white text-xl"></i>
                            </div>
                        @elseif($statusKolab == 'ditutup')
                            <div class="w-12 h-12 bg-gray-500 rounded-full flex items-center justify-center shadow-md">
                                <i class="fas fa-lock text-white text-xl"></i>
                            </div>
                        @else
                            <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center shadow-md">
                                <i class="fas fa-question-circle text-white text-xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        @if($statusKolab == 'dibuka')
                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">✓ Dibuka untuk Kolaborasi</span>
                            </div>
                            <p class="text-green-800 text-sm">Lembaga ini <span class="font-semibold">MEMBUKA PELUANG KERJA SAMA</span> dengan relawan, donatur, atau mitra. Hubungi kontak yang tersedia.</p>
                        @elseif($statusKolab == 'ditutup')
                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">✗ Tidak Membuka Kolaborasi</span>
                            </div>
                            <p class="text-gray-700 text-sm">Lembaga ini saat ini <span class="font-semibold">TIDAK MEMBUKA KOLABORASI</span>. Namun donasi tetap dapat disalurkan.</p>
                        @else
                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">❓ Belum Ada Informasi</span>
                            </div>
                            <p class="text-yellow-800 text-sm">Lembaga ini belum mengupdate status kolaborasi. Hubungi kontak yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info Kontak -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-xl">
                    <i class="fas fa-map-marker-alt text-blue-500 mt-0.5 text-lg"></i>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Lokasi</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga['lokasi'] ?? $lembaga['alamat'] ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-xl">
                    <i class="fas fa-phone text-blue-500 mt-0.5 text-lg"></i>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Kontak</p>
                        <p class="text-gray-800 font-medium">{{ $lembaga['kontak'] ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
            </div>

            <!-- KATEGORI -->
            <div class="mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100">
                    <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fas fa-tags text-blue-500"></i> Kategori Lembaga
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @if(isset($lembaga['kategori']) && count($lembaga['kategori']) > 0)
                            @foreach($lembaga['kategori'] as $kat)
                                <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 px-3 py-1.5 rounded-full text-sm font-medium">
                                    <i class="fas fa-tag mr-1 text-blue-500 text-xs"></i> {{ $kat['nama_kategori'] }}
                                </span>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center gap-2 text-gray-500 bg-white/50 px-4 py-3 rounded-lg w-full">
                                <i class="fas fa-folder-open text-gray-400"></i>
                                <span class="text-sm">Belum ada kategori yang ditambahkan</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- VISI, MISI, DESKRIPSI -->
            @if(isset($lembaga['visi']) && !empty($lembaga['visi']))
            <div class="mb-4 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2"><i class="fas fa-eye text-indigo-500"></i><h3 class="font-bold text-gray-700">Visi</h3></div>
                <p class="text-gray-700">{{ $lembaga['visi'] }}</p>
            </div>
            @endif
            
            @if(isset($lembaga['misi']) && !empty($lembaga['misi']))
            <div class="mb-4 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2"><i class="fas fa-bullseye text-indigo-500"></i><h3 class="font-bold text-gray-700">Misi</h3></div>
                <p class="text-gray-700">{{ $lembaga['misi'] }}</p>
            </div>
            @endif
            
            @if(isset($lembaga['deskripsi']) && !empty($lembaga['deskripsi']))
            <div class="mb-4 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl">
                <div class="flex items-center gap-2 mb-2"><i class="fas fa-file-alt text-indigo-500"></i><h3 class="font-bold text-gray-700">Deskripsi</h3></div>
                <p class="text-gray-700 leading-relaxed">{{ $lembaga['deskripsi'] }}</p>
            </div>
            @endif
        </div>
    </div>

    @if(isset($lembaga['informasi']) && $lembaga['informasi'])
    @php 
        $info = $lembaga['informasi'];
        $donasiList = json_decode($info['kebutuhan_donasi_list'] ?? '[]', true);
        if(!is_array($donasiList)) $donasiList = [];
    @endphp
    
    <!-- Card Data Anak Asuh -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-teal-500 to-emerald-600 px-6 py-4">
            <div class="flex items-center gap-2"><i class="fas fa-child text-white text-xl"></i><h2 class="text-xl font-bold text-white">Data Anak Asuh</h2></div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 text-center border border-blue-200">
                    <i class="fas fa-users text-blue-500 text-3xl mb-2"></i>
                    <p class="text-3xl font-bold text-blue-600">{{ $info['jumlah_anak_asuh'] ?? 0 }}</p>
                    <p class="text-gray-600 text-sm">Jumlah Anak Asuh</p>
                </div>
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl p-4 text-center border border-emerald-200">
                    <i class="fas fa-calendar-alt text-emerald-500 text-3xl mb-2"></i>
                    <p class="text-3xl font-bold text-emerald-600">{{ $info['rentang_usia'] ?? '-' }}</p>
                    <p class="text-gray-600 text-sm">Rentang Usia</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 text-center border border-purple-200">
                    <i class="fas fa-clock text-purple-500 text-3xl mb-2"></i>
                    <p class="text-base font-bold text-purple-600">📅 {{ isset($info['tanggal_update']) && $info['tanggal_update'] ? date('d M Y', strtotime($info['tanggal_update'])) : '-' }}</p>
                    <p class="text-gray-600 text-sm">Terakhir Update</p>
                </div>
            </div>
            @if(isset($info['profil_anak']) && !empty($info['profil_anak']))
            <div class="mt-5 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                <div class="flex items-start gap-3"><div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center"><i class="fas fa-file-alt text-blue-500"></i></div><div><p class="text-sm font-semibold text-gray-700 mb-1">Deskripsi Anak Asuh</p><p class="text-gray-600 leading-relaxed">{{ $info['profil_anak'] }}</p></div></div>
            </div>
            @endif
        </div>
    </div>

    <!-- Card Kebutuhan Donasi -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-4">
            <div class="flex items-center gap-2"><i class="fas fa-hand-holding-heart text-white text-xl"></i><h2 class="text-xl font-bold text-white">Kebutuhan Donasi</h2></div>
        </div>
        <div class="p-6">
            @if(count($donasiList) > 0)
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gradient-to-r from-rose-500 to-pink-600 text-white">
                            <th class="border border-gray-300 px-4 py-2 text-left">Nama Kebutuhan</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Jumlah</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Satuan</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Prioritas</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donasiList as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $item['nama'] ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['target'] ?? $item['jumlah'] ?? 0 }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['satuan'] ?? 'unit' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                @php $prioritas = $item['prioritas'] ?? 'sedang'; @endphp
                                @if($prioritas == 'tinggi') <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Tinggi</span>
                                @elseif($prioritas == 'rendah') <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Rendah</span>
                                @else <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Sedang</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <button onclick="bukaModalDonasi('{{ $info['informasi_id'] }}', '{{ $lembaga['lembaga_id'] }}', '{{ $item['id'] ?? $index }}', '{{ addslashes($item['nama']) }}', '{{ $item['satuan'] ?? 'unit' }}')"
                                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                    <i class="fas fa-hand-holding-heart"></i> Donasi
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-10">
                <i class="fas fa-box-open text-gray-300 text-4xl mb-2"></i>
                <p class="text-gray-500">Belum ada kebutuhan donasi</p>
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8 text-center">
        <i class="fas fa-inbox text-gray-400 text-4xl mb-2"></i>
        <p class="text-gray-500">Belum ada informasi lengkap</p>
        <p class="text-gray-400 text-sm mt-1">Lembaga ini belum mengisi informasi donasi dan anak asuh</p>
    </div>
    @endif
</div>

<!-- MODAL FORM DONASI -->
<div id="modalDonasi" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="sticky top-0 bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-6 py-4 rounded-t-2xl z-10">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-hand-holding-heart text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Form Donasi</h3>
                        <p class="text-blue-100 text-sm">Isi data diri Anda untuk berdonasi</p>
                    </div>
                </div>
                <button onclick="tutupModal()" class="text-white/80 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="p-6">
            <form action="{{ route('donasi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="informasi_id" id="informasi_id">
                <input type="hidden" name="lembaga_id" id="lembaga_id">
                <input type="hidden" name="kebutuhan_id" id="kebutuhan_id">
                <input type="hidden" name="kebutuhan_nama" id="kebutuhan_nama">
                <input type="hidden" name="kebutuhan_jenis" value="barang">
                <input type="hidden" name="satuan" id="satuan">
                
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 mb-5 border border-blue-200">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fas fa-box text-blue-500"></i>
                        <span class="text-xs text-gray-500 uppercase tracking-wide">Kebutuhan Donasi</span>
                    </div>
                    <p class="text-base font-semibold text-gray-800" id="tampilKebutuhan">-</p>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Jumlah Barang (<span id="satuan_label">unit</span>)</label>
                    <input type="number" name="jumlah_barang" id="jumlah_barang" step="0.01" 
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan jumlah barang">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_donatur" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Contoh: Ahmad Setiawan">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">No. HP/WA</label>
                    <input type="tel" name="no_hp" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="08123456789">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email (Opsional)</label>
                    <input type="email" name="email"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="email@contoh.com">
                </div>
                
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Pesan / Doa</label>
                    <textarea name="pesan" rows="3" 
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                              placeholder="Semoga bermanfaat..."></textarea>
                </div>
                
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 mb-5 border border-blue-200">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-500 text-lg mt-0.5"></i>
                        <div>
                            <p class="text-sm font-semibold text-blue-800">Informasi Penting</p>
                            <p class="text-xs text-blue-700">Setelah submit, lembaga akan menghubungi Anda via WhatsApp/Telepon untuk konfirmasi donasi.</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="tutupModal()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-xl font-semibold transition">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white py-3 rounded-xl font-semibold transition shadow-md">
                        Kirim Donasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function bukaModalDonasi(informasiId, lembagaId, kebutuhanId, kebutuhanNama, satuan) {
        document.getElementById('informasi_id').value = informasiId;
        document.getElementById('lembaga_id').value = lembagaId;
        document.getElementById('kebutuhan_id').value = kebutuhanId;
        document.getElementById('kebutuhan_nama').value = kebutuhanNama;
        document.getElementById('satuan').value = satuan;
        document.getElementById('tampilKebutuhan').innerText = kebutuhanNama;
        document.getElementById('satuan_label').innerText = satuan;
        
        document.getElementById('modalDonasi').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function tutupModal() {
        document.getElementById('modalDonasi').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    document.getElementById('modalDonasi').addEventListener('click', function(e) {
        if (e.target === this) tutupModal();
    });
</script>
@endsection