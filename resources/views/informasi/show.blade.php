@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <a href="{{ route('lembaga.show', $informasi->lembaga_id) }}" class="text-blue-600 mb-4 inline-block">← Kembali ke Profil Lembaga</a>

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-teal-500 to-emerald-600 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Data Anak Asuh & Status Kolaborasi</h2>
                <a href="{{ route('informasi.edit', $informasi->informasi_id) }}" 
                   class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-edit"></i> Edit Informasi
                </a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="bg-blue-50 rounded-xl p-4 text-center">
                        <p class="text-3xl font-bold text-blue-600">{{ $informasi->jumlah_anak_asuh ?? 0 }}</p>
                        <p class="text-gray-600 text-sm">Jumlah Anak Asuh</p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-4 text-center">
                        <p class="text-3xl font-bold text-emerald-600">{{ $informasi->rentang_usia ?? '-' }}</p>
                        <p class="text-gray-600 text-sm">Rentang Usia</p>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 text-center">
                        <p class="font-bold text-purple-600">{{ \Carbon\Carbon::parse($informasi->tanggal_update ?? now())->format('d M Y H:i') }}</p>
                        <p class="text-gray-600 text-sm">Terakhir Update</p>
                    </div>
                </div>
                
                @if($informasi->status_kolaborasi == 'dibuka')
                    <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-center">
                        <span class="text-green-700 font-semibold">✓ Dibuka untuk Kolaborasi</span>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-xl p-3 text-center">
                        <span class="text-red-700 font-semibold">✗ Tidak Membuka Kolaborasi</span>
                    </div>
                @endif
                
                @if($informasi->profil_anak)
                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <p class="font-semibold">Deskripsi Anak Asuh:</p>
                    <p>{{ $informasi->profil_anak }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Daftar Kebutuhan Donasi</h2>
                <button onclick="bukaModalTambah()" 
                        class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Kebutuhan
                </button>
            </div>
            <div class="p-6">
                @php
                    $list = json_decode($informasi->kebutuhan_donasi_list ?? '[]', true);
                    if(!is_array($list)) $list = [];
                @endphp
                
                @if(count($list) > 0)
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
                            @foreach($list as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $item['nama'] ?? '-' }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['target'] ?? $item['jumlah'] ?? 0 }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['satuan'] ?? 'unit' }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    @php $prioritas = $item['prioritas'] ?? 'sedang'; @endphp
                                    @if($prioritas == 'tinggi')
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Tinggi</span>
                                    @elseif($prioritas == 'rendah')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Rendah</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Sedang</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="bukaModalEdit('{{ $index }}')" 
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button onclick="hapusKebutuhan('{{ $index }}', '{{ addslashes($item['nama']) }}')" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
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
                    <p class="text-gray-400 text-sm">Klik tombol "Tambah Kebutuhan" untuk menambahkan</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="modalKebutuhan" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white rounded-xl max-w-md w-full shadow-xl">
        <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-6 py-4 rounded-t-xl flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-bold text-white">Tambah Kebutuhan Donasi</h3>
            <button onclick="tutupModal()" class="text-white/80 hover:text-white"><i class="fas fa-times text-xl"></i></button>
        </div>
        <div class="p-6">
            <form id="formKebutuhan">
                @csrf
                <input type="hidden" name="item_index" id="item_index" value="">
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Kebutuhan</label>
                    <input type="text" name="nama" id="nama_kebutuhan" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Contoh: Beras, Susu, Buku">
                </div>
                
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="0">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Satuan</label>
                        <select name="satuan" id="satuan" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <option value="kg">Kg</option>
                            <option value="liter">Liter</option>
                            <option value="paket">Paket</option>
                            <option value="unit">Unit</option>
                            <option value="lainnya">Lainnya...</option>
                        </select>
                        <input type="text" name="satuan_custom" id="satuan_custom" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-2 hidden" 
                               placeholder="Masukkan satuan (contoh: karung, dus, lembar)">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Prioritas</label>
                    <select name="prioritas" id="prioritas" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="tinggi">Tinggi</option>
                        <option value="sedang" selected>Sedang</option>
                        <option value="rendah">Rendah</option>
                    </select>
                </div>
                
                <div class="flex gap-3 mt-4">
                    <button type="button" onclick="tutupModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-amber-500 to-orange-600 text-white py-2 rounded-lg shadow-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentList = @json($list);
    let informasiId = {{ $informasi->informasi_id }};
    let csrfToken = '{{ csrf_token() }}';

    const satuanSelect = document.getElementById('satuan');
    const satuanCustom = document.getElementById('satuan_custom');
    
    satuanSelect.addEventListener('change', function() {
        if (this.value === 'lainnya') {
            satuanCustom.classList.remove('hidden');
            satuanCustom.required = true;
        } else {
            satuanCustom.classList.add('hidden');
            satuanCustom.required = false;
            satuanCustom.value = '';
        }
    });

    function bukaModalTambah() {
        document.getElementById('modalTitle').innerText = 'Tambah Kebutuhan Donasi';
        document.getElementById('item_index').value = '';
        document.getElementById('nama_kebutuhan').value = '';
        document.getElementById('jumlah').value = '';
        document.getElementById('prioritas').value = 'sedang';
        document.getElementById('satuan').value = 'kg';
        satuanCustom.classList.add('hidden');
        satuanCustom.value = '';
        document.getElementById('modalKebutuhan').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function bukaModalEdit(index) {
        const item = currentList[index];
        if (!item) return;
        
        document.getElementById('modalTitle').innerText = 'Edit Kebutuhan Donasi';
        document.getElementById('item_index').value = index;
        document.getElementById('nama_kebutuhan').value = item.nama || '';
        document.getElementById('jumlah').value = item.target || item.jumlah || 0;
        document.getElementById('prioritas').value = item.prioritas || 'sedang';
        
        const satuan = item.satuan || 'kg';
        const isCustom = !['kg', 'liter', 'paket', 'unit'].includes(satuan);
        
        if (isCustom) {
            satuanSelect.value = 'lainnya';
            satuanCustom.classList.remove('hidden');
            satuanCustom.value = satuan;
        } else {
            satuanSelect.value = satuan;
            satuanCustom.classList.add('hidden');
            satuanCustom.value = '';
        }
        
        document.getElementById('modalKebutuhan').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hapusKebutuhan(index, nama) {
        if (confirm(`Yakin ingin menghapus "${nama}"?`)) {
            currentList.splice(parseInt(index), 1);
            simpanKeServer();
        }
    }

    async function simpanKeServer() {
        const response = await fetch('{{ route("informasi.kebutuhan.update", $informasi->informasi_id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ kebutuhan_list: currentList })
        });
        
        if (response.ok) {
            window.location.reload();
        } else {
            alert('Gagal menyimpan data');
        }
    }

    document.getElementById('formKebutuhan').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const index = document.getElementById('item_index').value;
        let satuan = satuanSelect.value;
        
        if (satuan === 'lainnya') {
            satuan = satuanCustom.value;
            if (!satuan) { alert('Silakan isi satuan'); return; }
        }
        
        const newItem = {
            id: (index === '') ? Date.now().toString() : (currentList[parseInt(index)]?.id || Date.now().toString()),
            nama: document.getElementById('nama_kebutuhan').value,
            target: parseInt(document.getElementById('jumlah').value) || 0,
            jumlah: document.getElementById('jumlah').value,
            terkumpul: (index !== '' && currentList[parseInt(index)]?.terkumpul) || 0,
            satuan: satuan,
            prioritas: document.getElementById('prioritas').value,
            jenis: 'barang'
        };
        
        if (!newItem.nama) { alert('Nama kebutuhan wajib diisi'); return; }
        
        if (index === '') {
            currentList.push(newItem);
        } else {
            currentList[parseInt(index)] = newItem;
        }
        
        await simpanKeServer();
    });

    function tutupModal() {
        document.getElementById('modalKebutuhan').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('modalKebutuhan').addEventListener('click', function(e) {
        if (e.target === this) tutupModal();
    });
</script>
@endsection