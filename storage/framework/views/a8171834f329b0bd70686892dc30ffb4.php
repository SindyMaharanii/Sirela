<?php
    $unreadCount = 0;
?>

<aside class="sidebar">
    <!-- Logo Premium dengan Efek Biru -->
    <div class="p-5 border-b border-blue-400/20">
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-11 h-11 bg-white rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-all duration-300">
                <span class="text-blue-600 text-xl font-bold">S</span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">SISOREL</h1>
                <p class="text-[11px] text-blue-200 mt-0.5">Sistem Informasi Sosial</p>
            </div>
        </a>
    </div>

    <?php if(auth()->guard()->check()): ?>
    <!-- User Info Premium -->
    <div class="mx-3 mt-4 p-3 bg-white/10 rounded-xl border border-white/20">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-md">
                <span class="text-blue-600 font-bold text-md"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
            </div>
            <div class="flex-1">
                <p class="font-bold text-white text-sm truncate"><?php echo e(Auth::user()->name); ?></p>
                <p class="text-[11px] text-blue-200 mt-0.5">
                    <?php if(Auth::user()->role == 'admin'): ?>
                        <i class="fas fa-shield-alt mr-1"></i> Administrator
                    <?php else: ?>
                        <i class="fas fa-building mr-1"></i> Lembaga Sosial
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Navigation Menu Premium -->
    <nav class="flex-1 px-2 py-3 space-y-1">
        <!-- ========== MENU NAVIGASI UTAMA ========== -->
        <div class="text-[11px] text-blue-200 font-bold uppercase tracking-wider px-3 py-2 mt-1 flex items-center gap-2">
            <i class="fas fa-th-large text-[11px]"></i>
            <span>Navigasi</span>
        </div>
        
        <!-- Beranda -->
        <a href="/" class="nav-item <?php echo e(request()->is('/') ? 'active' : ''); ?>">
            <div class="nav-icon <?php echo e(request()->is('/') ? 'bg-white/20' : 'bg-blue-500/20'); ?>">
                <i class="fas fa-home text-sm <?php echo e(request()->is('/') ? 'text-white' : 'text-blue-200'); ?>"></i>
            </div>
            <span>Beranda</span>
            <?php if(request()->is('/')): ?>
                <i class="fas fa-circle text-[6px] text-white ml-auto"></i>
            <?php endif; ?>
        </a>
        
        <!-- Tentang -->
        <a href="<?php echo e(route('tentang')); ?>" class="nav-item <?php echo e(request()->routeIs('tentang') ? 'active' : ''); ?>">
            <div class="nav-icon <?php echo e(request()->routeIs('tentang') ? 'bg-white/20' : 'bg-cyan-500/20'); ?>">
                <i class="fas fa-info-circle text-sm <?php echo e(request()->routeIs('tentang') ? 'text-white' : 'text-cyan-200'); ?>"></i>
            </div>
            <span>Tentang</span>
        </a>
        
        <!-- Panduan -->
        <a href="<?php echo e(route('panduan')); ?>" class="nav-item <?php echo e(request()->routeIs('panduan') ? 'active' : ''); ?>">
            <div class="nav-icon <?php echo e(request()->routeIs('panduan') ? 'bg-white/20' : 'bg-indigo-500/20'); ?>">
                <i class="fas fa-book-open text-sm <?php echo e(request()->routeIs('panduan') ? 'text-white' : 'text-indigo-200'); ?>"></i>
            </div>
            <span>Panduan</span>
        </a>

        <?php if(auth()->guard()->check()): ?>
        <!-- ========== MENU DASHBOARD ========== -->
        <div class="h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent my-3"></div>
        
        <div class="text-[11px] text-blue-200 font-bold uppercase tracking-wider px-3 py-2 flex items-center gap-2">
            <i class="fas fa-chart-line text-[11px]"></i>
            <span>Dashboard</span>
        </div>
        
        <a href="<?php echo e(route('dashboard')); ?>" class="nav-item dashboard-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <div class="nav-icon <?php echo e(request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-emerald-500/20'); ?>">
                <i class="fas fa-tachometer-alt text-sm <?php echo e(request()->routeIs('dashboard') ? 'text-white' : 'text-emerald-200'); ?>"></i>
            </div>
            <span>Dashboard</span>
            <?php if(request()->routeIs('dashboard')): ?>
                <i class="fas fa-circle text-[6px] text-white ml-auto"></i>
            <?php endif; ?>
        </a>

        <!-- ========== MENU PENGELOLAAN ========== -->
        <div class="h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent my-3"></div>
        
        <div class="text-[11px] text-blue-200 font-bold uppercase tracking-wider px-3 py-2 flex items-center gap-2">
            <i class="fas fa-cog text-[11px]"></i>
            <span>Pengelolaan</span>
        </div>
        
        <?php if(auth()->user()->role == 'admin'): ?>
            <a href="<?php echo e(route('verifikasi')); ?>" class="nav-item <?php echo e(request()->routeIs('verifikasi') ? 'active' : ''); ?>">
                <div class="nav-icon <?php echo e(request()->routeIs('verifikasi') ? 'bg-white/20' : 'bg-purple-500/20'); ?>">
                    <i class="fas fa-user-check text-sm <?php echo e(request()->routeIs('verifikasi') ? 'text-white' : 'text-purple-200'); ?>"></i>
                </div>
                <span>Verifikasi Akun</span>
                <?php $pendingCount = \App\Models\User::where('role', 'lembaga')->where('status_akun', 'pending')->count(); ?>
                <?php if($pendingCount > 0): ?>
                    <span class="ml-auto bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse"><?php echo e($pendingCount); ?></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo e(route('kategori.index')); ?>" class="nav-item <?php echo e(request()->routeIs('kategori.*') ? 'active' : ''); ?>">
                <div class="nav-icon <?php echo e(request()->routeIs('kategori.*') ? 'bg-white/20' : 'bg-amber-500/20'); ?>">
                    <i class="fas fa-tags text-sm <?php echo e(request()->routeIs('kategori.*') ? 'text-white' : 'text-amber-200'); ?>"></i>
                </div>
                <span>Kelola Kategori</span>
            </a>
            <a href="<?php echo e(route('lembaga.index')); ?>" class="nav-item <?php echo e(request()->routeIs('lembaga.*') ? 'active' : ''); ?>">
                <div class="nav-icon <?php echo e(request()->routeIs('lembaga.*') ? 'bg-white/20' : 'bg-blue-500/20'); ?>">
                    <i class="fas fa-building text-sm <?php echo e(request()->routeIs('lembaga.*') ? 'text-white' : 'text-blue-200'); ?>"></i>
                </div>
                <span>Semua Lembaga</span>
            </a>
            <a href="<?php echo e(route('informasi.index')); ?>" class="nav-item <?php echo e(request()->routeIs('informasi.*') ? 'active' : ''); ?>">
                <div class="nav-icon <?php echo e(request()->routeIs('informasi.*') ? 'bg-white/20' : 'bg-rose-500/20'); ?>">
                    <i class="fas fa-hand-holding-heart text-sm <?php echo e(request()->routeIs('informasi.*') ? 'text-white' : 'text-rose-200'); ?>"></i>
                </div>
                <span>Informasi Donasi</span>
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('lembaga.index')); ?>" class="nav-item <?php echo e(request()->routeIs('lembaga.*') ? 'active' : ''); ?>">
                <div class="nav-icon <?php echo e(request()->routeIs('lembaga.*') ? 'bg-white/20' : 'bg-blue-500/20'); ?>">
                    <i class="fas fa-building text-sm <?php echo e(request()->routeIs('lembaga.*') ? 'text-white' : 'text-blue-200'); ?>"></i>
                </div>
                <span>Profil Lembaga</span>
            </a>
            <a href="<?php echo e(route('informasi.index')); ?>" class="nav-item <?php echo e(request()->routeIs('informasi.*') ? 'active' : ''); ?>">
                <div class="nav-icon <?php echo e(request()->routeIs('informasi.*') ? 'bg-white/20' : 'bg-rose-500/20'); ?>">
                    <i class="fas fa-hand-holding-heart text-sm <?php echo e(request()->routeIs('informasi.*') ? 'text-white' : 'text-rose-200'); ?>"></i>
                </div>
                <span>Informasi Donasi</span>
            </a>
        <?php endif; ?>

        <!-- ========== MENU AKUN ========== -->
        <div class="h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent my-3"></div>
        
        <div class="text-[11px] text-blue-200 font-bold uppercase tracking-wider px-3 py-2 flex items-center gap-2">
            <i class="fas fa-user-circle text-[11px]"></i>
            <span>Akun</span>
        </div>
        
        <a href="<?php echo e(route('profile.edit')); ?>" class="nav-item <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?>">
            <div class="nav-icon <?php echo e(request()->routeIs('profile.*') ? 'bg-white/20' : 'bg-sky-500/20'); ?>">
                <i class="fas fa-user-circle text-sm <?php echo e(request()->routeIs('profile.*') ? 'text-white' : 'text-sky-200'); ?>"></i>
            </div>
            <span>Profile Saya</span>
        </a>
        
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
            <?php echo csrf_field(); ?>
            <button type="submit" class="nav-item w-full text-left hover:bg-red-500/20 group">
                <div class="nav-icon bg-red-500/20">
                    <i class="fas fa-sign-out-alt text-sm text-red-300"></i>
                </div>
                <span class="text-red-300">Logout</span>
            </button>
        </form>
        
        <?php else: ?>
        <!-- ========== MENU UNTUK GUEST (BELUM LOGIN) ========== -->
        <div class="h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent my-3"></div>
        
        <div class="text-[11px] text-blue-200 font-bold uppercase tracking-wider px-3 py-2 flex items-center gap-2">
            <i class="fas fa-key text-[11px]"></i>
            <span>Akses Akun</span>
        </div>
        
        <a href="<?php echo e(route('login')); ?>" class="nav-item">
            <div class="nav-icon bg-blue-500/20">
                <i class="fas fa-sign-in-alt text-sm text-blue-200"></i>
            </div>
            <span>Login</span>
        </a>
        
        <a href="<?php echo e(route('register')); ?>" class="nav-item register-item mt-2">
            <div class="nav-icon bg-white/20">
                <i class="fas fa-user-plus text-sm text-white"></i>
            </div>
            <span class="text-white font-semibold">Daftar Sekarang</span>
            <i class="fas fa-arrow-right text-white text-xs ml-auto"></i>
        </a>
        <?php endif; ?>
    </nav>

    <!-- Footer Sidebar -->
    <div class="p-4 border-t border-blue-400/20 mt-auto">
        <div class="text-center">
            <div class="flex justify-center gap-2 mb-2">
                <div class="w-1.5 h-1.5 bg-blue-300 rounded-full"></div>
                <div class="w-1.5 h-1.5 bg-cyan-300 rounded-full"></div>
                <div class="w-1.5 h-1.5 bg-indigo-300 rounded-full"></div>
            </div>
            <p class="text-[10px] text-blue-200">
                <i class="fas fa-heart text-blue-300 text-[9px]"></i> © 2026 SISOREL
            </p>
            <p class="text-[9px] text-blue-300 mt-0.5">Membangun Kebaikan Bersama</p>
        </div>
    </div>
</aside>

<style>
    /* Sidebar Wrapper - Background Biru Gradasi */
    .sidebar {
        background: linear-gradient(180deg, #0f2b5c 0%, #1e3a8a 50%, #2563eb 100%);
    }
    
    /* Navigation Item Styles */
    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        margin: 2px 0;
        border-radius: 12px;
        color: #bfdbfe;
        font-weight: 500;
        font-size: 13px;
        transition: all 0.25s ease;
        text-decoration: none;
        position: relative;
    }
    
    .nav-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }
    
    .nav-item:hover:not(.register-item) {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(4px);
    }
    
    .nav-item:hover .nav-icon {
        background: rgba(255, 255, 255, 0.3);
    }
    
    .nav-item.active {
        background: white;
        color: #1e3a8a;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .nav-item.active .nav-icon {
        background: rgba(37, 99, 235, 0.1);
    }
    
    .nav-item.active i {
        color: #2563eb;
    }
    
    /* Dashboard Item Khusus */
    .dashboard-item {
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .dashboard-item.active {
        background: linear-gradient(105deg, #10b981, #059669);
        color: white;
        border: none;
    }
    
    .dashboard-item.active .nav-icon {
        background: rgba(255, 255, 255, 0.2);
    }
    
    .dashboard-item.active i {
        color: white;
    }
    
    /* Register Item Khusus */
    .register-item {
        background: linear-gradient(105deg, #f59e0b, #d97706);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }
    
    .register-item .nav-icon {
        background: rgba(255, 255, 255, 0.2);
    }
    
    .register-item i {
        color: white;
    }
    
    .register-item:hover {
        transform: translateX(4px);
        background: linear-gradient(105deg, #fbbf24, #f59e0b);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }
    
    /* Scrollbar sidebar */
    .sidebar::-webkit-scrollbar {
        width: 3px;
    }
    .sidebar::-webkit-scrollbar-track {
        background: #1e40af;
    }
    .sidebar::-webkit-scrollbar-thumb {
        background: #60a5fa;
        border-radius: 10px;
    }
    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #93c5fd;
    }
</style><?php /**PATH C:\xampp\htdocs\Sirela\resources\views\layouts\navigation.blade.php ENDPATH**/ ?>