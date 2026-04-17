<x-app-layout>
<div class="p-6">

<div class="mb-6">
    <div class="flex items-center gap-2">
        <span class="text-2xl">📋</span>
        <h2 class="text-2xl font-bold text-gray-700">Tambah Informasi Lembaga</h2>
    </div>
    <div class="mt-1 ml-8">
        <p class="text-sm text-gray-400">Lengkapi data anak asuh, kebutuhan donasi, dan status kolaborasi</p>
    </div>
    <div class="mt-3 ml-8">
        <div class="w-16 h-0.5 bg-blue-400 rounded-full"></div>
    </div>
</div>

<form action="{{ route('informasi.store') }}" method="POST">
@csrf

<div class="mb-4">
    <label class="block font-bold mb-1">Jumlah Anak Asuh</label>
    <input type="number" name="jumlah_anak_asuh" class="border p-2 w-full rounded">
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Rentang Usia</label>
    <input type="text" name="rentang_usia" class="border p-2 w-full rounded" placeholder="Contoh: 6-12 tahun">
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Profil Anak Asuh</label>
    <textarea name="profil_anak" rows="3" class="border p-2 w-full rounded" placeholder="Deskripsi singkat tentang anak asuh"></textarea>
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Kebutuhan Donasi</label>
    <div id="donasi-list">
        <div class="donasi-item flex flex-wrap gap-2 mb-2 items-center">
            <input type="text" name="donasi_nama[]" class="border p-2 flex-1 rounded" placeholder="Nama barang" style="min-width: 150px;">
            <input type="text" name="donasi_jumlah[]" class="border p-2 w-24 rounded" placeholder="Jumlah">
            
            <div class="flex gap-2">
                <select name="donasi_satuan[]" class="border p-2 rounded satuan-select">
                    <option value="kg">Kg</option>
                    <option value="liter">Liter</option>
                    <option value="paket">Paket</option>
                    <option value="unit">Unit</option>
                    <option value="lainnya">Lainnya...</option>
                </select>
                <input type="text" name="donasi_satuan_lainnya[]" class="border p-2 rounded hidden satuan-lainnya" placeholder="Satuan lain" style="display: none; width: 100px;">
            </div>
            
            <button type="button" 
                    onclick="this.closest('.donasi-item').remove()"
                    style="background: #dc2626 !important; background-color: #dc2626 !important; color: #ffffff !important; padding: 8px 16px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important; font-weight: 500 !important;">
                Hapus
            </button>
        </div>
    </div>
    <button type="button" 
            id="tambah-donasi"
            style="background: #2563eb !important; background-color: #2563eb !important; color: #ffffff !important; padding: 8px 16px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important; margin-top: 8px !important; display: inline-flex !important; align-items: center !important; gap: 5px !important;">
        <svg style="width: 16px; height: 16px; color: #ffffff !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Kebutuhan
    </button>
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Status Kolaborasi</label>
    <select name="status_kolaborasi" class="border p-2 w-full rounded">
        <option value="dibuka">Dibuka</option>
        <option value="ditutup">Ditutup</option>
    </select>
</div>
<a href="{{ route('informasi.index') }}" 
       style="background-color: #6b7280 !important; color: white !important; font-weight: 500 !important; padding: 10px 24px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-block;">
        Batal
    </a>
<button type="submit" 
        style="background: #2563eb !important; background-color: #2563eb !important; color: #ffffff !important; font-weight: 500 !important; padding: 10px 24px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important;">
    Simpan
</button>
</form>

</div>

<script>
    document.getElementById('donasi-list').addEventListener('change', function(e) {
        if (e.target.classList.contains('satuan-select')) {
            const item = e.target.closest('.donasi-item');
            const lainnyaInput = item.querySelector('.satuan-lainnya');
            if (e.target.value === 'lainnya') {
                lainnyaInput.style.display = 'block';
            } else {
                lainnyaInput.style.display = 'none';
                lainnyaInput.value = '';
            }
        }
    });
    
    document.getElementById('tambah-donasi').addEventListener('click', function() {
        const container = document.getElementById('donasi-list');
        const newItem = document.createElement('div');
        newItem.className = 'donasi-item flex flex-wrap gap-2 mb-2 items-center';
        newItem.innerHTML = `
            <input type="text" name="donasi_nama[]" class="border p-2 flex-1 rounded" placeholder="Nama barang" style="min-width: 150px;">
            <input type="text" name="donasi_jumlah[]" class="border p-2 w-24 rounded" placeholder="Jumlah">
            
            <div class="flex gap-2">
                <select name="donasi_satuan[]" class="border p-2 rounded satuan-select">
                    <option value="kg">Kg</option>
                    <option value="liter">Liter</option>
                    <option value="paket">Paket</option>
                    <option value="unit">Unit</option>
                    <option value="lainnya">Lainnya...</option>
                </select>
                <input type="text" name="donasi_satuan_lainnya[]" class="border p-2 rounded hidden satuan-lainnya" placeholder="Satuan lain" style="display: none; width: 100px;">
            </div>
            
            <button type="button" 
                    onclick="this.closest('.donasi-item').remove()"
                    style="background: #dc2626 !important; background-color: #dc2626 !important; color: #ffffff !important; padding: 8px 16px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important; font-weight: 500 !important;">
                Hapus
            </button>
        `;
        container.appendChild(newItem);
    });
</script>
</x-app-layout>