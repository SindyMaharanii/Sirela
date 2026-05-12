

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-t-xl px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Edit Profil Lembaga</h2>
                    <p class="text-yellow-100 text-sm">Perbarui informasi profil lembaga Anda</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-b-xl shadow-lg p-6">
            <form action="<?php echo e(route('lembaga.update', $lembaga->lembaga_id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lembaga <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lembaga" value="<?php echo e($lembaga->nama_lembaga); ?>" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                    <textarea name="alamat" rows="2" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"><?php echo e($lembaga->alamat); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                    <input type="text" name="lokasi" value="<?php echo e($lembaga->lokasi); ?>" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Contoh: Jakarta, Bandung, Surabaya">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Kontak</label>
                    <input type="text" name="kontak" value="<?php echo e($lembaga->kontak); ?>" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Nomor telepon / WhatsApp">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Visi</label>
                    <textarea name="visi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"><?php echo e($lembaga->visi); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Misi</label>
                    <textarea name="misi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"><?php echo e($lembaga->misi); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"><?php echo e($lembaga->deskripsi); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 p-3 bg-gray-50 rounded-lg">
                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kategori_id[]" value="<?php echo e($k->kategori_id); ?>" 
                                   <?php if($lembaga->kategori->contains($k->kategori_id)): ?> checked <?php endif; ?>
                                   class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                            <span class="text-sm text-gray-700"><?php echo e($k->nama_kategori); ?></span>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="<?php echo e(route('lembaga.index')); ?>" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views\lembaga\edit.blade.php ENDPATH**/ ?>