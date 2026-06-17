

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-plus text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Tambah Kategori</h2>
                <p class="text-blue-100 text-sm">Tambah kategori baru untuk lembaga sosial</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?php echo e(route('kategori.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Contoh: Pendidikan, Kesehatan, Anak Yatim" required>
            </div>
            <div class="flex justify-end gap-3">
                <a href="<?php echo e(route('kategori.index')); ?>" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/kategori/create.blade.php ENDPATH**/ ?>