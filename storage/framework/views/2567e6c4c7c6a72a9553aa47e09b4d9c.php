

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <?php if(Auth::user()->role == 'admin'): ?>
        <!-- ==================== TAMPILAN UNTUK ADMIN ==================== -->
        <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-building text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Semua Lembaga</h2>
                    <p class="text-blue-100 text-sm">Daftar semua lembaga sosial yang terdaftar di sistem</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <?php
                $semuaLembaga = \App\Models\Lembaga::with('user', 'kategori', 'informasi')->get();
            ?>
            
            <!-- Statistik card -->
            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl p-4 m-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Total Lembaga Terdaftar</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($semuaLembaga->count()); ?></p>
                    </div>
                    <i class="fas fa-building text-4xl text-white/30"></i>
                </div>
            </div>
            
            <?php if($semuaLembaga->count() > 0): ?>
            <div class="overflow-x-auto p-4">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] text-white">
                            <th class="border border-gray-300 px-4 py-3 text-left">No</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Nama Lembaga</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Email</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Lokasi</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Kontak</th>
                            <th class="border border-gray-300 px-4 py-3 text-center">Status</th>
                            <th class="border border-gray-300 px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $semuaLembaga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                            <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($loop->iteration); ?></td>
                            <td class="border border-gray-300 px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-building text-blue-500 text-sm"></i>
                                    </div>
                                    <span class="font-semibold text-gray-800"><?php echo e($item->nama_lembaga); ?></span>
                                </div>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($item->user->email ?? '-'); ?></td>
                            <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($item->lokasi ?? $item->alamat ?? '-'); ?></td>
                            <td class="border border-gray-300 px-4 py-3 text-gray-600"><?php echo e($item->kontak ?? '-'); ?></td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                <?php if($item->user && $item->user->status_akun == 'aktif'): ?>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                        <i class="fas fa-circle text-[6px] text-green-500"></i> Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold inline-flex items-center gap-1">
                                        <i class="fas fa-circle text-[6px] text-red-500"></i> Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?php echo e(route('lembaga.show', $item->lembaga_id)); ?>" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition inline-flex items-center" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="<?php echo e(route('lembaga.destroy', $item->lembaga_id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus lembaga <?php echo e($item->nama_lembaga); ?>?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition inline-flex items-center" title="Hapus Lembaga">
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
                    <i class="fas fa-building text-gray-400 text-3xl"></i>
                </div>
                <p class="text-gray-500">Belum ada lembaga yang terdaftar</p>
                <p class="text-sm text-gray-400 mt-1">Silakan daftar sebagai lembaga terlebih dahulu</p>
            </div>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <!-- ==================== TAMPILAN UNTUK LEMBAGA (BIASA) ==================== -->
        <?php
            $lembaga = \App\Models\Lembaga::with('kategori', 'informasi')->where('pengguna_id', Auth::id())->first();
        ?>

        <?php if(!$lembaga): ?>
            <!-- Belum punya profil -->
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-building text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">Profil Lembaga</h1>
                                <p class="text-blue-100 text-sm">Informasi profil lembaga Anda</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 text-center">
                        <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-blue-500 text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Profil Lembaga</h4>
                        <p class="text-gray-500 mb-6">Silakan buat profil lembaga Anda terlebih dahulu.</p>
                        <a href="<?php echo e(route('lembaga.create')); ?>" class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl inline-flex items-center gap-2 transition shadow-md">
                            <i class="fas fa-plus"></i> Buat Profil Lembaga
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- TAMPILAN PROFIL LEMBAGA (Seperti halaman detail masyarakat) + TOMBOL EDIT -->
            <div class="max-w-6xl mx-auto">
                <!-- Tombol Kembali ke Dashboard -->
                <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition group">
                    <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Dashboard
                </a>

                <!-- Header Profil -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden mb-6">
                    <div class="px-6 py-6">
                        <div class="flex flex-wrap justify-between items-start gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <i class="fas fa-building text-white text-3xl"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-white"><?php echo e($lembaga->nama_lembaga); ?></h1>
                                    <div class="flex items-center gap-2 mt-2">
                                        <?php
                                            $statusKolab = '';
                                            if(isset($lembaga->informasi) && isset($lembaga->informasi->status_kolaborasi)) {
                                                $statusKolab = $lembaga->informasi->status_kolaborasi;
                                            }
                                        ?>
                                        <?php if($statusKolab == 'dibuka'): ?>
                                            <div class="bg-green-100 border-l-4 border-green-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
                                                <i class="fas fa-handshake text-green-600 text-sm"></i>
                                                <span class="text-green-700 font-semibold text-sm">Dibuka untuk Kolaborasi</span>
                                            </div>
                                        <?php elseif($statusKolab == 'ditutup'): ?>
                                            <div class="bg-red-100 border-l-4 border-red-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
                                                <i class="fas fa-lock text-red-600 text-sm"></i>
                                                <span class="text-red-700 font-semibold text-sm">Tidak Membuka Kolaborasi</span>
                                            </div>
                                        <?php else: ?>
                                            <div class="bg-gray-100 border-l-4 border-gray-500 px-4 py-2 rounded-r-lg flex items-center gap-2 shadow-sm">
                                                <i class="fas fa-clock text-gray-600 text-sm"></i>
                                                <span class="text-gray-700 font-semibold text-sm">Belum Ada Informasi Kolaborasi</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- TOMBOL EDIT -->
                            <a href="<?php echo e(route('lembaga.edit', $lembaga->lembaga_id)); ?>" 
                               class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-5 py-2 rounded-xl transition-all duration-200 inline-flex items-center gap-2 shadow-md hover:shadow-lg">
                                <i class="fas fa-edit"></i> Edit Profil Lembaga
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Konten Utama 2 Kolom -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Kolom Kiri (Informasi Dasar & Kontak) -->
                    <div class="lg:col-span-1 space-y-5">
                        <!-- Card Informasi Dasar -->
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-info-circle text-blue-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Informasi Dasar</h3>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📍 Lokasi</p>
                                    <p class="text-gray-800 font-medium"><?php echo e($lembaga->lokasi ?? $lembaga->alamat ?? 'Tidak tersedia'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📞 Kontak</p>
                                    <p class="text-gray-800 font-medium"><?php echo e($lembaga->kontak ?? 'Tidak tersedia'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📧 Email Lembaga</p>
                                    <p class="text-gray-800 font-medium"><?php echo e(Auth::user()->email ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">📅 Tanggal Bergabung</p>
                                    <p class="text-gray-800 font-medium"><?php echo e($lembaga->created_at ? $lembaga->created_at->format('d M Y') : '-'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Kategori -->
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-tags text-emerald-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Kategori Lembaga</h3>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <?php $__empty_1 = true; $__currentLoopData = $lembaga->kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium shadow-sm">
                                        <?php echo e($kat->nama_kategori); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <span class="text-gray-500 text-sm">Tidak ada kategori</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Visi, Misi, Deskripsi) -->
                    <div class="lg:col-span-2 space-y-5">
                        <!-- Card Visi -->
                        <?php if($lembaga->visi): ?>
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-indigo-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-eye text-indigo-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Visi</h3>
                            </div>
                            <p class="text-gray-700 leading-relaxed"><?php echo e($lembaga->visi); ?></p>
                        </div>
                        <?php endif; ?>

                        <!-- Card Misi -->
                        <?php if($lembaga->misi): ?>
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-rose-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-bullseye text-rose-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Misi</h3>
                            </div>
                            <div class="space-y-2">
                                <?php
                                    $misiList = explode("\n", $lembaga->misi);
                                ?>
                                <?php $__currentLoopData = $misiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $misi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(trim($misi)): ?>
                                    <div class="flex items-start gap-2">
                                        <div class="w-5 h-5 bg-rose-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <span class="text-rose-500 text-xs font-bold"><?php echo e($index + 1); ?></span>
                                        </div>
                                        <p class="text-gray-700"><?php echo e(trim($misi)); ?></p>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Card Deskripsi -->
                        <?php if($lembaga->deskripsi): ?>
                        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100">
                            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                                <div class="w-8 h-8 bg-cyan-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-align-left text-cyan-500 text-sm"></i>
                                </div>
                                <h3 class="font-bold text-gray-800">Deskripsi</h3>
                            </div>
                            <p class="text-gray-700 leading-relaxed"><?php echo e($lembaga->deskripsi); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/lembaga/index.blade.php ENDPATH**/ ?>