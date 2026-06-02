<?php $__env->startSection('content'); ?>
<div class="p-6 max-w-5xl mx-auto">
    <div class="relative mb-8">
        <div class="relative bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-2xl px-6 py-5 shadow-lg">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-user-circle text-white text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">Profil Saya</h1>
                    <p class="text-blue-100 text-sm mt-0.5">Kelola informasi akun Anda dengan aman</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="border-b border-gray-100 px-4">
            <div class="flex gap-1">
                <button id="tab-profile" class="tab-btn active px-5 py-3 text-sm font-medium transition-all duration-200 rounded-t-lg">
                    <i class="fas fa-user mr-2 text-blue-500"></i> Profil
                </button>
                <button id="tab-password" class="tab-btn px-5 py-3 text-sm font-medium transition-all duration-200 rounded-t-lg text-gray-500">
                    <i class="fas fa-lock mr-2 text-gray-400"></i> Keamanan
                </button>
            </div>
        </div>

        <div class="p-6 md:p-8">
            <!-- TAB PROFIL -->
            <div id="form-profile" class="tab-content">
                <div id="profile-view">
<div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-xl p-4 mb-6 text-white shadow-md">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
            <i class="fas fa-id-card text-white text-lg"></i>
        </div>
        <div>
            <p class="text-xs text-blue-200 uppercase tracking-wide">Informasi Akun</p>
            <p class="text-sm text-blue-200">Data diri Anda yang terdaftar di sistem</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="group">
        <label class="block text-xs text-gray-400 uppercase tracking-wide mb-1">
            <i class="fas fa-user mr-1 text-blue-400"></i> Nama Lengkap
        </label>
        <div class="bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl px-4 py-3 shadow-sm border border-blue-200 group-hover:shadow-md transition">
            <p class="text-gray-800 font-medium"><?php echo e($user->name); ?></p>
        </div>
    </div>

    <div class="group">
        <label class="block text-xs text-gray-400 uppercase tracking-wide mb-1">
            <i class="fas fa-envelope mr-1 text-blue-400"></i> Email
        </label>
        <div class="bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl px-4 py-3 shadow-sm border border-blue-200 group-hover:shadow-md transition">
            <p class="text-gray-800 font-medium"><?php echo e($user->email); ?></p>
        </div>
    </div>

    <div class="group">
        <label class="block text-xs text-gray-400 uppercase tracking-wide mb-1">
            <i class="fas fa-user-tag mr-1 text-blue-400"></i> Role
        </label>
        <div class="bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl px-4 py-3 shadow-sm border border-blue-200 group-hover:shadow-md transition">
            <?php if($user->role == 'admin'): ?>
                <p class="text-blue-600 font-medium"><i class="fas fa-shield-alt mr-1"></i> Administrator</p>
            <?php else: ?>
                <p class="text-emerald-600 font-medium"><i class="fas fa-building mr-1"></i> Lembaga Sosial</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="group">
        <label class="block text-xs text-gray-400 uppercase tracking-wide mb-1">
            <i class="fas fa-circle mr-1 text-blue-400"></i> Status Akun
        </label>
        <div class="bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl px-4 py-3 shadow-sm border border-blue-200 group-hover:shadow-md transition">
            <?php if($user->status_akun == 'aktif'): ?>
                <p class="text-emerald-600 font-medium"><i class="fas fa-check-circle mr-1"></i> Aktif</p>
            <?php else: ?>
                <p class="text-amber-600 font-medium"><i class="fas fa-hourglass-half mr-1"></i> Nonaktif</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="md:col-span-2 group">
        <label class="block text-xs text-gray-400 uppercase tracking-wide mb-1">
            <i class="fas fa-calendar-alt mr-1 text-blue-400"></i> Bergabung Sejak
        </label>
        <div class="bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl px-4 py-3 shadow-sm border border-blue-200 group-hover:shadow-md transition">
            <p class="text-gray-800 font-medium"><?php echo e($user->created_at->format('d F Y')); ?></p>
        </div>
    </div>
</div>

                    <div class="mt-8 flex justify-end border-t border-gray-100 pt-6">
    <button id="btn-edit-profile" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-edit text-sm"></i>
        <span>Edit Profil</span>
    </button>
</div>
                </div>

                <div id="profile-edit" class="hidden">
                    <div class="bg-amber-50 rounded-xl p-4 mb-6 border border-amber-100">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-info-circle text-amber-500 text-lg"></i>
                            <p class="text-sm text-amber-700">Mode edit aktif. Silakan ubah data yang diperlukan.</p>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('patch'); ?>

                        <div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" 
           class="w-full bg-gradient-to-br from-blue-100 via-blue-50 to-white border border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" 
           class="w-full bg-gradient-to-br from-blue-100 via-blue-50 to-white border border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="flex justify-end gap-3 pt-4">
    <button type="button" id="btn-cancel-edit" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">
        <i class="fas fa-times mr-2"></i> Batal
    </button>
    
    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-save text-sm"></i>
        <span>Simpan Perubahan</span>
    </button>
</div>
                    </form>
                </div>
            </div>

            <div id="form-password" class="tab-content hidden">
                <div id="password-view">
                    <div class="bg-gradient-to-r from-[#0f2b5c] via-[#1e3a8a] to-[#2563eb] rounded-xl p-5 mb-6 text-white shadow-md">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">Keamanan Akun</p>
                                <p class="text-sm text-blue-200 mt-0.5">Password Anda disimpan dengan aman menggunakan enkripsi.</p>
                                <div class="mt-3 flex items-center gap-2">
                                    <i class="fas fa-check-circle text-blue-200 text-sm"></i>
                                    <span class="text-xs text-blue-200">Terakhir diubah: <?php echo e($user->updated_at ? $user->updated_at->format('d M Y') : 'Belum pernah'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button id="btn-edit-password" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl transition-all duration-200 shadow-md">
                            <i class="fas fa-key text-sm"></i>
                            <span>Ubah Password</span>
                        </button>
                    </div>
                </div>

                <div id="password-edit" class="hidden">
                    <div class="bg-amber-50 rounded-xl p-4 mb-6 border border-amber-100">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-shield-alt text-amber-500 text-lg"></i>
                            <p class="text-sm text-amber-700">Isi form di bawah untuk mengubah password Anda.</p>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('password.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>

                        <div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
    <div class="relative">
        <input type="password" name="current_password" id="current_password" 
               class="w-full bg-gradient-to-br from-blue-100 via-blue-50 to-white border border-blue-200 rounded-xl px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm"
               placeholder="Masukkan password saat ini" required>
        <button type="button" onclick="togglePassword('current_password')" 
                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-blue-500 transition">
            <i class="fas fa-eye-slash"></i>
        </button>
    </div>
    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
    <div class="relative">
        <input type="password" name="password" id="password" 
               class="w-full bg-gradient-to-br from-blue-100 via-blue-50 to-white border border-blue-200 rounded-xl px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm"
               placeholder="Minimal 8 karakter" required>
        <button type="button" onclick="togglePassword('password')" 
                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-blue-500 transition">
            <i class="fas fa-eye-slash"></i>
        </button>
    </div>
    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
    <div class="relative">
        <input type="password" name="password_confirmation" id="password_confirmation" 
               class="w-full bg-gradient-to-br from-blue-100 via-blue-50 to-white border border-blue-200 rounded-xl px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm"
               placeholder="Ulangi password baru" required>
        <button type="button" onclick="togglePassword('password_confirmation')" 
                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-blue-500 transition">
            <i class="fas fa-eye-slash"></i>
        </button>
    </div>
</div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" id="btn-cancel-password" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">
                                <i class="fas fa-times mr-2"></i> Batal
                            </button>
                            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl transition-all duration-200 shadow-md">
                                <i class="fas fa-save mr-2"></i> Simpan Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tab-btn.active {
        background: white;
        color: #2563eb;
        border-bottom: 2px solid #2563eb;
        box-shadow: 0 -2px 6px rgba(37, 99, 235, 0.05);
    }
    .tab-btn:hover:not(.active) {
        background: #f8fafc;
        color: #2563eb;
    }
    .tab-content {
        animation: fadeIn 0.25s ease-out;
    }
    .hidden {
        display: none;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    document.getElementById('tab-profile').addEventListener('click', function() {
        this.classList.add('active');
        this.classList.remove('text-gray-500');
        document.getElementById('tab-password').classList.remove('active');
        document.getElementById('tab-password').classList.add('text-gray-500');
        document.getElementById('form-profile').classList.remove('hidden');
        document.getElementById('form-password').classList.add('hidden');
    });

    document.getElementById('tab-password').addEventListener('click', function() {
        this.classList.add('active');
        this.classList.remove('text-gray-500');
        document.getElementById('tab-profile').classList.remove('active');
        document.getElementById('tab-profile').classList.add('text-gray-500');
        document.getElementById('form-password').classList.remove('hidden');
        document.getElementById('form-profile').classList.add('hidden');
    });

    document.getElementById('btn-edit-profile').onclick = () => {
        document.getElementById('profile-view').classList.add('hidden');
        document.getElementById('profile-edit').classList.remove('hidden');
    };
    document.getElementById('btn-cancel-edit').onclick = () => {
        document.getElementById('profile-view').classList.remove('hidden');
        document.getElementById('profile-edit').classList.add('hidden');
    };

    document.getElementById('btn-edit-password').onclick = () => {
        document.getElementById('password-view').classList.add('hidden');
        document.getElementById('password-edit').classList.remove('hidden');
    };
    document.getElementById('btn-cancel-password').onclick = () => {
        document.getElementById('password-view').classList.remove('hidden');
        document.getElementById('password-edit').classList.add('hidden');
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/profile/edit.blade.php ENDPATH**/ ?>