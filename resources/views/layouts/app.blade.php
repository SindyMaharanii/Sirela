<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SISOREL') }} - Platform Informasi Sosial</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);
            min-height: 100vh;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #0f2b5c 0%, #1e3a8a 60%, #2563eb 100%);
            overflow-y: auto;
            z-index: 50;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
        }
        
        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-track { background: #1e40af; }
        .sidebar::-webkit-scrollbar-thumb { background: #60a5fa; border-radius: 10px; }
        
        .main-content {
            margin-left: 280px;
            padding: 24px 32px;
            min-height: 100vh;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin: 4px 12px;
            border-radius: 12px;
            color: #bfdbfe;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.25s ease;
            text-decoration: none;
        }
        
        .nav-item i {
            width: 20px;
            font-size: 16px;
            color: #93c5fd;
        }
        
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(6px);
        }
        
        .nav-item:hover i {
            color: white;
        }
        
        .nav-item.active {
            background: white;
            color: #1e3a8a;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .nav-item.active i {
            color: #2563eb;
        }
        
        .menu-header {
            font-size: 11px;
            color: #93c5fd;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 16px 6px 16px;
            margin-top: 8px;
        }
        
        .menu-header i {
            margin-right: 6px;
            font-size: 11px;
        }
        
        .menu-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #3b82f6, #60a5fa, #3b82f6, transparent);
            margin: 12px 16px;
        }
        
        .btn-register {
            background: linear-gradient(105deg, #f59e0b, #d97706);
            color: white;
            margin-top: 8px;
        }
        
        .btn-register i {
            color: white;
        }
        
        .btn-register:hover {
            background: linear-gradient(105deg, #fbbf24, #f59e0b);
        }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 20px 16px; }
            .menu-toggle { display: block; position: fixed; top: 16px; left: 16px; z-index: 60; background: #2563eb; border-radius: 12px; padding: 10px 14px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); cursor: pointer; border: none; }
            .menu-toggle i { color: white; }
        }
        @media (min-width: 769px) { .menu-toggle { display: none; } }
    </style>
</head>
<body>

<button class="menu-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
    <i class="fas fa-bars text-white text-lg"></i>
</button>

<aside class="sidebar" id="sidebar">
    <div class="p-6 border-b border-blue-400/30">
        <a href="/" class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                <span class="text-blue-600 text-2xl font-bold">S</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-white">SISOREL</h1>
                <p class="text-xs text-blue-200 mt-0.5">Sistem Informasi Sosial</p>
            </div>
        </a>
    </div>

    @auth
    <div class="mx-4 mt-5 p-3 bg-white/10 rounded-xl border border-white/20">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                <span class="text-blue-600 font-bold text-md">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1">
                <p class="font-bold text-white text-sm truncate">{{ Auth::user()->name }}</p>
                <p class="text-[11px] text-blue-200">
                    @if(Auth::user()->role == 'admin')
                        <i class="fas fa-shield-alt mr-1"></i> Administrator
                    @else
                        <i class="fas fa-building mr-1"></i> Lembaga Sosial
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endauth

    <nav class="py-4">
        <div class="menu-header">
            <i class="fas fa-compass"></i> NAVIGASI
        </div>
        
        <a href="/" class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Beranda
        </a>
        
        <a href="{{ route('tentang') }}" class="nav-item {{ request()->routeIs('tentang') ? 'active' : '' }}">
            <i class="fas fa-info-circle"></i> Tentang
        </a>
        
        <a href="{{ route('panduan') }}" class="nav-item {{ request()->routeIs('panduan') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i> Panduan
        </a>

        @auth
        <div class="menu-divider"></div>
        
        <div class="menu-header">
            <i class="fas fa-chart-line"></i> DASHBOARD
        </div>
        
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="menu-divider"></div>
        
        <div class="menu-header">
            <i class="fas fa-cog"></i> PENGELOLAAN
        </div>
        
        @if(auth()->user()->role == 'admin')
            <!-- MENU UNTUK ADMIN -->
            <a href="{{ route('verifikasi') }}" class="nav-item {{ request()->routeIs('verifikasi') ? 'active' : '' }}">
                <i class="fas fa-user-check"></i> Verifikasi Akun
                @php $pendingCount = \App\Models\User::where('role', 'lembaga')->where('status_akun', 'pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>
            <a href="{{ route('kategori.index') }}" class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Kelola Kategori
            </a>
            <a href="{{ route('lembaga.index') }}" class="nav-item {{ request()->routeIs('lembaga.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Semua Lembaga
            </a>
            
        @elseif(auth()->user()->role == 'lembaga')
            <!-- MENU UNTUK LEMBAGA - DIPERBAIKI -->
            @php
                $userLembaga = \App\Models\Lembaga::where('pengguna_id', auth()->id())->first();
                $lembagaId = $userLembaga ? $userLembaga->lembaga_id : 0;
                $informasiLembagaId = $userLembaga ? $userLembaga->lembaga_id : 0;
            @endphp
            
            <!-- PROFIL LEMBAGA - SEKARANG PAKAI ROUTE SHOW atau EDIT -->
            @if($lembagaId)
                <a href="{{ route('lembaga.show', $lembagaId) }}" class="nav-item {{ request()->routeIs('lembaga.show') ? 'active' : '' }}">
                    <i class="fas fa-building"></i> Profil Lembaga
                </a>
            @else
                <a href="{{ route('lembaga.create') }}" class="nav-item">
                    <i class="fas fa-building"></i> Buat Profil Lembaga
                </a>
            @endif
            
            <a href="{{ route('informasi.show', $informasiLembagaId) }}" class="nav-item {{ request()->routeIs('informasi.show') ? 'active' : '' }}">
                <i class="fas fa-hand-holding-heart"></i> Informasi Donasi
            </a>
            <a href="{{ route('donasi.index') }}" class="nav-item {{ request()->routeIs('donasi.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Daftar Donatur
            </a>
        @endif

        <div class="menu-divider"></div>
        
        <div class="menu-header">
            <i class="fas fa-user-circle"></i> AKUN
        </div>
        
        <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i> Profile Saya
        </a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-item w-full text-left bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl transition-all duration-200 shadow-md mt-2">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
        
        @else
        <div class="menu-divider"></div>
        
        <div class="menu-header">
            <i class="fas fa-key"></i> AKSES AKUN
        </div>
        
        <a href="{{ route('login') }}" class="nav-item">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
        
        <a href="{{ route('register') }}" class="nav-item btn-register">
            <i class="fas fa-user-plus"></i> Daftar Sekarang
        </a>
        @endauth
    </nav>

    <div class="p-4 border-t border-blue-400/30 mt-auto">
        <div class="text-center">
            <div class="flex justify-center gap-2 mb-2">
                <div class="w-2 h-2 bg-blue-300 rounded-full"></div>
                <div class="w-2 h-2 bg-cyan-300 rounded-full"></div>
                <div class="w-2 h-2 bg-indigo-300 rounded-full"></div>
            </div>
            <p class="text-[10px] text-blue-200">
                <i class="fas fa-heart text-red-300"></i> © 2026 SISOREL
            </p>
            <p class="text-[9px] text-blue-300">Membangun Kebaikan Bersama</p>
        </div>
    </div>
</aside>

<main class="main-content">
    @yield('content')
</main>

<div id="overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden" onclick="closeSidebar()"></div>

<script>
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').style.display = 'none';
    }
    
    (function() {
        var sidebar = document.getElementById('sidebar');
        if (sidebar) {
            var savedScrollTop = localStorage.getItem('sidebarScrollTop');
            if (savedScrollTop !== null) {
                sidebar.scrollTop = parseInt(savedScrollTop);
            }
            sidebar.addEventListener('scroll', function() {
                localStorage.setItem('sidebarScrollTop', this.scrollTop);
            });
        }
    })();
    
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    if(sidebar) {
        sidebar.addEventListener('transitionend', function() {
            if (window.innerWidth <= 768 && sidebar.classList.contains('open')) {
                overlay.style.display = 'block';
            } else {
                overlay.style.display = 'none';
            }
        });
    }
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && sidebar) {
            sidebar.classList.remove('open');
            overlay.style.display = 'none';
        }
    });
</script>
</body>
</html>