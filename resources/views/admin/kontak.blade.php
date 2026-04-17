<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black">📬 Pesan dari Lembaga</h2>
        @if(isset($unreadCount) && $unreadCount > 0)
            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">{{ $unreadCount }} pesan baru</span>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($kontak as $item)
        <div class="bg-white rounded-xl shadow overflow-hidden {{ $item->is_read == false && $item->status == 'pending' ? 'border-l-4 border-yellow-500' : '' }}">
            <div class="bg-gray-50 px-4 py-3 border-b">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="font-semibold text-gray-800">{{ $item->user->name ?? '-' }}</span>
                        <span class="text-sm text-gray-500 ml-2">({{ $item->user->email ?? '-' }})</span>
                        <span class="text-xs text-gray-400 ml-2">{{ $item->created_at->format('d M Y H:i') }}</span>
                    </div>
                    @if($item->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">⏳ Belum Dibalas</span>
                    @else
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">✓ Sudah Dibalas</span>
                    @endif
                </div>
            </div>
            
            <div class="p-4">
                <p class="text-gray-700">{{ $item->message }}</p>
                
                @if($item->reply)
                <div class="mt-3 pt-3 border-t border-blue-100">
                    <div class="bg-blue-50 rounded-lg p-3">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-blue-500 text-sm">📨 Balasan Admin:</span>
                        </div>
                        <p class="text-gray-700">{{ $item->reply }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($item->replied_at)->format('d M Y H:i') }}</p>
                    </div>
                </div>
                @endif

                @if(!$item->reply)
                <div class="mt-3 pt-3 border-t">
                    <form action="{{ route('admin.kontak.reply', $item->id) }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap gap-2">
                            <input type="text" name="reply" placeholder="Tulis balasan..." 
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                Kirim
                            </button>
                            <button type="button" onclick="confirmDelete({{ $item->id }})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm">
                                Hapus
                            </button>
                        </div>
                    </form>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.kontak.destroy', $item->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                @else
                <div class="mt-3 flex justify-end">
                    <button type="button" onclick="confirmDelete({{ $item->id }})" class="text-red-500 hover:text-red-700 text-sm">🗑️ Hapus</button>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.kontak.destroy', $item->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow p-8 text-center">
            <span class="text-5xl">📭</span>
            <p class="text-gray-500 mt-3">Belum ada pesan dari lembaga</p>
        </div>
        @endforelse
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Yakin ingin menghapus pesan ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
</x-app-layout>