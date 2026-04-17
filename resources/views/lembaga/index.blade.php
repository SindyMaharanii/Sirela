<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-black">Profil Lembaga Saya</h2>
            <p class="text-gray-600">Kelola profil lembaga Anda di sini</p>
        </div>
        @if($lembaga->isEmpty())
            <a href="{{ route('lembaga.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Buat Profil Lembaga
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($lembaga->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
            <p>Anda belum memiliki profil lembaga. Silakan buat profil terlebih dahulu.</p>
        </div>
    @else
        @foreach($lembaga as $item)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $item->nama_lembaga }}</h3>
                    <a href="{{ route('lembaga.edit', $item->lembaga_id) }}" 
   style="background-color: #eab308 !important; color: white !important; padding: 6px 12px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-flex !important; align-items: center !important; gap: 5px !important; font-size: 14px !important;">
    <svg style="width: 14px; height: 14px; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
    Edit
</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-600"><span class="font-semibold">📍 Lokasi:</span> {{ $item->lokasi ?? $item->alamat ?? '-' }}</p>
                        <p class="text-gray-600"><span class="font-semibold">📞 Kontak:</span> {{ $item->kontak ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600"><span class="font-semibold">🏷️ Kategori:</span>
                            @foreach($item->kategori as $kat)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1">{{ $kat->nama_kategori }}</span>
                            @endforeach
                        </p>
                    </div>
                </div>

                @if($item->visi)
                <div class="mb-3">
                    <p class="font-semibold text-gray-700">Visi:</p>
                    <p class="text-gray-600">{{ $item->visi }}</p>
                </div>
                @endif

                @if($item->misi)
                <div class="mb-3">
                    <p class="font-semibold text-gray-700">Misi:</p>
                    <p class="text-gray-600">{{ $item->misi }}</p>
                </div>
                @endif

                @if($item->deskripsi)
                <div class="mb-3">
                    <p class="font-semibold text-gray-700">Deskripsi:</p>
                    <p class="text-gray-600">{{ $item->deskripsi }}</p>
                </div>
                @endif

                <div class="border-t pt-4 mt-4">
    <div class="flex justify-between items-center">
        <p class="text-sm text-gray-500">Terdaftar sejak: {{ $item->created_at->format('d M Y') }}</p>
        <a href="{{ route('informasi.index') }}" 
           style="background-color: #2563eb !important; color: white !important; padding: 8px 16px !important; border-radius: 8px !important; text-decoration: none !important; display: inline-flex !important; align-items: center !important; gap: 8px !important; font-size: 13px !important; font-weight: 500 !important;">
            <svg style="width: 14px; height: 14px; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Kelola Informasi Donasi →
        </a>
    </div>
</div>
            </div>
        </div>
        @endforeach
    @endif
</div>
</x-app-layout>