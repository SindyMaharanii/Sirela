@extends('layouts.app')

@section('content')
<!-- Hero Section dengan Gradasi Biru Kreatif -->
<section class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 rounded-2xl mb-10 text-white">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-400/20 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-6 py-16 text-center relative z-10">
        <div class="max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 bg-white/20 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                <i class="fas fa-hand-holding-heart text-yellow-300 text-sm"></i>
                <span class="text-sm font-medium">Platform Informasi Lembaga Sosial Terpercaya</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-5 leading-tight">
                Temukan Lembaga Sosial & 
                <span class="text-yellow-300">Jadilah Relawan</span>
            </h1>
        </div>
    </div>
</section>

<!-- STATISTIK - Versi Gradasi Kreatif & Keren -->
<section class="mb-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            <!-- Card 1 - Lembaga Terdaftar (Sunset Blue) -->
            <div class="group relative overflow-hidden rounded-2xl p-5 text-center text-white shadow-lg hover:shadow-2xl transition-all hover:-translate-y-2 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-400"></div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition shadow-lg">
                        <i class="fas fa-building text-2xl text-white"></i>
                    </div>
                    <p class="text-3xl font-bold">{{ \App\Models\Lembaga::count() }}</p>
                    <p class="text-sm text-white/80 mt-1">Lembaga Terdaftar</p>
                    <div class="w-8 h-0.5 bg-white/50 rounded-full mx-auto mt-3 group-hover:w-12 transition-all duration-300"></div>
                </div>
            </div>

            <!-- Card 2 - Lembaga Aktif (Ocean to Teal) -->
            <div class="group relative overflow-hidden rounded-2xl p-5 text-center text-white shadow-lg hover:shadow-2xl transition-all hover:-translate-y-2 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-500 via-emerald-500 to-green-400"></div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition shadow-lg">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <p class="text-3xl font-bold">{{ \App\Models\Lembaga::whereHas('user', function($q){ $q->where('status_akun', 'aktif'); })->count() }}</p>
                    <p class="text-sm text-white/80 mt-1">Lembaga Aktif</p>
                    <div class="w-8 h-0.5 bg-white/50 rounded-full mx-auto mt-3 group-hover:w-12 transition-all duration-300"></div>
                </div>
            </div>

            <!-- Card 3 - Kategori Lembaga (Sunset to Pink) -->
            <div class="group relative overflow-hidden rounded-2xl p-5 text-center text-white shadow-lg hover:shadow-2xl transition-all hover:-translate-y-2 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-pink-500 to-rose-400"></div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition shadow-lg">
                        <i class="fas fa-tag text-2xl text-white"></i>
                    </div>
                    <p class="text-3xl font-bold">{{ \App\Models\Kategori::count() }}</p>
                    <p class="text-sm text-white/80 mt-1">Kategori Lembaga</p>
                    <div class="w-8 h-0.5 bg-white/50 rounded-full mx-auto mt-3 group-hover:w-12 transition-all duration-300"></div>
                </div>
            </div>

            <!-- Card 4 - Kebutuhan Donasi (Midnight to Purple) -->
            <div class="group relative overflow-hidden rounded-2xl p-5 text-center text-white shadow-lg hover:shadow-2xl transition-all hover:-translate-y-2 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-700 via-purple-600 to-violet-500"></div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition shadow-lg">
                        <i class="fas fa-hand-holding-heart text-2xl text-white"></i>
                    </div>
                    <p class="text-3xl font-bold">{{ \App\Models\InformasiLembaga::whereNotNull('kebutuhan_donasi_list')->count() }}</p>
                    <p class="text-sm text-white/80 mt-1">Kebutuhan Donasi</p>
                    <div class="w-8 h-0.5 bg-white/50 rounded-full mx-auto mt-3 group-hover:w-12 transition-all duration-300"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DAFTAR LEMBAGA -->
<section id="lembaga" class="mb-12">
    <div class="container mx-auto px-6">
        <div class="text-center mb-10">
            <!-- Icon animasi -->
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl mb-4 mx-auto shadow-lg hover:scale-110 transition-transform duration-300 cursor-pointer">
                <i class="fas fa-handshake text-white text-2xl"></i>
            </div>
            
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                📋 <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Daftar Lembaga Sosial</span>
            </h2>
            
            <div class="flex items-center justify-center gap-2 text-blue-400 mb-3">
                <i class="fas fa-circle text-[6px]"></i>
                <i class="fas fa-circle text-[4px]"></i>
                <i class="fas fa-circle text-[6px]"></i>
            </div>
            
            <p class="text-gray-500 max-w-2xl mx-auto">
                <i class="fas fa-quote-left text-blue-300 text-xs mr-1"></i>
                Temukan lembaga sosial yang sesuai dengan minat dan lokasi Anda
                <i class="fas fa-quote-right text-blue-300 text-xs ml-1"></i>
            </p>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white rounded-2xl shadow-md p-5 mb-8 border border-blue-100">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" id="searchInput" placeholder="🔍 Cari lembaga, kategori, atau lokasi..." class="border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <select id="filterKategori" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">📂 Semua Kategori</option>
                    @foreach(\App\Models\Kategori::all() as $kat)
                        <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
                <select id="filterLokasi" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">📍 Semua Lokasi</option>
                    @foreach(\App\Models\Lembaga::whereNotNull('lokasi')->distinct()->pluck('lokasi') as $lok)
                        <option value="{{ $lok }}">{{ $lok }}</option>
                    @endforeach
                </select>
                <select id="filterKolaborasi" class="border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">🤝 Semua Status</option>
                    <option value="dibuka">✓ Dibuka Kolaborasi</option>
                    <option value="ditutup">✗ Tutup Kolaborasi</option>
                </select>
            </div>
        </div>

        <!-- Lembaga Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="lembagaContainer">
            @foreach($lembaga as $item)
            @php
                $searchText = strtolower($item->nama_lembaga . ' ' . $item->kategori->pluck('nama_kategori')->implode(' ') . ' ' . ($item->lokasi ?? '') . ' ' . ($item->alamat ?? ''));
            @endphp
            <div class="group bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all hover:-translate-y-2 lembaga-card"
                 data-search="{{ $searchText }}"
                 data-kategori="@foreach($item->kategori as $kat){{ strtolower($kat->nama_kategori) }} @endforeach"
                 data-lokasi="{{ strtolower($item->lokasi ?? '') }}"
                 data-kolaborasi="{{ $item->informasi->status_kolaborasi ?? '' }}">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition">{{ $item->nama_lembaga }}</h3>
                        <div class="flex gap-1 flex-wrap">
                            @foreach($item->kategori as $kat)
                                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ $kat->nama_kategori }}</span>
                            @endforeach
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-2"><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i> {{ $item->lokasi ?? $item->alamat ?? 'Tidak tersedia' }}</p>
                    <p class="text-gray-500 text-sm mb-3"><i class="fas fa-phone mr-2 text-blue-500"></i> {{ $item->kontak ?? 'Tidak tersedia' }}</p>
                    @if($item->informasi)
                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-3 mb-3">
                            <p class="text-sm text-gray-600"><i class="fas fa-child mr-1 text-blue-500"></i> Jumlah Anak: <span class="font-semibold">{{ $item->informasi->jumlah_anak_asuh ?? 0 }}</span></p>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-handshake mr-1"></i> Status: 
                                @if(($item->informasi->status_kolaborasi ?? '') == 'dibuka')
                                    <span class="text-green-600 font-semibold">✓ Dibuka</span>
                                @else
                                    <span class="text-red-600 font-semibold">✗ Ditutup</span>
                                @endif
                            </p>
                        </div>
                    @endif
                    <a href="/public/lembaga/{{ $item->lembaga_id }}" class="inline-flex items-center gap-2 text-blue-600 font-medium hover:text-blue-800 transition group-hover:gap-3">
                        Lihat Detail <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div id="noResultMsg" class="hidden text-center py-12">
            <i class="fas fa-search text-5xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Tidak ada lembaga yang sesuai dengan filter Anda</p>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl text-white py-12 mb-8">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Menjadi Bagian dari Perubahan?</h2>
        <p class="text-blue-100 mb-6 max-w-2xl mx-auto">Bergabunglah dengan SISOREL dan mulailah berbagi kebaikan bersama ribuan lembaga sosial dan relawan</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="register-btn inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold transition-all hover:scale-105">
                <i class="fas fa-user-plus"></i> Daftar Jadi Lembaga
            </a>
            <a href="#lembaga" class="border-2 border-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-xl font-bold transition-all hover:scale-105 inline-flex items-center gap-2">
                <i class="fas fa-search"></i> Jelajahi Lembaga
            </a>
        </div>
    </div>
</section>

<style>
    .hidden {
        display: none;
    }
    
    /* Register Button - Sama seperti di Sidebar */
    .register-btn {
        background: linear-gradient(105deg, #f59e0b, #d97706);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        border: none;
        cursor: pointer;
    }
    
    .register-btn i {
        color: white;
    }
    
    .register-btn:hover {
        transform: scale(1.05);
        background: linear-gradient(105deg, #fbbf24, #f59e0b);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }
</style>

<script>
    function filterLembaga() {
        let searchTerm = document.getElementById('searchInput').value.toLowerCase();
        let kategori = document.getElementById('filterKategori').value.toLowerCase();
        let lokasi = document.getElementById('filterLokasi').value.toLowerCase();
        let kolaborasi = document.getElementById('filterKolaborasi').value.toLowerCase();
        
        let cards = document.querySelectorAll('.lembaga-card');
        let visibleCount = 0;
        
        cards.forEach(card => {
            let searchData = card.getAttribute('data-search') || '';
            let cardKategori = card.getAttribute('data-kategori') || '';
            let cardLokasi = card.getAttribute('data-lokasi') || '';
            let cardKolaborasi = card.getAttribute('data-kolaborasi') || '';
            
            let matchSearch = searchTerm === '' || searchData.indexOf(searchTerm) !== -1;
            let matchKategori = kategori === '' || cardKategori.indexOf(kategori) !== -1;
            let matchLokasi = lokasi === '' || cardLokasi.indexOf(lokasi) !== -1;
            let matchKolaborasi = kolaborasi === '' || cardKolaborasi === kolaborasi;
            
            if (matchSearch && matchKategori && matchLokasi && matchKolaborasi) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        let noResultMsg = document.getElementById('noResultMsg');
        if (visibleCount === 0) {
            noResultMsg.classList.remove('hidden');
        } else {
            noResultMsg.classList.add('hidden');
        }
    }
    
    document.getElementById('searchInput').addEventListener('keyup', filterLembaga);
    document.getElementById('filterKategori').addEventListener('change', filterLembaga);
    document.getElementById('filterLokasi').addEventListener('change', filterLembaga);
    document.getElementById('filterKolaborasi').addEventListener('change', filterLembaga);
</script>
@endsection