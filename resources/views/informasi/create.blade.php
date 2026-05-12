@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header dengan gradasi biru SAMA seperti sidebar -->
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-plus text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Tambah Informasi Donasi</h2>
                <p class="text-blue-100 text-sm">Tambah data donasi dan anak asuh lembaga</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <form action="{{ route('informasi.store') }}" method="POST">
            @csrf

            <!-- Jumlah Anak Asuh -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jumlah Anak Asuh</label>
                <input type="number" name="jumlah_anak_asuh" value="{{ old('jumlah_anak_asuh') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Rentang Usia -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Rentang Usia</label>
                <input type="text" name="rentang_usia" value="{{ old('rentang_usia') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Contoh: 6-12 tahun">
            </div>

            <!-- Profil Anak Asuh -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Profil Anak Asuh</label>
                <textarea name="profil_anak" rows="3" 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Deskripsi singkat tentang anak asuh">{{ old('profil_anak') }}</textarea>
            </div>

            <!-- Kebutuhan Donasi dengan satuan "Lainnya" -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kebutuhan Donasi</label>
                <div id="donasi-list">
                    <div class="donasi-item flex flex-wrap gap-2 mb-2 items-center">
                        <input type="text" name="donasi_nama[]" class="flex-1 border border-gray-300 rounded-lg px-3 py-2" placeholder="Nama barang" style="min-width: 150px;">
                        <input type="text" name="donasi_jumlah[]" class="w-24 border border-gray-300 rounded-lg px-3 py-2" placeholder="Jumlah">
                        <div class="flex gap-2">
                            <select name="donasi_satuan[]" class="satuan-select border border-gray-300 rounded-lg px-3 py-2">
                                <option value="kg">Kg</option>
                                <option value="liter">Liter</option>
                                <option value="paket">Paket</option>
                                <option value="unit">Unit</option>
                                <option value="lainnya">Lainnya...</option>
                            </select>
                            <input type="text" name="donasi_satuan_lainnya[]" 
                                   class="satuan-lainnya border border-gray-300 rounded-lg px-3 py-2" 
                                   placeholder="Satuan lain" style="width: 100px; display: none;">
                        </div>
                        <button type="button" onclick="this.closest('.donasi-item').remove()" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition">
                            Hapus
                        </button>
                    </div>
                </div>
                <button type="button" id="tambah-donasi" 
                        class="mt-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg transition inline-flex items-center gap-2 shadow-md">
                    <i class="fas fa-plus"></i> Tambah Kebutuhan
                </button>
            </div>

            <!-- Status Kolaborasi -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Status Kolaborasi</label>
                <select name="status_kolaborasi" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="dibuka">Dibuka</option>
                    <option value="ditutup">Ditutup</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('informasi.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                    Batal
                </a>
                <!-- TOMBOL SIMPAN WARNA KUNING/ORANYE GRADASI -->
                <button type="submit" 
                        class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg transition shadow-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk menangani pilihan "Lainnya" pada satuan
    function handleSatuanChange(selectElement) {
        const item = selectElement.closest('.donasi-item');
        const lainnyaInput = item.querySelector('.satuan-lainnya');
        if (selectElement.value === 'lainnya') {
            lainnyaInput.style.display = 'inline-block';
        } else {
            lainnyaInput.style.display = 'none';
            lainnyaInput.value = '';
        }
    }

    // Event listener untuk semua select satuan yang sudah ada
    document.querySelectorAll('.satuan-select').forEach(select => {
        select.addEventListener('change', function() {
            handleSatuanChange(this);
        });
    });

    // Tombol tambah donasi
    document.getElementById('tambah-donasi').addEventListener('click', function() {
        const container = document.getElementById('donasi-list');
        const newItem = document.createElement('div');
        newItem.className = 'donasi-item flex flex-wrap gap-2 mb-2 items-center';
        newItem.innerHTML = `
            <input type="text" name="donasi_nama[]" class="flex-1 border border-gray-300 rounded-lg px-3 py-2" placeholder="Nama barang" style="min-width: 150px;">
            <input type="text" name="donasi_jumlah[]" class="w-24 border border-gray-300 rounded-lg px-3 py-2" placeholder="Jumlah">
            <div class="flex gap-2">
                <select name="donasi_satuan[]" class="satuan-select border border-gray-300 rounded-lg px-3 py-2">
                    <option value="kg">Kg</option>
                    <option value="liter">Liter</option>
                    <option value="paket">Paket</option>
                    <option value="unit">Unit</option>
                    <option value="lainnya">Lainnya...</option>
                </select>
                <input type="text" name="donasi_satuan_lainnya[]" 
                       class="satuan-lainnya border border-gray-300 rounded-lg px-3 py-2" 
                       placeholder="Satuan lain" style="width: 100px; display: none;">
            </div>
            <button type="button" onclick="this.closest('.donasi-item').remove()" 
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition">
                Hapus
            </button>
        `;
        container.appendChild(newItem);
        
        // Tambahkan event listener untuk select yang baru
        const newSelect = newItem.querySelector('.satuan-select');
        newSelect.addEventListener('change', function() {
            handleSatuanChange(this);
        });
    });
</script>
@endsection