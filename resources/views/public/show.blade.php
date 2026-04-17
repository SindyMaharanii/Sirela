<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISOREL - Detail Lembaga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-open {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-closed {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <a href="/" class="text-xl font-bold text-gray-800">SISOREL</a>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <div class="max-w-5xl mx-auto px-4 py-8">
            <!-- Tombol Kembali -->
            <a href="/" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                ← Kembali ke Daftar Lembaga
            </a>

            <!-- Card Utama: Profil Lembaga -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                    <div class="flex justify-between items-center flex-wrap gap-3">
                        <h1 class="text-2xl font-bold text-white">{{ $lembaga['nama_lembaga'] }}</h1>
                        @php
                            $statusKolab = '';
                            if(isset($lembaga['informasi']) && isset($lembaga['informasi']['status_kolaborasi'])) {
                                $statusKolab = $lembaga['informasi']['status_kolaborasi'];
                            }
                        @endphp
                        @if($statusKolab == 'dibuka')
                            <span class="status-badge status-open">✓ Dibuka untuk Kolaborasi</span>
                        @elseif($statusKolab == 'ditutup')
                            <span class="status-badge status-closed">✗ Tidak Membuka Kolaborasi</span>
                        @else
                            <span class="status-badge status-closed">✗ Belum Ada Info</span>
                        @endif
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 text-sm">📍 Lokasi</p>
                            <p class="text-gray-800">{{ $lembaga['lokasi'] ?? $lembaga['alamat'] ?? 'Tidak tersedia' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">📞 Kontak</p>
                            <p class="text-gray-800">{{ $lembaga['kontak'] ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-gray-500 text-sm mb-2">🏷️ Kategori Lembaga</p>
                        <div class="flex flex-wrap gap-2">
                            @if(isset($lembaga['kategori']) && count($lembaga['kategori']) > 0)
                                @foreach($lembaga['kategori'] as $kat)
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $kat['nama_kategori'] }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-500 text-sm">Tidak ada kategori</span>
                            @endif
                        </div>
                    </div>

                    @if(isset($lembaga['visi']) && !empty($lembaga['visi']))
                    <div class="mt-4">
                        <p class="text-gray-500 text-sm">🎯 Visi</p>
                        <p class="text-gray-700">{{ $lembaga['visi'] }}</p>
                    </div>
                    @endif
                    
                    @if(isset($lembaga['misi']) && !empty($lembaga['misi']))
                    <div class="mt-4">
                        <p class="text-gray-500 text-sm">📋 Misi</p>
                        <p class="text-gray-700">{{ $lembaga['misi'] }}</p>
                    </div>
                    @endif
                    
                    @if(isset($lembaga['deskripsi']) && !empty($lembaga['deskripsi']))
                    <div class="mt-4">
                        <p class="text-gray-500 text-sm">📝 Deskripsi</p>
                        <p class="text-gray-700">{{ $lembaga['deskripsi'] }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if(isset($lembaga['informasi']) && $lembaga['informasi'])
            @php
                $info = $lembaga['informasi'];
            @endphp
            <!-- Card Informasi Anak Asuh -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h2 class="text-lg font-bold text-gray-800">👶 Data Anak Asuh</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 rounded-lg p-3 text-center">
                            <p class="text-2xl font-bold text-blue-600">{{ $info['jumlah_anak_asuh'] ?? 0 }}</p>
                            <p class="text-gray-600 text-sm">Jumlah Anak Asuh</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-3 text-center">
                            <p class="text-2xl font-bold text-green-600">{{ $info['rentang_usia'] ?? '-' }}</p>
                            <p class="text-gray-600 text-sm">Rentang Usia</p>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-3 text-center">
                            <p class="text-sm font-bold text-purple-600">
                                @php
                                    $tgl = isset($info['tanggal_update']) ? $info['tanggal_update'] : '-';
                                @endphp
                                @if($tgl && $tgl != '-')
                                    {{ date('d M Y', strtotime($tgl)) }}
                                @else
                                    -
                                @endif
                            </p>
                            <p class="text-gray-600 text-sm">Terakhir Update</p>
                        </div>
                    </div>
                    @if(isset($info['profil_anak']) && !empty($info['profil_anak']))
                    <div class="mt-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-sm">📝</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-700 mb-1">Deskripsi / Profil Singkat Anak Asuh</p>
                                <p class="text-gray-600 leading-relaxed">{{ $info['profil_anak'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Card Tabel Kebutuhan Donasi (HEADER BIRU GRADIEN) -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b">
                    <h2 class="text-lg font-bold text-gray-800">📦 Daftar Kebutuhan Donasi</h2>
                </div>
                <div class="p-6">
                    @php
                        $donasiList = [];
                        if(isset($info['kebutuhan_donasi_list']) && !empty($info['kebutuhan_donasi_list'])) {
                            $donasiList = json_decode($info['kebutuhan_donasi_list'], true);
                            if(!is_array($donasiList)) {
                                $donasiList = [];
                            }
                        }
                    @endphp
                    @if(count($donasiList) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                        <th class="border border-gray-300 px-4 py-2 text-left" style="color: white !important;">Nama Kebutuhan</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" style="color: white !important;">Jumlah</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left" style="color: white !important;">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donasiList as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $item['nama'] ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $item['jumlah'] ?? 0 }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $item['satuan'] ?? 'unit' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada data kebutuhan donasi</p>
                    @endif
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6 text-center">
                <p class="text-gray-500">Belum ada informasi lengkap dari lembaga ini.</p>
            </div>
            @endif
        </div>

        <footer class="bg-white border-t py-6 mt-8">
            <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Sistem Informasi Kegiatan Sosial dan Relawan.
            </div>
        </footer>
    </div>
</body>
</html>