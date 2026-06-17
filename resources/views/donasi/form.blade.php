<div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4" id="modalDonasi">
    <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Form Donasi</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form action="{{ route('donasi.store') }}" method="POST" id="formDonasi">
            @csrf
            <input type="hidden" name="informasi_id" value="{{ $informasiId }}">
            <input type="hidden" name="lembaga_id" id="lembaga_id" value="">
            <input type="hidden" name="kebutuhan_id" value="{{ $kebutuhanId }}">
            <input type="hidden" name="kebutuhan_nama" value="{{ $kebutuhanNama }}">
            <input type="hidden" name="kebutuhan_jenis" value="{{ $kebutuhanJenis }}">
            <input type="hidden" name="satuan" value="{{ $satuan }}">
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kebutuhan</label>
                <p class="text-blue-600 font-medium">{{ $kebutuhanNama }}</p>
            </div>
            
            @if($kebutuhanJenis == 'barang')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jumlah Barang ({{ $satuan }})</label>
                <input type="text" name="jumlah_barang" id="jumlah_barang" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="0"
                       onkeypress="return hanyaAngka(event)"
                       onkeyup="formatRibuan(this)">
            </div>
            @else
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nominal Donasi (Rp)</label>
                <input type="text" name="nominal_uang" id="nominal_uang" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="0"
                       onkeypress="return hanyaAngka(event)"
                       onkeyup="formatRibuan(this)">
                <p class="text-xs text-gray-400 mt-1">Cukup ketik angka, akan otomatis terformat (contoh: 50000000 → 50.000.000)</p>
            </div>
            @endif
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_donatur" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">No. HP/WA</label>
                <input type="tel" name="no_hp" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pesan/Doa</label>
                <textarea name="pesan" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Semoga bermanfaat..."></textarea>
            </div>
            
            <div class="bg-blue-50 rounded-lg p-3 mb-4 text-sm text-blue-700">
                <i class="fas fa-info-circle mr-1"></i> 
                Setelah submit, lembaga akan menghubungi Anda via WhatsApp/Telepon untuk konfirmasi.
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="closeModal()"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 rounded-lg transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-amber-500 to-orange-600 text-white py-2 rounded-lg transition hover:shadow-lg">
                    Kirim Donasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi hanya menerima angka
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    
    // Fungsi format angka dengan titik ribuan
    function formatRibuan(input) {
        // Hapus semua titik yang sudah ada
        let value = input.value.replace(/\./g, '');
        if (value === '') value = '0';
        let number = parseInt(value);
        if (isNaN(number)) number = 0;
        
        // Simpan nilai asli (tanpa titik) ke attribute data-raw
        input.setAttribute('data-raw', number);
        
        // Tampilkan dengan format titik ribuan
        input.value = number.toLocaleString('id-ID');
    }
    
    // Sebelum submit, ubah nilai input kembali ke angka tanpa titik
    document.getElementById('formDonasi').addEventListener('submit', function(e) {
        const jumlahBarang = document.getElementById('jumlah_barang');
        const nominalUang = document.getElementById('nominal_uang');
        
        if (jumlahBarang) {
            let rawValue = jumlahBarang.getAttribute('data-raw') || jumlahBarang.value.replace(/\./g, '');
            jumlahBarang.value = rawValue;
        }
        
        if (nominalUang) {
            let rawValue = nominalUang.getAttribute('data-raw') || nominalUang.value.replace(/\./g, '');
            nominalUang.value = rawValue;
        }
    });
    
    // Ambil lembaga_id dari halaman
    document.addEventListener('DOMContentLoaded', function() {
        const lembagaId = document.querySelector('meta[name="lembaga-id"]')?.content;
        if (lembagaId) {
            document.getElementById('lembaga_id').value = lembagaId;
        }
    });
    
    function closeModal() {
        const modal = document.getElementById('modalDonasi');
        if (modal) modal.remove();
    }
</script>