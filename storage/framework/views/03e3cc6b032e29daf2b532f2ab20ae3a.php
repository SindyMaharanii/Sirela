

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-hand-holding-heart text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Informasi Donasi & Anak Asuh</h2>
                <p class="text-blue-100 text-sm">Data donasi dan anak asuh dari lembaga sosial</p>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php
        $lembaga = \App\Models\Lembaga::where('pengguna_id', Auth::id())->first();
    ?>

    <?php if(Auth::user()->status_akun != 'aktif'): ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-5 py-3">
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock text-white text-lg"></i>
                    <h3 class="text-lg font-bold text-white">Menunggu Verifikasi</h3>
                </div>
            </div>
            <div class="p-5 text-center">
                <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-check text-amber-500 text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Akun Belum Diverifikasi</h4>
                <p class="text-gray-500 text-sm mb-5 max-w-md mx-auto">
                    Akun Anda masih menunggu verifikasi dari administrator. 
                    Silakan tunggu proses verifikasi.
                </p>
                <div class="bg-amber-50 rounded-xl p-4 mb-5 max-w-sm mx-auto">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Status Akun:</span>
                        <span class="text-xs bg-amber-200 text-amber-800 px-2 py-1 rounded-full font-medium">Menunggu Verifikasi</span>
                    </div>
                </div>
                <div class="bg-blue-50 rounded-xl p-4 mb-5 max-w-sm mx-auto text-left">
                    <p class="font-semibold text-blue-800 text-sm mb-2 flex items-center gap-2">
                        <i class="fas fa-star text-yellow-500 text-xs"></i> Fitur setelah verifikasi:
                    </p>
                    <ul class="space-y-1">
                        <li class="flex items-center gap-2 text-sm text-gray-700">
                            <i class="fas fa-check-circle text-green-500 text-xs"></i> Membuat / Mengedit Profil Lembaga
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-700">
                            <i class="fas fa-check-circle text-green-500 text-xs"></i> Mengelola Informasi Donasi & Anak Asuh
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-700">
                            <i class="fas fa-check-circle text-green-500 text-xs"></i> Mengakses Dashboard Lembaga
                        </li>
                    </ul>
                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-lg transition shadow-md">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
                <p class="text-xs text-gray-400 mt-5">
                    <i class="fas fa-envelope mr-1"></i> Hubungi admin: 
                    <a href="mailto:admin@sisorel.com" class="text-blue-500 hover:underline">admin@sisorel.com</a>
                </p>
            </div>
        </div>
    <?php elseif(Auth::user()->role == 'admin'): ?>
        <div class="space-y-6">
            <?php $__empty_1 = true; $__currentLoopData = $informasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-5 py-3">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-white"><?php echo e($item->lembaga->nama_lembaga ?? 'Lembaga'); ?></h3>
                        <a href="<?php echo e(route('informasi.edit', $item->informasi_id)); ?>" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1 rounded-lg text-sm">Edit</a>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-blue-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-blue-600"><?php echo e($item->jumlah_anak_asuh ?? 0); ?></p>
                            <p class="text-xs text-gray-500">Jumlah Anak Asuh</p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-emerald-600"><?php echo e($item->rentang_usia ?? '-'); ?></p>
                            <p class="text-xs text-gray-500">Rentang Usia</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-3 text-center">
                            <p class="text-xs font-bold text-purple-600"><?php echo e(\Carbon\Carbon::parse($item->tanggal_update ?? now())->format('d M Y')); ?></p>
                            <p class="text-xs text-gray-500">Update</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <?php if($item->status_kolaborasi == 'dibuka'): ?>
                            <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                <span class="text-green-700 text-sm">✓ Dibuka untuk Kolaborasi</span>
                            </div>
                        <?php else: ?>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-2 text-center">
                                <span class="text-red-700 text-sm">✗ Tidak Membuka Kolaborasi</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700 mb-2">Daftar Kebutuhan Donasi</p>
                        <?php
                            $donasiList = $item->kebutuhan_donasi_list ?? [];
                            if (is_string($donasiList)) {
                                $donasiList = json_decode($donasiList, true);
                            }
                            if (!is_array($donasiList)) {
                                $donasiList = [];
                            }
                        ?>
                        <?php if(count($donasiList) > 0): ?>
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] text-white">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nama Kebutuhan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Jumlah</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Satuan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Prioritas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $donasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $target = $d['target'] ?? $d['jumlah'] ?? 0;
                                    $jenis = $d['jenis'] ?? 'barang';
                                    $prioritas = $d['prioritas'] ?? 'sedang';
                                ?>
                                <tr class="<?php echo e($idx%2==0 ? 'bg-white' : 'bg-gray-50'); ?>">
                                    <td class="border border-gray-300 px-4 py-2"><?php echo e($d['nama'] ?? '-'); ?></td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <?php if($jenis == 'uang'): ?>
                                            Rp <?php echo e(number_format($target, 0, ',', '.')); ?>

                                        <?php else: ?>
                                            <?php echo e(number_format($target, 0, ',', '.')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center"><?php echo e($d['satuan'] ?? ($jenis == 'uang' ? 'Rupiah' : 'unit')); ?></td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <?php if($prioritas == 'tinggi'): ?>
                                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Tinggi</span>
                                        <?php elseif($prioritas == 'rendah'): ?>
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Rendah</span>
                                        <?php else: ?>
                                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Sedang</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="bg-gray-50 p-4 text-center rounded-lg">
                            <p class="text-gray-500">Belum ada data kebutuhan donasi</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <p class="text-gray-500">Belum ada informasi donasi</p>
                <a href="<?php echo e(route('informasi.create')); ?>" class="text-blue-600 mt-2 inline-block">Tambah sekarang</a>
            </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        
        <div class="space-y-6">
            <?php $__empty_1 = true; $__currentLoopData = $informasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-5 py-3">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-white"><?php echo e($item->lembaga->nama_lembaga ?? 'Lembaga'); ?></h3>
                        <a href="<?php echo e(route('informasi.edit', $item->informasi_id)); ?>" class="bg-white/20 hover:bg-white/30 text-white px-3 py-1 rounded-lg text-sm">Edit Informasi</a>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-blue-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-blue-600"><?php echo e($item->jumlah_anak_asuh ?? 0); ?></p>
                            <p class="text-xs text-gray-500">Jumlah Anak Asuh</p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-emerald-600"><?php echo e($item->rentang_usia ?? '-'); ?></p>
                            <p class="text-xs text-gray-500">Rentang Usia</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-3 text-center">
                            <p class="text-xs font-bold text-purple-600"><?php echo e(\Carbon\Carbon::parse($item->tanggal_update ?? now())->format('d M Y')); ?></p>
                            <p class="text-xs text-gray-500">Update</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <?php if($item->status_kolaborasi == 'dibuka'): ?>
                            <div class="bg-green-50 border border-green-200 rounded-lg p-2 text-center">
                                <span class="text-green-700 text-sm">✓ Dibuka untuk Kolaborasi</span>
                            </div>
                        <?php else: ?>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-2 text-center">
                                <span class="text-red-700 text-sm">✗ Tidak Membuka Kolaborasi</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700 mb-2">Daftar Kebutuhan Donasi</p>
                        <?php
                            $donasiList = $item->kebutuhan_donasi_list ?? [];
                            if (is_string($donasiList)) {
                                $donasiList = json_decode($donasiList, true);
                            }
                            if (!is_array($donasiList)) {
                                $donasiList = [];
                            }
                        ?>
                        <?php if(count($donasiList) > 0): ?>
<table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] text-white">
            <th class="border border-gray-300 px-4 py-2 text-left">Nama Kebutuhan</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Jumlah</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Satuan</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Prioritas</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $donasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $target = $d['target'] ?? $d['jumlah'] ?? 0;
            $jenis = $d['jenis'] ?? 'barang';
            $prioritas = $d['prioritas'] ?? 'sedang';
        ?>
        <tr class="<?php echo e($idx%2==0 ? 'bg-white' : 'bg-gray-50'); ?>">
            <td class="border border-gray-300 px-4 py-2"><?php echo e($d['nama'] ?? '-'); ?></td>
            <td class="border border-gray-300 px-4 py-2 text-center">
                <?php if($jenis == 'uang'): ?>
                    Rp <?php echo e(number_format($target, 0, ',', '.')); ?>

                <?php else: ?>
                    <?php echo e(number_format($target, 0, ',', '.')); ?>

                <?php endif; ?>
            </td>
            <td class="border border-gray-300 px-4 py-2 text-center"><?php echo e($d['satuan'] ?? ($jenis == 'uang' ? 'Rupiah' : 'unit')); ?></td>
            <td class="border border-gray-300 px-4 py-2 text-center">
                <?php if($prioritas == 'tinggi'): ?>
                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Tinggi</span>
                <?php elseif($prioritas == 'rendah'): ?>
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Rendah</span>
                <?php else: ?>
                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Sedang</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php else: ?>
<div class="bg-gray-50 p-4 text-center rounded-lg">
    <p class="text-gray-500">Belum ada data kebutuhan donasi</p>
</div>
<?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <p class="text-gray-500">Belum ada informasi donasi</p>
                <a href="<?php echo e(route('informasi.create')); ?>" class="text-blue-600 mt-2 inline-block">Tambah sekarang</a>
            </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/informasi/index.blade.php ENDPATH**/ ?>