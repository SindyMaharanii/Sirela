

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Tombol Kembali -->
        <a href="<?php echo e(route('verifikasi')); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-4 transition group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Verifikasi Akun
        </a>

        <!-- Header Profil -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-building text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white"><?php echo e($user->nama_lembaga ?? $user->name); ?></h1>
                        <p class="text-purple-200 mt-1">Data Lengkap Registrasi Lembaga</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== DATA REGISTRASI LENGKAP ==================== -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fas fa-file-alt"></i> Data Registrasi Lengkap Lembaga
                </h2>
            </div>
            <div class="p-6">
                
                <!-- ========== DATA AKUN LOGIN ========== -->
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-user-circle text-blue-500"></i> Akun Login
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Nama Pengguna</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->name); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Email Login</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->email); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Role</p>
                            <p class="text-gray-800 font-medium"><?php echo e(ucfirst($user->role)); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Status Akun</p>
                            <?php if($user->status_akun == 'aktif'): ?>
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-semibold">✓ Aktif</span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold">✗ Nonaktif</span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Tanggal Bergabung</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->created_at->format('d M Y H:i')); ?></p>
                        </div>
                    </div>
                </div>

                <!-- ========== DATA LEMBAGA (DARI REGISTRASI) ========== -->
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-building text-emerald-500"></i> Data Lembaga (Registrasi)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Nama Lembaga</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->nama_lembaga ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Jenis Lembaga</p>
                            <p class="text-gray-800 font-medium"><?php echo e(ucfirst($user->jenis_lembaga ?? '-')); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Tahun Berdiri</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->tahun_berdiri ?? '-'); ?></p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Alamat Lengkap</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->alamat ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Provinsi</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->provinsi ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Kota/Kabupaten</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->kota ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Kode Pos</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->kode_pos ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Telepon Lembaga</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->telepon_lembaga ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Email Lembaga</p>
                            <p class="text-gray-800 font-medium"><?php echo e($user->email_lembaga ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Website</p>
                            <p class="text-gray-800 font-medium">
                                <?php if($user->website): ?>
                                    <a href="<?php echo e($user->website); ?>" target="_blank" class="text-blue-500 hover:underline"><?php echo e($user->website); ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ========== DATA LEGALITAS & PENGURUS ========== -->
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-gavel text-purple-500"></i> Data Legalitas & Pengurus
                    </h3>

                    <?php if($user->jenis_lembaga == 'pemerintah'): ?>
                        <!-- DATA PEMERINTAH -->
                        <div class="bg-blue-50 rounded-xl p-4">
                            <p class="font-semibold text-blue-800 mb-3">📋 Data Lembaga Pemerintah</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">Kementerian/Instansi Induk</p>
                                    <p class="text-gray-800"><?php echo e($user->kementerian ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Eselon</p>
                                    <p class="text-gray-800"><?php echo e($user->eselon ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nomor SOTK</p>
                                    <p class="text-gray-800"><?php echo e($user->nomor_sotk ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NIP Pimpinan</p>
                                    <p class="text-gray-800"><?php echo e($user->nip_pimpinan ?? '-'); ?></p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500">File SOTK</p>
                                    <?php if($user->file_sotk): ?>
                                        <a href="<?php echo e(Storage::url($user->file_sotk)); ?>" target="_blank" class="text-blue-500 hover:underline inline-flex items-center gap-1">
                                            <i class="fas fa-file-pdf text-red-500"></i> Lihat / Unduh File SOTK
                                        </a>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php elseif($user->jenis_lembaga == 'swasta'): ?>
                        <!-- DATA SWASTA -->
                        <div class="bg-green-50 rounded-xl p-4">
                            <p class="font-semibold text-green-800 mb-3">📋 Data Lembaga Swasta</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">Tipe Lembaga</p>
                                    <p class="text-gray-800"><?php echo e($user->tipe_swasta ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nomor Akta Pendirian</p>
                                    <p class="text-gray-800"><?php echo e($user->nomor_akta ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NPWP Lembaga</p>
                                    <p class="text-gray-800"><?php echo e($user->npwp_lembaga ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nama Pimpinan</p>
                                    <p class="text-gray-800"><?php echo e($user->nama_pimpinan ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NIK Pimpinan</p>
                                    <p class="text-gray-800"><?php echo e($user->nik_pimpinan ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Rekening Lembaga</p>
                                    <p class="text-gray-800"><?php echo e($user->rekening_lembaga ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">File Akta</p>
                                    <?php if($user->file_akta): ?>
                                        <a href="<?php echo e(Storage::url($user->file_akta)); ?>" target="_blank" class="text-blue-500 hover:underline">📄 Lihat File</a>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">File NPWP</p>
                                    <?php if($user->file_npwp): ?>
                                        <a href="<?php echo e(Storage::url($user->file_npwp)); ?>" target="_blank" class="text-blue-500 hover:underline">📄 Lihat File</a>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500">File KTP Pimpinan</p>
                                    <?php if($user->file_ktp_pimpinan): ?>
                                        <a href="<?php echo e(Storage::url($user->file_ktp_pimpinan)); ?>" target="_blank" class="text-blue-500 hover:underline">🪪 Lihat KTP</a>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php elseif($user->jenis_lembaga == 'komunitas'): ?>
                        <!-- DATA KOMUNITAS -->
                        <div class="bg-purple-50 rounded-xl p-4">
                            <p class="font-semibold text-purple-800 mb-3">📋 Data Komunitas Sosial</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">Nomor SK KEMENSOS</p>
                                    <p class="text-gray-800"><?php echo e($user->nomor_sk ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Tanggal SK</p>
                                    <p class="text-gray-800"><?php echo e($user->tanggal_sk ? \Carbon\Carbon::parse($user->tanggal_sk)->format('d M Y') : '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nama Koordinator</p>
                                    <p class="text-gray-800"><?php echo e($user->nama_koordinator ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">NIK Koordinator</p>
                                    <p class="text-gray-800"><?php echo e($user->nik_koordinator ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Rekening Komunitas</p>
                                    <p class="text-gray-800"><?php echo e($user->rekening_komunitas ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">File SK</p>
                                    <?php if($user->file_sk): ?>
                                        <a href="<?php echo e(Storage::url($user->file_sk)); ?>" target="_blank" class="text-blue-500 hover:underline">📄 Lihat File</a>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs text-gray-500">File KTP Koordinator</p>
                                    <?php if($user->file_ktp_koordinator): ?>
                                        <a href="<?php echo e(Storage::url($user->file_ktp_koordinator)); ?>" target="_blank" class="text-blue-500 hover:underline">🪪 Lihat KTP</a>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500">Belum ada data legalitas</p>
                    <?php endif; ?>
                </div>

                <!-- ========== DATA DARI TABEL LEMBAGA (Visi, Misi, dll) ========== -->
                <?php if($lembaga): ?>
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h3 class="text-md font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-flag-checkered text-orange-500"></i> Visi, Misi & Deskripsi (Profil)
                    </h3>
                    <div class="space-y-4">
                        <?php if($lembaga->visi): ?>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Visi</p>
                            <p class="text-gray-600"><?php echo e($lembaga->visi); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if($lembaga->misi): ?>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Misi</p>
                            <p class="text-gray-600"><?php echo e($lembaga->misi); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if($lembaga->deskripsi): ?>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Deskripsi</p>
                            <p class="text-gray-600"><?php echo e($lembaga->deskripsi); ?></p>
                        </div>
                        <?php endif; ?>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="font-semibold text-gray-700">Kategori</p>
                            <div class="flex flex-wrap gap-1 mt-1">
                                <?php $__empty_1 = true; $__currentLoopData = $lembaga->kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full"><?php echo e($kat->nama_kategori); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <span class="text-gray-500">-</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/admin/detail-lembaga.blade.php ENDPATH**/ ?>