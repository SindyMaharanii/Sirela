

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-hand-holding-heart text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Daftar Donatur</h2>
                <p class="text-blue-100 text-sm">Kelola donatur yang ingin membantu lembaga Anda</p>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto p-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] text-white">
                        <th class="border border-gray-300 px-4 py-3 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-3 text-left">Tanggal & Waktu</th>
                        <th class="border border-gray-300 px-4 py-3 text-left">Donatur</th>
                        <th class="border border-gray-300 px-4 py-3 text-left">Kebutuhan</th>
                        <th class="border border-gray-300 px-4 py-3 text-center">Jumlah/Nominal</th>
                        <th class="border border-gray-300 px-4 py-3 text-center">Status</th>
                        <th class="border border-gray-300 px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // GABUNGKAN SEMUA DONASI (BARANG + UANG)
                        $semuaDonasi = collect();
                        
                        foreach ($donasiBarang as $item) {
                            $semuaDonasi->push((object)[
                                'created_at' => $item->created_at,
                                'donasi_id' => $item->donasi_id,
                                'nama_donatur' => $item->nama_donatur,
                                'no_hp' => $item->no_hp,
                                'kebutuhan_nama' => $item->kebutuhan_nama,
                                'jumlah' => $item->jumlah_barang,
                                'satuan' => $item->satuan_barang,
                                'status' => $item->status,
                                'jenis' => 'barang',
                                'nama_rekening' => null,
                                'nama_bank' => null,
                                'bukti_transfer' => null,
                            ]);
                        }
                        
                        foreach ($donasiUang as $item) {
                            $semuaDonasi->push((object)[
                                'created_at' => $item->created_at,
                                'donasi_id' => $item->donasi_id,
                                'nama_donatur' => $item->nama_donatur,
                                'no_hp' => $item->no_hp,
                                'kebutuhan_nama' => $item->kebutuhan_nama,
                                'jumlah' => $item->nominal_uang,
                                'satuan' => 'Rp',
                                'status' => $item->status,
                                'jenis' => 'uang',
                                'nama_rekening' => $item->nama_rekening,
                                'nama_bank' => $item->nama_bank,
                                'bukti_transfer' => $item->bukti_transfer,
                            ]);
                        }
                        
                        // URUTKAN DARI YANG TERBARU KE TERLAMA
                        $semuaDonasi = $semuaDonasi->sortByDesc('created_at');
                        $no = 1;
                    ?>
                    
                    <?php $__currentLoopData = $semuaDonasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                        <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($no++); ?></td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-600">
                            <?php echo e(\Carbon\Carbon::parse($d->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s')); ?>

                            <span class="text-xs text-gray-400">WIB</span>
                        </td>
                        <td class="border border-gray-300 px-4 py-3">
                            <div>
                                <p class="font-semibold text-gray-800"><?php echo e($d->nama_donatur); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($d->no_hp); ?></p>
                                <?php if($d->jenis == 'uang' && $d->nama_rekening): ?>
                                    <p class="text-xs text-gray-400">Rek: <?php echo e($d->nama_rekening); ?> (<?php echo e($d->nama_bank); ?>)</p>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($d->kebutuhan_nama); ?></td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <?php if($d->jenis == 'barang'): ?>
                                <span class="font-semibold text-blue-600"><?php echo e(number_format((float)$d->jumlah, 0, ',', '.')); ?> <?php echo e($d->satuan); ?></span>
                            <?php else: ?>
                                <span class="font-semibold text-green-600">Rp <?php echo e(number_format((float)$d->jumlah, 0, ',', '.')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <?php if($d->status == 'pending'): ?>
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                            <?php elseif($d->status == 'dikonfirmasi'): ?>
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">Dikonfirmasi</span>
                            <?php else: ?>
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2 flex-wrap">
                                <?php if($d->status == 'pending'): ?>
                                    <?php if($d->jenis == 'barang'): ?>
                                    <form action="<?php echo e(route('donasi.konfirmasi.barang', $d->donasi_id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                            Konfirmasi
                                        </button>
                                    </form>
                                    <?php else: ?>
                                    <form action="<?php echo e(route('donasi.konfirmasi.uang', $d->donasi_id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                            Konfirmasi
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if($d->jenis == 'uang' && $d->bukti_transfer): ?>
                                    <a href="<?php echo e(Storage::url($d->bukti_transfer)); ?>" target="_blank" 
                                       class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded-lg text-sm inline-flex items-center gap-1 transition">
                                        <i class="fas fa-image"></i> Bukti
                                    </a>
                                <?php endif; ?>
                                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $d->no_hp)); ?>" target="_blank"
                                   class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm inline-flex items-center gap-1 transition">
                                    <i class="fab fa-whatsapp"></i> WA
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($semuaDonasi->count() == 0): ?>
                    <tr>
                        <td colspan="7" class="border border-gray-300 p-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2"></i>
                            <p>Belum ada donatur yang mendaftar</p>
                            <p class="text-xs text-gray-400 mt-1">Donatur akan muncul setelah ada yang mengisi form donasi</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/donasi/index.blade.php ENDPATH**/ ?>