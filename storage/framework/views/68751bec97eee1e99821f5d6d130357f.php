

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-user-check text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Verifikasi Akun Lembaga</h2>
                <p class="text-blue-100 text-sm">Aktifkan atau nonaktifkan akun lembaga yang mendaftar</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <?php
            $users = \App\Models\User::where('role', 'lembaga')->get();
        ?>
   
        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Lembaga Terdaftar</p>
                    <p class="text-3xl font-bold text-white"><?php echo e($users->count()); ?></p>
                </div>
                <i class="fas fa-building text-4xl text-white/30"></i>
            </div>
        </div>
        
        <?php if($users->count() > 0): ?>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] text-white">
                        <th class="border border-gray-300 px-4 py-3 text-left">Nama Lembaga</th>
                        <th class="border border-gray-300 px-4 py-3 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-3 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-3 text-center" colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Ambil data lembaga 
                        $lembagaUser = \App\Models\Lembaga::where('pengguna_id', $user->id)->first();
                    ?>
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                        <td class="border border-gray-300 px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-building text-blue-500 text-sm"></i>
                                </div>
                                <span class="font-semibold text-gray-800"><?php echo e($user->nama_lembaga ?? $user->name); ?></span>
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($user->email); ?></td>
                        <td class="border border-gray-300 px-4 py-3">
                            <?php if($user->status_akun == 'aktif'): ?>
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-circle text-[6px] text-green-500"></i> Aktif
                                </span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fas fa-circle text-[6px] text-red-500"></i> Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <!-- Tombol Detail Registrasi (Khusus Admin) -->
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <?php if($lembagaUser): ?>
                                <a href="<?php echo e(route('admin.detail.lembaga', $user->id)); ?>" 
                                   class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded-lg transition inline-flex items-center gap-1" 
                                   title="Lihat Data Registrasi Lengkap Lembaga">
                                    <i class="fas fa-file-alt"></i> Detail Registrasi
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400 text-sm">Profil belum dibuat</span>
                            <?php endif; ?>
                        </td>
                        <!-- Tombol Aktifkan/Nonaktifkan -->
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <form action="<?php echo e(route('verifikasi.toggle', $user->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button type="submit" class="px-4 py-2 rounded-lg text-white font-medium transition-all duration-200 
                                    <?php echo e($user->status_akun == 'aktif' 
                                        ? 'bg-red-500 hover:bg-red-600' 
                                        : 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700'); ?>">
                                    <?php echo e($user->status_akun == 'aktif' ? 'Nonaktifkan' : 'Aktifkan'); ?>

                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        <!-- Informasi -->
        <div class="mt-4 p-3 bg-purple-50 rounded-lg border border-purple-200">
            <div class="flex items-center gap-2 text-purple-700">
                <i class="fas fa-info-circle"></i>
                <span class="text-sm font-semibold">Informasi:</span>
                <span class="text-sm">Klik <strong>"Detail Registrasi"</strong> untuk melihat data lengkap pendaftaran lembaga (alamat, legalitas, dokumen, dll).</span>
            </div>
        </div>
        
        <?php else: ?>
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-gray-400 text-3xl"></i>
            </div>
            <p class="text-gray-500">Belum ada lembaga yang mendaftar</p>
            <p class="text-sm text-gray-400 mt-1">Silakan daftar sebagai lembaga terlebih dahulu</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/verifikasi.blade.php ENDPATH**/ ?>