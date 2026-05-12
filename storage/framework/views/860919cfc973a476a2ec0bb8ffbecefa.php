

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-building text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Buat Profil Lembaga</h2>
                <p class="text-blue-100 text-sm">Lengkapi data lembaga sosial Anda</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?php echo e(route('lembaga.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lembaga <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lembaga" value="<?php echo e(old('nama_lembaga')); ?>" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                    <textarea name="alamat" rows="2" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('alamat')); ?></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Lokasi / Kota</label>
                    <input type="text" name="lokasi" value="<?php echo e(old('lokasi')); ?>"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Contoh: Jakarta, Bandung, Surabaya">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Kontak (Telepon/WA)</label>
                    <input type="text" name="kontak" value="<?php echo e(old('kontak')); ?>"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="08123456789">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Visi</label>
                    <textarea name="visi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('visi')); ?></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Misi</label>
                    <textarea name="misi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('misi')); ?></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi Lembaga</label>
                    <textarea name="deskripsi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('deskripsi')); ?></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Kategori Lembaga</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 p-3 bg-gray-50 rounded-lg">
                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kategori_id[]" value="<?php echo e($k->kategori_id); ?>"
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700"><?php echo e($k->nama_kategori); ?></span>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="<?php echo e(route('dashboard')); ?>" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views\lembaga\create.blade.php ENDPATH**/ ?>