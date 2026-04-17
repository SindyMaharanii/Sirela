<x-app-layout>
<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
        <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card Total Lembaga -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Total Lembaga</p>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Lembaga::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Card Lembaga Aktif -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Lembaga Aktif</p>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\User::where('role', 'lembaga')->where('status_akun', 'aktif')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Card Total Kategori -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Total Kategori</p>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Kategori::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Menu Cepat -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Menu Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('verifikasi') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <span class="text-blue-600 mr-3">✓</span>
                    <span>Verifikasi Akun Lembaga</span>
                </a>
                <a href="{{ route('kategori.index') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <span class="text-blue-600 mr-3">🏷️</span>
                    <span>Kelola Kategori Lembaga</span>
                </a>
                <a href="{{ route('lembaga.index') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <span class="text-blue-600 mr-3">🏢</span>
                    <span>Lihat Semua Lembaga</span>
                </a>
            </div>
        </div>

        <!-- Lembaga Terbaru -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Lembaga Terbaru</h3>
            <div class="space-y-3">
                @foreach(\App\Models\Lembaga::with('user')->latest()->limit(5)->get() as $lembaga)
                <div class="flex justify-between items-center p-2 border-b">
                    <div>
                        <p class="font-medium text-gray-800">{{ $lembaga->nama_lembaga }}</p>
                        <p class="text-sm text-gray-500">{{ $lembaga->user->email ?? '-' }}</p>
                    </div>
                    <span class="text-xs {{ $lembaga->user && $lembaga->user->status_akun == 'aktif' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $lembaga->user && $lembaga->user->status_akun == 'aktif' ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</x-app-layout>