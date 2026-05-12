@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Hero Section -->
    <div class="text-center mb-12 relative">
        <div class="w-28 h-28 bg-gradient-to-br from-blue-500 via-cyan-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
            <i class="fas fa-book-open text-white text-4xl"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
            <span class="bg-gradient-to-r from-blue-600 via-cyan-600 to-indigo-600 bg-clip-text text-transparent">Panduan</span>
            <span class="bg-gradient-to-r from-gray-700 to-gray-900 bg-clip-text text-transparent"> Penggunaan</span>
        </h1>
        <p class="text-blue-600/70 text-lg">Panduan lengkap menggunakan SISOREL untuk setiap peran pengguna</p>
    </div>

    <!-- Tabs Navigation -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-blue-100/50 overflow-hidden">
        <div class="border-b border-blue-100 px-5 pt-4 bg-gradient-to-r from-blue-50/30 to-transparent">
            <div class="flex flex-wrap gap-2">
                <button class="tab-btn active px-6 py-3 text-sm font-semibold rounded-t-xl transition" data-tab="publik">
                    <i class="fas fa-users text-blue-500 mr-2"></i> Masyarakat
                </button>
                <button class="tab-btn px-6 py-3 text-sm font-semibold rounded-t-xl transition text-gray-500" data-tab="lembaga">
                    <i class="fas fa-building text-cyan-500 mr-2"></i> Lembaga
                </button>
                <button class="tab-btn px-6 py-3 text-sm font-semibold rounded-t-xl transition text-gray-500" data-tab="admin">
                    <i class="fas fa-user-shield text-indigo-500 mr-2"></i> Admin
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- TAB MASYARAKAT -->
            <div id="tab-publik" class="tab-content">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Card 1 - Mencari Lembaga -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-white rounded-xl p-5 border border-blue-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-cyan-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-search text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800 text-lg mb-1">Mencari Lembaga</h3>
                                <p class="text-blue-700/70 text-sm leading-relaxed">Gunakan fitur pencarian dan filter untuk menemukan lembaga sosial berdasarkan kategori, lokasi, atau status kolaborasi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 - Lihat Detail -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-cyan-100 via-cyan-50 to-white rounded-xl p-5 border border-cyan-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-cyan-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-cyan-800 text-lg mb-1">Lihat Detail Lembaga</h3>
                                <p class="text-cyan-700/70 text-sm leading-relaxed">Klik "Lihat Detail" untuk melihat informasi lengkap profil, anak asuh, dan kebutuhan donasi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 - Donasi & Progress -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-green-100 via-green-50 to-white rounded-xl p-5 border border-green-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-green-300 to-emerald-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-hand-holding-heart text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-green-800 text-lg mb-1">Donasi & Progress</h3>
                                <p class="text-green-700/70 text-sm leading-relaxed">Pilih kebutuhan donasi (Beras 50kg, Susu 20 box, dll), isi form, dan pantau progress donasi (target vs terkumpul). Lembaga akan menghubungi Anda.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 - Daftar Lembaga -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-purple-100 via-purple-50 to-white rounded-xl p-5 border border-purple-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-purple-300 to-pink-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-user-plus text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-purple-800 text-lg mb-1">Daftar Lembaga</h3>
                                <p class="text-purple-700/70 text-sm leading-relaxed">Klik tombol 'Daftar Sekarang' berwarna oranye di menu samping kiri untuk mendaftar sebagai lembaga sosial.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB LEMBAGA -->
            <div id="tab-lembaga" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Card 1 - Isi Profil Lembaga -->
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

                    <!-- Card 2 - Kelola Donasi -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-cyan-100 via-cyan-50 to-white rounded-xl p-5 border border-cyan-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-cyan-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-hand-holding-heart text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-cyan-800 text-lg mb-1">Kelola Donasi</h3>
                                <p class="text-cyan-700/70 text-sm leading-relaxed">Isi data anak asuh, kebutuhan donasi (nama, jumlah, satuan), dan status kolaborasi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 - Edit/Tambah Kebutuhan -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-amber-100 via-amber-50 to-white rounded-xl p-5 border border-amber-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-amber-300 to-orange-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-edit text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-amber-800 text-lg mb-1">Edit/Tambah Kebutuhan</h3>
                                <p class="text-amber-700/70 text-sm leading-relaxed">Setiap kebutuhan donasi memiliki tombol Edit/Hapus sendiri, serta tombol Tambah Kebutuhan khusus.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 - Daftar Donatur -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-indigo-100 via-indigo-50 to-white rounded-xl p-5 border border-indigo-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-indigo-300 to-blue-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-indigo-800 text-lg mb-1">Daftar Donatur</h3>
                                <p class="text-indigo-700/70 text-sm leading-relaxed">Lihat siapa saja yang ingin berdonasi, konfirmasi, dan hubungi via WhatsApp.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB ADMIN -->
            <div id="tab-admin" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Card 1 - Verifikasi Akun -->
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

                    <!-- Card 2 - Kelola Kategori -->
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

                    <!-- Card 3 - Monitoring -->
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

                    <!-- Card 4 - Informasi Donasi -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-purple-100 via-purple-50 to-white rounded-xl p-5 border border-purple-200 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-purple-300 to-pink-200 rounded-full opacity-30 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition">
                                <i class="fas fa-database text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-purple-800 text-lg mb-1">Informasi Donasi</h3>
                                <p class="text-purple-700/70 text-sm leading-relaxed">Lihat semua informasi donasi dari lembaga terdaftar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-8">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-full border border-blue-100">
            <i class="fas fa-question-circle text-blue-400 text-sm"></i>
            <p class="text-xs text-blue-600">Butuh bantuan lebih lanjut? <a href="mailto:maharanisindy@gmail.com" class="font-semibold underline">Hubungi Admin</a></p>
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
    .hidden { display: none; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
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