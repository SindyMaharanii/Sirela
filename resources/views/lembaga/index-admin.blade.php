<x-app-layout>
<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-black">🏢 Manajemen Lembaga</h2>
        <p class="text-gray-600">Daftar semua lembaga yang terdaftar di sistem</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <table class="table-custom">
        <thead>
            <tr style="background: #2563eb !important;">
                <th class="text-center" style="color: white !important;">ID</th>
                <th style="color: white !important;">Nama Lembaga</th>
                <th style="color: white !important;">Email</th>
                <th class="text-center" style="color: white !important;">Status</th>
                <th style="color: white !important;">Lokasi</th>
                <th style="color: white !important;">Kontak</th>
                <th class="text-center" style="color: white !important;">Aksi</th>
            </tr
        </thead>
            <tbody>
                @forelse($lembaga as $item)
                <tr>
                    <td class="text-center">{{ $item->lembaga_id }}</td>
                    <td class="font-semibold">{{ $item->nama_lembaga }}</td>
                    <td>{{ $item->user->email ?? '-' }}</td>
                    <td class="text-center">
                        @if($item->user && $item->user->status_akun == 'aktif')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">● Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold">● Nonaktif</span>
                        @endif
                    </td>
                    <td>{{ $item->lokasi ?? '-' }}</td>
                    <td>{{ $item->kontak ?? '-' }}</td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('lembaga.show', $item->lembaga_id) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg transition" 
                               title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <form action="{{ route('lembaga.destroy', $item->lembaga_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus lembaga {{ $item->nama_lembaga }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        Belum ada lembaga terdaftar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>