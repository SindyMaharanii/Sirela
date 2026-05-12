<div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4" id="modalDonasi">
    <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Form Donasi</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form action="<?php echo e(route('donasi.store.public')); ?>" method="POST" id="formDonasi">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="informasi_id" value="<?php echo e($informasiId); ?>">
            <input type="hidden" name="lembaga_id" id="lembaga_id" value="">
            <input type="hidden" name="kebutuhan_id" value="<?php echo e($kebutuhanId); ?>">
            <input type="hidden" name="kebutuhan_nama" value="<?php echo e($kebutuhanNama); ?>">
            <input type="hidden" name="kebutuhan_jenis" value="<?php echo e($kebutuhanJenis); ?>">
            <input type="hidden" name="satuan" value="<?php echo e($satuan); ?>">
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kebutuhan</label>
                <p class="text-blue-600 font-medium"><?php echo e($kebutuhanNama); ?></p>
            </div>
            
            <?php if($kebutuhanJenis == 'barang'): ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jumlah Barang (<?php echo e($satuan); ?>)</label>
                <input type="number" name="jumlah_barang" step="0.01" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <?php else: ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nominal Donasi (Rp)</label>
                <input type="number" name="nominal_uang" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <?php endif; ?>
            
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
                <label class="block text-gray-700 font-semibold mb-2">Email (Opsional)</label>
                <input type="email" name="email"
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
                Setelah submit, lembaga akan menghubungi Anda via WhatsApp/Telepon untuk konfirmasi alamat pengiriman atau rekening transfer.
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="closeModal()"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 rounded-lg transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-2 rounded-lg transition hover:shadow-lg">
                    Kirim Donasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Ambil lembaga_id dari halaman
    document.addEventListener('DOMContentLoaded', function() {
        const lembagaId = document.querySelector('meta[name="lembaga-id"]')?.content;
        if (lembagaId) {
            document.getElementById('lembaga_id').value = lembagaId;
        }
    });
    
    function closeModal() {
        document.getElementById('modalDonasi').remove();
    }
</script><?php /**PATH C:\xampp\htdocs\Sirela\resources\views\donasi\form.blade.php ENDPATH**/ ?>