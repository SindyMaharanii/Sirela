

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <?php if(Auth::user()->role == 'admin'): ?>
        <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-t-xl px-6 py-4 mb-6 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-building text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Manajemen Lembaga</h2>
                    <p class="text-blue-100 text-sm">Daftar semua lembaga dan verifikasi akun</p>
                </div>
            </div>
        </div>

        <?php
    $semuaLembaga = $lembaga ?? collect(); 
    $totalLembaga = $semuaLembaga->count();
    $lembagaAktif = $semuaLembaga->filter(function($item) {
        return $item->user && $item->user->status_akun == 'aktif';
    })->count();
    $lembagaNonaktif = $semuaLembaga->filter(function($item) {
        return $item->user && $item->user->status_akun == 'nonaktif';
    })->count();
?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 text-white shadow">
                <p class="text-sm">Total Lembaga</p>
                <p class="text-2xl font-bold"><?php echo e($totalLembaga); ?></p>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 text-white shadow">
                <p class="text-sm">Lembaga Aktif</p>
                <p class="text-2xl font-bold"><?php echo e($lembagaAktif); ?></p>
            </div>
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-4 text-white shadow">
                <p class="text-sm">Menunggu Verifikasi</p>
                <p class="text-2xl font-bold"><?php echo e($lembagaNonaktif); ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
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
                            <th class="border border-gray-300 px-4 py-3 text-center">Detail</th>
                            <th class="border border-gray-300 px-4 py-3 text-center">Verifikasi</th>
                            <th class="border border-gray-300 px-4 py-3 text-center">Hapus</th>
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
                                <button onclick="showDetail(<?php echo e($item->user->id); ?>)" 
                                        class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded-lg text-sm transition inline-flex items-center gap-1">
                                    <i class="fas fa-file-alt text-xs"></i> Detail
                                </button>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                <?php if($item->user && $item->user->status_akun == 'nonaktif'): ?>
                                <form action="<?php echo e(route('verifikasi.toggle', $item->user->id)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm transition inline-flex items-center gap-1">
                                        <i class="fas fa-check-circle text-xs"></i> Aktifkan
                                    </button>
                                </form>
                                <?php elseif($item->user && $item->user->status_akun == 'aktif'): ?>
                                <form action="<?php echo e(route('verifikasi.toggle', $item->user->id)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition inline-flex items-center gap-1">
                                        <i class="fas fa-ban text-xs"></i> Nonaktifkan
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-center">
                                <form action="<?php echo e(route('lembaga.destroy', $item->lembaga_id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus lembaga <?php echo e($item->nama_lembaga); ?>?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm transition inline-flex items-center gap-1">
                                        <i class="fas fa-trash text-xs"></i> Hapus
                                    </button>
                                </form>
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
        <?php
            $lembaga = \App\Models\Lembaga::where('pengguna_id', Auth::id())->first();
        ?>

        <?php if(!$lembaga): ?>
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
        <?php else: ?>
            <div class="max-w-6xl mx-auto">
                <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition group">
                    <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Dashboard
                </a>

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
                            <a href="<?php echo e(route('lembaga.edit', $lembaga->lembaga_id)); ?>" 
                               class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-5 py-2 rounded-xl transition-all duration-200 inline-flex items-center gap-2 shadow-md hover:shadow-lg">
                                <i class="fas fa-edit"></i> Edit Profil Lembaga
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-1 space-y-5">
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

                    <div class="lg:col-span-2 space-y-5">
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

<div id="modalDetail" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="sticky top-0 bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] px-6 py-4 rounded-t-2xl flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Detail Registrasi Lembaga</h3>
                    <p class="text-blue-100 text-sm">Informasi lengkap data pendaftaran lembaga</p>
                </div>
            </div>
            <button onclick="tutupModal()" class="text-white/80 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6" id="modalContent">
            <div class="text-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto"></div>
                <p class="mt-2 text-gray-500">Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(userId) {
        document.getElementById('modalDetail').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        fetch('/admin/detail-lembaga/' + userId)
            .then(response => response.json())
            .then(data => {
                let html = `
                    <div class="space-y-5">
                        <!-- DATA AKUN LOGIN -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-5 border border-blue-200">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-user-circle text-blue-600 text-xl"></i>
                                <h4 class="font-bold text-blue-800 text-lg">Data Akun Login</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-user text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nama Pengguna:</strong> ${data.name || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-envelope text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Email Login:</strong> ${data.email || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-tag text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Role:</strong> ${data.role || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-circle text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Status Akun:</strong> ${data.status_akun == 'aktif' ? '✅ Aktif' : '⏳ Menunggu Verifikasi'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-calendar text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Tanggal Bergabung:</strong> ${data.created_at ? new Date(data.created_at).toLocaleDateString('id-ID') : '-'}</span>
                                </div>
                            </div>
                        </div>

                        <!-- DATA LEMBAGA UMUM -->
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl p-5 border border-emerald-200">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-building text-emerald-600 text-xl"></i>
                                <h4 class="font-bold text-emerald-800 text-lg">Data Lembaga</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-tag text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Jenis Lembaga:</strong> ${data.jenis_lembaga || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-building text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nama Lembaga:</strong> ${data.nama_lembaga || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-calendar text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Tahun Berdiri:</strong> ${data.tahun_berdiri || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-map-marker-alt text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Alamat:</strong> ${data.alamat || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-city text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Provinsi:</strong> ${data.provinsi || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-city text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Kota/Kabupaten:</strong> ${data.kota || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-mail-bulk text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Kode Pos:</strong> ${data.kode_pos || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-phone text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Telepon Lembaga:</strong> ${data.telepon_lembaga || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-envelope text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Email Lembaga:</strong> ${data.email_lembaga || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-globe text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Website:</strong> ${data.website || '-'}</span>
                                </div>
                            </div>
                        </div>

                        <!-- DATA REKENING BANK -->
                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl p-5 border border-yellow-200">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-university text-yellow-600 text-xl"></i>
                                <h4 class="font-bold text-yellow-800 text-lg">Data Rekening Bank</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-credit-card text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nomor Rekening:</strong> ${data.rekening_lembaga || data.rekening_komunitas || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-building-columns text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nama Bank:</strong> ${data.bank_name || data.bank_name_komunitas || '-'}</span>
                                </div>
                            </div>
                        </div>
                `;
                
                // DATA KHUSUS PEMERINTAH
                if (data.jenis_lembaga == 'pemerintah') {
                    html += `
                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-5 border border-blue-200">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-landmark text-blue-600 text-xl"></i>
                                <h4 class="font-bold text-blue-800 text-lg">Data Khusus Pemerintah</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-building text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Kementerian:</strong> ${data.kementerian || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-chart-line text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Eselon:</strong> ${data.eselon || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-hashtag text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nomor SOTK:</strong> ${data.nomor_sotk || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-id-card text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>NIP Pimpinan:</strong> ${data.nip_pimpinan || '-'}</span>
                                </div>
                                ${data.file_sotk ? `<div class="flex items-center gap-2 p-2 bg-white rounded-lg col-span-2">
                                    <i class="fas fa-file-pdf text-red-500 w-5"></i>
                                    <a href="/storage/${data.file_sotk}" target="_blank" class="text-blue-600 hover:underline text-sm">📄 Lihat File SOTK</a>
                                </div>` : ''}
                            </div>
                        </div>
                    `;
                }
                
                // DATA KHUSUS SWASTA
                if (data.jenis_lembaga == 'swasta') {
                    html += `
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-5 border border-green-200">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-handshake text-green-600 text-xl"></i>
                                <h4 class="font-bold text-green-800 text-lg">Data Khusus Swasta</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-tag text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Tipe Lembaga:</strong> ${data.tipe_swasta || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-file-alt text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nomor Akta:</strong> ${data.nomor_akta || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-receipt text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>NPWP Lembaga:</strong> ${data.npwp_lembaga || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-user-tie text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nama Pimpinan:</strong> ${data.nama_pimpinan || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-id-card text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>NIK Pimpinan:</strong> ${data.nik_pimpinan || '-'}</span>
                                </div>
                                ${data.file_akta ? `<div class="flex items-center gap-2 p-2 bg-white rounded-lg col-span-2">
                                    <i class="fas fa-file-pdf text-red-500 w-5"></i>
                                    <a href="/storage/${data.file_akta}" target="_blank" class="text-blue-600 hover:underline text-sm">📄 Lihat File Akta</a>
                                </div>` : ''}
                                ${data.file_npwp ? `<div class="flex items-center gap-2 p-2 bg-white rounded-lg col-span-2">
                                    <i class="fas fa-file-pdf text-red-500 w-5"></i>
                                    <a href="/storage/${data.file_npwp}" target="_blank" class="text-blue-600 hover:underline text-sm">📄 Lihat File NPWP</a>
                                </div>` : ''}
                                ${data.file_ktp_pimpinan ? `<div class="flex items-center gap-2 p-2 bg-white rounded-lg col-span-2">
                                    <i class="fas fa-id-card text-blue-500 w-5"></i>
                                    <a href="/storage/${data.file_ktp_pimpinan}" target="_blank" class="text-blue-600 hover:underline text-sm">🪪 Lihat KTP Pimpinan</a>
                                </div>` : ''}
                            </div>
                        </div>
                    `;
                }
                
                // DATA KHUSUS KOMUNITAS
                if (data.jenis_lembaga == 'komunitas') {
                    html += `
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-5 border border-purple-200">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-users text-purple-600 text-xl"></i>
                                <h4 class="font-bold text-purple-800 text-lg">Data Khusus Komunitas</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-file-alt text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nomor SK KEMENSOS:</strong> ${data.nomor_sk || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-calendar text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Tanggal SK:</strong> ${data.tanggal_sk || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-user text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>Nama Koordinator:</strong> ${data.nama_koordinator || '-'}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-white rounded-lg">
                                    <i class="fas fa-id-card text-gray-400 w-5"></i>
                                    <span class="text-gray-600 text-sm"><strong>NIK Koordinator:</strong> ${data.nik_koordinator || '-'}</span>
                                </div>
                                ${data.file_sk ? `<div class="flex items-center gap-2 p-2 bg-white rounded-lg col-span-2">
                                    <i class="fas fa-file-pdf text-red-500 w-5"></i>
                                    <a href="/storage/${data.file_sk}" target="_blank" class="text-blue-600 hover:underline text-sm">📄 Lihat File SK</a>
                                </div>` : ''}
                                ${data.file_ktp_koordinator ? `<div class="flex items-center gap-2 p-2 bg-white rounded-lg col-span-2">
                                    <i class="fas fa-id-card text-blue-500 w-5"></i>
                                    <a href="/storage/${data.file_ktp_koordinator}" target="_blank" class="text-blue-600 hover:underline text-sm">🪪 Lihat KTP Koordinator</a>
                                </div>` : ''}
                            </div>
                        </div>
                    `;
                }
                
                html += `</div>`;
                document.getElementById('modalContent').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('modalContent').innerHTML = '<div class="text-center py-8 text-red-500">Gagal memuat data</div>';
            });
    }
    
    function tutupModal() {
        document.getElementById('modalDetail').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('modalContent').innerHTML = '<div class="text-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto"></div><p class="mt-2 text-gray-500">Memuat数据...</p></div>';
    }
    
    document.getElementById('modalDetail').addEventListener('click', function(e) {
        if (e.target === this) tutupModal();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/lembaga/index.blade.php ENDPATH**/ ?>