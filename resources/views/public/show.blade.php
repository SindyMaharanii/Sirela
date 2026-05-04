<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISOREL - Detail Lembaga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);
            min-height: 100vh;
        }
        .status-badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-open {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        .status-closed {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-blue-100">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition">
                    <span class="text-white text-xl font-bold">S</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">SISOREL</h1>
                    <p class="text-xs text-gray-500">Sistem Informasi Sosial & Relawan</p>
                </div>
            </a>
            <div class="hidden md:flex items-center gap-6">
                <a href="/" class="text-gray-600 hover:text-blue-600 font-medium transition">Beranda</a>
                <a href="{{ route('tentang') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Tentang</a>
                <a href="{{ route('panduan') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Panduan</a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-8">
        <a href="/" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-6 hover:gap-3 transition-all duration-300">
            <i class="fas fa-arrow-left text-sm"></i>
            <span>Kembali ke Daftar Lembaga</span>
        </a>

        <!-- Card Profil -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 px-6 py-5">
                <div class="flex flex-wrap justify-between items-start gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-white">{{ $lembaga['nama_lembaga'] }}</h1>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <!-- STATUS KOLABORASI DENGAN PENJELASAN - DITAMPILKAN DI BAWAH HEADER -->
                @php
                    $statusKolab = '';
                    if(isset($lembaga['informasi']) && isset($lembaga['informasi']['status_kolaborasi'])) {
                        $statusKolab = $lembaga['informasi']['status_kolaborasi'];
                    }
                @endphp
                
                <div class="mb-6 p-4 rounded-xl {{ $statusKolab == 'dibuka' ? 'bg-green-50 border border-green-200' : ($statusKolab == 'ditutup' ? 'bg-gray-50 border border-gray-200' : 'bg-yellow-50 border border-yellow-200') }}">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <div class="flex-shrink-0">
                            @if($statusKolab == 'dibuka')
                                <div class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-md">
                                    <i class="fas fa-handshake text-white text-2xl"></i>
                                </div>
                            @elseif($statusKolab == 'ditutup')
                                <div class="w-14 h-14 bg-gray-500 rounded-full flex items-center justify-center shadow-md">
                                    <i class="fas fa-lock text-white text-2xl"></i>
                                </div>
                            @else
                                <div class="w-14 h-14 bg-yellow-500 rounded-full flex items-center justify-center shadow-md">
                                    <i class="fas fa-question-circle text-white text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            @if($statusKolab == 'dibuka')
                                <div class="flex items-center gap-2 flex-wrap mb-2">
                                    <span class="status-badge status-open">
                                        <i class="fas fa-handshake"></i> Dibuka untuk Kolaborasi
                                    </span>
                                </div>
                                <p class="text-green-800 text-sm leading-relaxed">
                                    ✅ <span class="font-semibold">Apa itu Kolaborasi?</span> Lembaga ini <span class="font-semibold">MEMBUKA PELUANG KERJA SAMA</span> dengan relawan, donatur, mitra, atau pihak lain yang ingin membantu. 
                                    Anda dapat menghubungi kontak lembaga untuk berdiskusi lebih lanjut mengenai bentuk kolaborasi yang tersedia.
                                </p>
                            @elseif($statusKolab == 'ditutup')
                                <div class="flex items-center gap-2 flex-wrap mb-2">
                                    <span class="status-badge status-closed">
                                        <i class="fas fa-lock"></i> Tidak Membuka Kolaborasi
                                    </span>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    🔒 <span class="font-semibold">Apa itu Kolaborasi?</span> Lembaga ini saat ini <span class="font-semibold">TIDAK MEMBUKA KOLABORASI</span> dengan pihak luar. 
                                    Namun, Anda tetap dapat menyalurkan donasi sesuai dengan daftar kebutuhan yang tersedia di bawah. Hubungi kontak lembaga untuk informasi lebih lanjut.
                                </p>
                            @else
                                <div class="flex items-center gap-2 flex-wrap mb-2">
                                    <span class="status-badge status-closed">
                                        <i class="fas fa-question-circle"></i> Belum Ada Informasi
                                    </span>
                                </div>
                                <p class="text-yellow-800 text-sm leading-relaxed">
                                    ❓ <span class="font-semibold">Apa itu Kolaborasi?</span> Kolaborasi adalah kerja sama antara lembaga sosial dengan relawan, donatur, atau mitra untuk mencapai tujuan bersama. 
                                    Lembaga ini belum mengupdate status kolaborasinya. Silakan hubungi langsung via kontak di bawah.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-xl">
                        <i class="fas fa-map-marker-alt text-blue-500 mt-0.5 text-lg"></i>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Lokasi</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga['lokasi'] ?? $lembaga['alamat'] ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-xl">
                        <i class="fas fa-phone text-blue-500 mt-0.5 text-lg"></i>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Kontak</p>
                            <p class="text-gray-800 font-medium">{{ $lembaga['kontak'] ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="mb-5">
                    <p class="text-sm text-gray-500 mb-2 flex items-center gap-2"><i class="fas fa-tags text-blue-500"></i> Kategori Lembaga</p>
                    <div class="flex flex-wrap gap-2">
                        @if(isset($lembaga['kategori']) && count($lembaga['kategori']) > 0)
                            @foreach($lembaga['kategori'] as $kat)
                                <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{ $kat['nama_kategori'] }}</span>
                            @endforeach
                        @else
                            <span class="text-gray-500 text-sm">Tidak ada kategori</span>
                        @endif
                    </div>
                </div>

                <!-- Visi & Misi -->
                @if(isset($lembaga['visi']) && !empty($lembaga['visi']))
                <div class="mb-4 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl">
                    <div class="flex items-center gap-2 mb-2"><i class="fas fa-eye text-indigo-500"></i><h3 class="font-bold text-gray-700">Visi</h3></div>
                    <p class="text-gray-700">{{ $lembaga['visi'] }}</p>
                </div>
                @endif
                @if(isset($lembaga['misi']) && !empty($lembaga['misi']))
                <div class="mb-4 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl">
                    <div class="flex items-center gap-2 mb-2"><i class="fas fa-bullseye text-indigo-500"></i><h3 class="font-bold text-gray-700">Misi</h3></div>
                    <p class="text-gray-700">{{ $lembaga['misi'] }}</p>
                </div>
                @endif
                @if(isset($lembaga['deskripsi']) && !empty($lembaga['deskripsi']))
                <div class="mb-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                    <div class="flex items-center gap-2 mb-2"><i class="fas fa-file-alt text-gray-500"></i><h3 class="font-bold text-gray-700">Deskripsi</h3></div>
                    <p class="text-gray-700 leading-relaxed">{{ $lembaga['deskripsi'] }}</p>
                </div>
                @endif
            </div>
        </div>

        @if(isset($lembaga['informasi']) && $lembaga['informasi'])
        @php $info = $lembaga['informasi']; @endphp
        
        <!-- Card Anak Asuh -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-teal-500 to-emerald-600 px-6 py-4">
                <div class="flex items-center gap-2"><i class="fas fa-child text-white text-xl"></i><h2 class="text-xl font-bold text-white">Data Anak Asuh</h2></div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 text-center border border-blue-200">
                        <i class="fas fa-users text-blue-500 text-3xl mb-2"></i>
                        <p class="text-3xl font-bold text-blue-600">{{ $info['jumlah_anak_asuh'] ?? 0 }}</p>
                        <p class="text-gray-600 text-sm">Jumlah Anak Asuh</p>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl p-4 text-center border border-emerald-200">
                        <i class="fas fa-calendar-alt text-emerald-500 text-3xl mb-2"></i>
                        <p class="text-3xl font-bold text-emerald-600">{{ $info['rentang_usia'] ?? '-' }}</p>
                        <p class="text-gray-600 text-sm">Rentang Usia</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 text-center border border-purple-200">
                        <i class="fas fa-clock text-purple-500 text-3xl mb-2"></i>
                        <p class="text-base font-bold text-purple-600">📅 {{ isset($info['tanggal_update']) && $info['tanggal_update'] ? date('d M Y', strtotime($info['tanggal_update'])) : '-' }}</p>
                        <p class="text-gray-600 text-sm">Terakhir Update</p>
                    </div>
                </div>
                @if(isset($info['profil_anak']) && !empty($info['profil_anak']))
                <div class="mt-5 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                    <div class="flex items-start gap-3"><div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center"><i class="fas fa-file-alt text-blue-500"></i></div><div><p class="text-sm font-semibold text-gray-700 mb-1">Deskripsi Anak Asuh</p><p class="text-gray-600 leading-relaxed">{{ $info['profil_anak'] }}</p></div></div>
                </div>
                @endif
            </div>
        </div>

        <!-- Card Donasi -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-4">
                <div class="flex items-center gap-2"><i class="fas fa-hand-holding-heart text-white text-xl"></i><h2 class="text-xl font-bold text-white">Kebutuhan Donasi</h2></div>
            </div>
            <div class="p-6">
                @php
                    $donasiList = [];
                    if(isset($info['kebutuhan_donasi_list']) && !empty($info['kebutuhan_donasi_list'])) {
                        $donasiList = json_decode($info['kebutuhan_donasi_list'], true);
                        if(!is_array($donasiList)) $donasiList = [];
                    }
                @endphp
                @if(count($donasiList) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gradient-to-r from-rose-100 to-pink-100">
                                <th class="border border-gray-300 px-4 py-3 text-center text-gray-700 font-semibold">No</th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-gray-700 font-semibold">Nama Kebutuhan</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-gray-700 font-semibold">Jumlah</th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-gray-700 font-semibold">Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donasiList as $index => $item)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-blue-50 transition">
                                <td class="border border-gray-300 px-4 py-3 text-center text-gray-800">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-3 text-gray-800">
                                    <div class="flex items-center gap-2"><i class="fas fa-box text-blue-500"></i>{{ $item['nama'] ?? '-' }}</div>
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center text-gray-800 font-semibold">{{ $item['jumlah'] ?? 0 }}</td>
                                <td class="border border-gray-300 px-4 py-3 text-gray-800">{{ $item['satuan'] ?? 'unit' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-10"><div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3"><i class="fas fa-box-open text-gray-400 text-3xl"></i></div><p class="text-gray-500">Belum ada data kebutuhan donasi</p><p class="text-gray-400 text-sm mt-1">Lembaga ini belum menambahkan daftar kebutuhan donasi</p></div>
                @endif
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8 text-center"><div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3"><i class="fas fa-inbox text-gray-400 text-3xl"></i></div><p class="text-gray-500 text-lg">Belum ada informasi lengkap</p><p class="text-gray-400 text-sm mt-1">Lembaga ini belum mengisi informasi donasi dan anak asuh</p></div>
        @endif
    </div>

    <footer class="bg-gray-900 text-gray-400 py-8 mt-8"><div class="container mx-auto px-6 text-center"><div class="flex justify-center gap-6 mb-4"><a href="#" class="hover:text-white transition"><i class="fab fa-facebook-f"></i></a><a href="#" class="hover:text-white transition"><i class="fab fa-instagram"></i></a><a href="#" class="hover:text-white transition"><i class="fab fa-twitter"></i></a><a href="#" class="hover:text-white transition"><i class="fab fa-youtube"></i></a></div><p>&copy; {{ date('Y') }} SISOREL - Sistem Informasi Kegiatan Sosial dan Relawan</p><p class="text-sm mt-2">Membangun kebaikan bersama, satu langkah pada satu waktu</p></div></footer>
</body>
</html>