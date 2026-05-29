

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <!-- Header dengan gradasi biru -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Kelola Kategori</h2>
                    <p class="text-blue-100 text-sm">Tambah, edit, atau hapus kategori lembaga</p>
                </div>
            </div>
            <a href="<?php echo e(route('kategori.create')); ?>" class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <?php
            $kategori = \App\Models\Kategori::all();
        ?>
        
        <!-- Statistik card -->
        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Kategori</p>
                    <p class="text-3xl font-bold text-white"><?php echo e($kategori->count()); ?></p>
                </div>
                <i class="fas fa-tag text-4xl text-white/30"></i>
            </div>
        </div>
        
        <?php if($kategori->count() > 0): ?>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] text-white">
                        <th class="border border-gray-300 px-4 py-3 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-3 text-left">Nama Kategori</th>
                        <th class="border border-gray-300 px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                        <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($loop->iteration); ?></td>
                        <td class="border border-gray-300 px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-tag text-blue-500 text-sm"></i>
                                </div>
                                <span class="font-semibold text-gray-800"><?php echo e($item->nama_kategori); ?></span>
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('kategori.edit', $item->kategori_id)); ?>" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition inline-flex items-center" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('kategori.destroy', $item->kategori_id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori <?php echo e($item->nama_kategori); ?>?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition inline-flex items-center" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-tags text-gray-400 text-3xl"></i>
            </div>
            <p class="text-gray-500">Belum ada kategori</p>
            <p class="text-sm text-gray-400 mt-1">Silakan tambah kategori baru</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/kategori/index.blade.php ENDPATH**/ ?>