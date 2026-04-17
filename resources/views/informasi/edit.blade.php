<x-app-layout>
<div class="p-6">

<h2 class="text-xl font-bold mb-4">Edit Informasi Lembaga</h2>

<form action="{{ route('informasi.update', $informasi->informasi_id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-4">
    <label class="block font-bold mb-1">Jumlah Anak Asuh</label>
    <input type="number" name="jumlah_anak_asuh" value="{{ $informasi->jumlah_anak_asuh }}" class="border p-2 w-full rounded">
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Rentang Usia</label>
    <input type="text" name="rentang_usia" value="{{ $informasi->rentang_usia }}" class="border p-2 w-full rounded">
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Profil Anak Asuh</label>
    <textarea name="profil_anak" rows="3" class="border p-2 w-full rounded">{{ $informasi->profil_anak }}</textarea>
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Kebutuhan Donasi</label>
    <div id="donasi-list">
        @php
            $donasiList = json_decode($informasi->kebutuhan_donasi_list, true) ?? [];
        @endphp
        @if(count($donasiList) > 0)
            @foreach($donasiList as $donasi)
            <div class="donasi-item flex flex-wrap gap-2 mb-2 items-center">
                <input type="text" name="donasi_nama[]" value="{{ $donasi['nama'] ?? '' }}" class="border p-2 flex-1 rounded" placeholder="Nama barang" style="min-width: 150px;">
                <input type="text" name="donasi_jumlah[]" value="{{ $donasi['jumlah'] ?? '' }}" class="border p-2 w-24 rounded" placeholder="Jumlah">
                <select name="donasi_satuan[]" class="border p-2 rounded">
                    <option value="kg" {{ ($donasi['satuan'] ?? '') == 'kg' ? 'selected' : '' }}>Kg</option>
                    <option value="liter" {{ ($donasi['satuan'] ?? '') == 'liter' ? 'selected' : '' }}>Liter</option>
                    <option value="paket" {{ ($donasi['satuan'] ?? '') == 'paket' ? 'selected' : '' }}>Paket</option>
                    <option value="unit" {{ ($donasi['satuan'] ?? '') == 'unit' ? 'selected' : '' }}>Unit</option>
                </select>
                <button type="button" 
                        onclick="this.closest('.donasi-item').remove()"
                        style="background-color: #dc2626 !important; color: white !important; padding: 8px 16px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important; font-weight: 500 !important;">
                    Hapus
                </button>
            </div>
            @endforeach
        @else
            <div class="donasi-item flex flex-wrap gap-2 mb-2 items-center">
                <input type="text" name="donasi_nama[]" class="border p-2 flex-1 rounded" placeholder="Nama barang" style="min-width: 150px;">
                <input type="text" name="donasi_jumlah[]" class="border p-2 w-24 rounded" placeholder="Jumlah">
                <select name="donasi_satuan[]" class="border p-2 rounded">
                    <option value="kg">Kg</option>
                    <option value="liter">Liter</option>
                    <option value="paket">Paket</option>
                    <option value="unit">Unit</option>
                </select>
                <button type="button" 
                        onclick="this.closest('.donasi-item').remove()"
                        style="background-color: #dc2626 !important; color: white !important; padding: 8px 16px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important; font-weight: 500 !important;">
                    Hapus
                </button>
            </div>
        @endif
    </div>
    <button type="button" 
            id="tambah-donasi"
            style="background-color: #2563eb !important; color: white !important; padding: 8px 16px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important; margin-top: 8px !important; display: inline-flex !important; align-items: center !important; gap: 5px !important;">
        + Tambah Kebutuhan
    </button>
</div>

<div class="mb-4">
    <label class="block font-bold mb-1">Status Kolaborasi</label>
    <select name="status_kolaborasi" class="border p-2 rounded">
        <option value="dibuka" {{ $informasi->status_kolaborasi == 'dibuka' ? 'selected' : '' }}>Dibuka</option>
        <option value="ditutup" {{ $informasi->status_kolaborasi == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
    </select>
</div>

<a href="{{ route('informasi.index') }}" 
       style="background-color: #6b7280 !important; color: white !important; font-weight: 500 !important; padding: 10px 24px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-block;">
        Batal
    </a>
<button type="submit" 
        style="background-color: #2563eb !important; color: white !important; font-weight: 500 !important; padding: 10px 24px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important;">
    Update
</button>

</form>

</div>

<script>
    document.getElementById('tambah-donasi').addEventListener('click', function() {
        const container = document.getElementById('donasi-list');
        const newItem = document.createElement('div');
        newItem.className = 'donasi-item flex flex-wrap gap-2 mb-2 items-center';
        newItem.innerHTML = `
            <input type="text" name="donasi_nama[]" class="border p-2 flex-1 rounded" placeholder="Nama barang" style="min-width: 150px;">
            <input type="text" name="donasi_jumlah[]" class="border p-2 w-24 rounded" placeholder="Jumlah">
            <select name="donasi_satuan[]" class="border p-2 rounded">
                <option value="kg">Kg</option>
                <option value="liter">Liter</option>
                <option value="paket">Paket</option>
                <option value="unit">Unit</option>
            </select>
            <button type="button" 
                    onclick="this.closest('.donasi-item').remove()"
                    style="background-color: #dc2626 !important; color: white !important; padding: 8px 16px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important; font-weight: 500 !important;">
                Hapus
            </button>
        `;
        container.appendChild(newItem);
    });
</script>
</x-app-layout>