@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Hero Section dengan Gradasi Biru Kreatif -->
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-blue-200 via-cyan-200 to-indigo-200 rounded-full blur-3xl opacity-30 -z-10 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-gradient-to-r from-blue-300 to-indigo-300 rounded-full blur-3xl opacity-20 -z-10"></div>
        <div class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-r from-cyan-200 to-blue-200 rounded-full blur-2xl opacity-25 -z-10"></div>
        
        <div class="w-28 h-28 bg-gradient-to-br from-blue-500 via-cyan-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl rotate-3 hover:rotate-12 transition-all duration-500">
            <i class="fas fa-book-open text-white text-4xl"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
            <span class="bg-gradient-to-r from-blue-600 via-cyan-600 to-indigo-600 bg-clip-text text-transparent">Panduan</span>
            <span class="bg-gradient-to-r from-gray-700 to-gray-900 bg-clip-text text-transparent"> Penggunaan</span>
        </h1>
        <p class="text-blue-600/70 text-lg max-w-2xl mx-auto">Panduan lengkap menggunakan SISOREL untuk setiap peran pengguna</p>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-400 via-cyan-400 to-indigo-400 rounded-full mx-auto mt-5"></div>
    </div>

    <!-- Tabs Navigation dengan Nuansa Biru -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-blue-100/50 overflow-hidden">
        <div class="border-b border-blue-100 px-5 pt-4 bg-gradient-to-r from-blue-50/30 to-transparent">
            <div class="flex flex-wrap gap-2">
                <button class="tab-btn active px-6 py-3 text-sm font-semibold rounded-t-xl transition-all duration-300" data-tab="publik">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-users text-blue-500"></i>
                        <span>Masyarakat</span>
                    </div>
                </button>
                <button class="tab-btn px-6 py-3 text-sm font-semibold rounded-t-xl transition-all duration-300 text-gray-500 hover:text-blue-600" data-tab="lembaga">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-building text-cyan-500"></i>
                        <span>Lembaga</span>
                    </div>
                </button>
                <button class="tab-btn px-6 py-3 text-sm font-semibold rounded-t-xl transition-all duration-300 text-gray-500 hover:text-indigo-600" data-tab="admin">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user-shield text-indigo-500"></i>
                        <span>Admin</span>
                    </div>
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- ==================== TAB MASYARAKAT ==================== -->
            <div id="tab-publik" class="tab-content">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Card 1 - Biru -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl p-5 border border-blue-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-cyan-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="absolute bottom-0 left-0 w-20 h-20 bg-gradient-to-tr from-indigo-200 to-transparent rounded-tr-3xl opacity-20"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition duration-300 group-hover:shadow-blue-500/30">
                                <i class="fas fa-search text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-lg mb-1">Mencari Lembaga</h3>
                                <p class="text-blue-700/70 text-sm leading-relaxed">Gunakan fitur pencarian dan filter untuk menemukan lembaga sosial berdasarkan kategori, lokasi, atau status kolaborasi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 - Cyan -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-cyan-100 via-cyan-50 to-white rounded-xl p-5 border border-cyan-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-cyan-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="absolute bottom-0 left-0 w-20 h-20 bg-gradient-to-tr from-blue-200 to-transparent rounded-tr-3xl opacity-20"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition duration-300 group-hover:shadow-cyan-500/30">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-cyan-800 text-lg mb-1">Lihat Detail</h3>
                                <p class="text-cyan-700/70 text-sm leading-relaxed">Klik "Lihat Detail" untuk melihat informasi lengkap profil, anak asuh, dan kebutuhan donasi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 - Indigo -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-indigo-100 via-indigo-50 to-white rounded-xl p-5 border border-indigo-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-indigo-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="absolute bottom-0 left-0 w-20 h-20 bg-gradient-to-tr from-cyan-200 to-transparent rounded-tr-3xl opacity-20"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition duration-300 group-hover:shadow-indigo-500/30">
                                <i class="fas fa-hand-holding-heart text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-indigo-800 text-lg mb-1">Donasi & Kolaborasi</h3>
                                <p class="text-indigo-700/70 text-sm leading-relaxed">Hubungi kontak lembaga yang tersedia untuk berdonasi atau berkolaborasi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 - Biru Tua -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl p-5 border border-blue-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-indigo-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="absolute bottom-0 left-0 w-20 h-20 bg-gradient-to-tr from-cyan-200 to-transparent rounded-tr-3xl opacity-20"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition duration-300 group-hover:shadow-blue-600/30">
                                <i class="fas fa-user-plus text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-lg mb-1">Daftar Lembaga</h3>
                                <p class="text-blue-700/70 text-sm leading-relaxed">Silakan klik tombol 'Daftar Sekarang' berwarna oranye di menu samping kiri untuk mendaftar sebagai lembaga sosial.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== TAB LEMBAGA ==================== -->
            <div id="tab-lembaga" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Card 1 - Biru -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl p-5 border border-blue-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-cyan-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-building text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-lg mb-1">Isi Profil Lembaga</h3>
                                <p class="text-blue-700/70 text-sm leading-relaxed">Lengkapi data lembaga Anda (nama, alamat, kontak, visi misi, dan kategori).</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 - Cyan -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-cyan-100 via-cyan-50 to-white rounded-xl p-5 border border-cyan-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-cyan-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-hand-holding-heart text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-cyan-800 text-lg mb-1">Kelola Donasi</h3>
                                <p class="text-cyan-700/70 text-sm leading-relaxed">Isi data anak asuh, kebutuhan donasi, dan status kolaborasi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 - Indigo -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-indigo-100 via-indigo-50 to-white rounded-xl p-5 border border-indigo-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-indigo-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-edit text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-indigo-800 text-lg mb-1">Update Data</h3>
                                <p class="text-indigo-700/70 text-sm leading-relaxed">Edit profil dan informasi donasi kapan saja melalui tombol Edit.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 - Biru Tua -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl p-5 border border-blue-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-indigo-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-chart-line text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-lg mb-1">Dashboard</h3>
                                <p class="text-blue-700/70 text-sm leading-relaxed">Pantau statistik lembaga Anda di halaman dashboard.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== TAB ADMIN ==================== -->
            <div id="tab-admin" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Card 1 - Biru -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl p-5 border border-blue-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-cyan-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-user-check text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-lg mb-1">Verifikasi Akun</h3>
                                <p class="text-blue-700/70 text-sm leading-relaxed">Aktifkan akun lembaga yang mendaftar melalui menu Verifikasi Akun.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 - Cyan -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-cyan-100 via-cyan-50 to-white rounded-xl p-5 border border-cyan-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-cyan-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-tags text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-cyan-800 text-lg mb-1">Kelola Kategori</h3>
                                <p class="text-cyan-700/70 text-sm leading-relaxed">Tambah/edit kategori lembaga melalui menu Kelola Kategori.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 - Indigo -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-indigo-100 via-indigo-50 to-white rounded-xl p-5 border border-indigo-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-indigo-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-chart-line text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-indigo-800 text-lg mb-1">Monitoring</h3>
                                <p class="text-indigo-700/70 text-sm leading-relaxed">Pantau semua lembaga melalui menu Semua Lembaga.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 - Biru Tua -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl p-5 border border-blue-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-indigo-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-database text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-lg mb-1">Informasi Donasi</h3>
                                <p class="text-blue-700/70 text-sm leading-relaxed">Lihat semua informasi donasi dari lembaga terdaftar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Note dengan Nuansa Biru -->
    <div class="text-center mt-8">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-full border border-blue-100">
            <i class="fas fa-question-circle text-blue-400 text-sm"></i>
            <p class="text-xs text-blue-600">Butuh bantuan lebih lanjut? <a href="#" class="font-semibold underline">Hubungi Admin</a></p>
        </div>
    </div>
</div>

<style>
    .tab-btn.active {
        background: white;
        color: #2563eb;
        border-bottom: 2px solid #2563eb;
        box-shadow: 0 -2px 8px rgba(37, 99, 235, 0.08);
    }
    .tab-btn:hover:not(.active) {
        background: #f8fafc;
        transform: translateY(-2px);
    }
    .tab-content {
        animation: fadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hidden {
        display: none;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.add('text-gray-500');
            });
            this.classList.add('active');
            this.classList.remove('text-gray-500');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            const tabId = this.getAttribute('data-tab');
            document.getElementById(`tab-${tabId}`).classList.remove('hidden');
        });
    });
</script>
@endsection