<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kegiatan Sosial dan Relawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
        }
        .lembaga-card {
            transition: all 0.3s ease;
        }
        .lembaga-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">SISOREL</h1>
                        <span class="ml-2 text-sm text-gray-500">Sistem Informasi Sosial & Relawan</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold mb-4">Temukan Lembaga Sosial & Jadilah Relawan</h1>
                <p class="text-xl mb-8">Platform informasi kegiatan sosial dan relawan terpercaya</p>
                <div class="max-w-md mx-auto">
                    <input type="text" id="searchInput" placeholder="Cari lembaga, kategori, atau lokasi..." class="w-full px-4 py-3 rounded-lg text-gray-800">
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">Filter Lembaga</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <select id="filterKategori" class="border rounded-lg px-3 py-2 text-gray-800">
                        <option value="">Semua Kategori</option>
                        @php
                            $kategoris = App\Models\Kategori::all();
                        @endphp
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <select id="filterLokasi" class="border rounded-lg px-3 py-2 text-gray-800">
                        <option value="">Semua Lokasi</option>
                        @php
                            $uniqueLokasi = App\Models\Lembaga::whereNotNull('lokasi')->distinct()->pluck('lokasi');
                        @endphp
                        @foreach($uniqueLokasi as $lok)
                            <option value="{{ $lok }}">{{ $lok }}</option>
                        @endforeach
                    </select>
                    <select id="filterKolaborasi" class="border rounded-lg px-3 py-2 text-gray-800">
                        <option value="">Semua Status Kolaborasi</option>
                        <option value="dibuka">Dibuka</option>
                        <option value="ditutup">Ditutup</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Lembaga List -->
        <div class="max-w-7xl mx-auto px-4 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="lembagaContainer">
                @foreach($lembaga as $item)
                @php
                    $searchText = strtolower($item->nama_lembaga . ' ' . 
                        $item->kategori->pluck('nama_kategori')->implode(' ') . ' ' . 
                        ($item->lokasi ?? '') . ' ' . 
                        ($item->alamat ?? ''));
                @endphp
                <div class="bg-white rounded-lg shadow-md overflow-hidden lembaga-card transition"
                     data-search="{{ $searchText }}"
                     data-kategori="@foreach($item->kategori as $kat){{ strtolower($kat->nama_kategori) }} @endforeach"
                     data-lokasi="{{ strtolower($item->lokasi ?? '') }}"
                     data-kolaborasi="{{ $item->informasi->status_kolaborasi ?? '' }}">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->nama_lembaga }}</h3>
                        <div class="mb-2">
                            @foreach($item->kategori as $kat)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1">{{ $kat->nama_kategori }}</span>
                            @endforeach
                        </div>
                        <p class="text-gray-600 text-sm mb-2">📍 {{ $item->lokasi ?? $item->alamat ?? 'Tidak tersedia' }}</p>
                        <p class="text-gray-600 text-sm mb-2">📞 {{ $item->kontak ?? 'Tidak tersedia' }}</p>
                        @if($item->informasi)
                            <p class="text-gray-600 text-sm mb-1">👥 Jumlah Anak: {{ $item->informasi->jumlah_anak_asuh ?? 0 }}</p>
                            <p class="text-sm mb-3">
                                Status Kolaborasi: 
                                @if(($item->informasi->status_kolaborasi ?? '') == 'dibuka')
                                    <span class="text-green-600 font-semibold">✓ Dibuka</span>
                                @else
                                    <span class="text-red-600 font-semibold">✗ Ditutup</span>
                                @endif
                            </p>
                        @endif
                        <a href="/public/lembaga/{{ $item->lembaga_id }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <footer class="bg-white border-t py-6">
            <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Sistem Informasi Kegiatan Sosial dan Relawan. All rights reserved.
            </div>
        </footer>
    </div>

    <script>
        function filterLembaga() {
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            var kategori = document.getElementById('filterKategori').value.toLowerCase();
            var lokasi = document.getElementById('filterLokasi').value.toLowerCase();
            var kolaborasi = document.getElementById('filterKolaborasi').value.toLowerCase();
            
            var cards = document.querySelectorAll('.lembaga-card');
            var visibleCount = 0;
            
            cards.forEach(function(card) {
                var searchData = card.getAttribute('data-search') || '';
                var cardKategori = card.getAttribute('data-kategori') || '';
                var cardLokasi = card.getAttribute('data-lokasi') || '';
                var cardKolaborasi = card.getAttribute('data-kolaborasi') || '';
                
                var matchSearch = searchTerm === '' || searchData.indexOf(searchTerm) !== -1;
                var matchKategori = kategori === '' || cardKategori.indexOf(kategori) !== -1;
                var matchLokasi = lokasi === '' || cardLokasi.indexOf(lokasi) !== -1;
                var matchKolaborasi = kolaborasi === '' || cardKolaborasi === kolaborasi;
                
                if (matchSearch && matchKategori && matchLokasi && matchKolaborasi) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            var container = document.getElementById('lembagaContainer');
            var existingMsg = document.getElementById('noResultMsg');
            
            if (visibleCount === 0) {
                if (!existingMsg) {
                    var msg = document.createElement('div');
                    msg.id = 'noResultMsg';
                    msg.className = 'col-span-full text-center py-12 bg-white rounded-lg shadow';
                    msg.innerHTML = '<p class="text-gray-500">Tidak ada lembaga yang sesuai dengan kata kunci atau filter Anda.</p>';
                    container.appendChild(msg);
                }
            } else {
                if (existingMsg) {
                    existingMsg.remove();
                }
            }
        }
        
        document.getElementById('searchInput').addEventListener('keyup', filterLembaga);
        document.getElementById('filterKategori').addEventListener('change', filterLembaga);
        document.getElementById('filterLokasi').addEventListener('change', filterLembaga);
        document.getElementById('filterKolaborasi').addEventListener('change', filterLembaga);
    </script>
</body>
</html>