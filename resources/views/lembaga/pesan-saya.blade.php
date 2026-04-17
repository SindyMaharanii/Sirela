<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black">📬 Pesan Saya</h2>
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

    <!-- Kirim Pesan -->
    <div class="bg-white rounded-xl shadow mb-6 p-4">
        <h3 class="font-semibold text-gray-700 mb-3">✏️ Kirim Pesan ke Admin</h3>
        <form action="{{ route('lembaga.kontak.store') }}" method="POST">
            @csrf
            <textarea name="message" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis pesan Anda..."></textarea>
            <div class="flex justify-end mt-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Kirim</button>
            </div>
        </form>
    </div>

    <!-- Riwayat Pesan -->
    <div class="space-y-3">
        <h3 class="font-semibold text-gray-700">📋 Riwayat Pesan</h3>
        
        @forelse($messages as $message)
        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs text-gray-400">{{ $message->created_at->format('d M Y H:i') }}</span>
                @if($message->status == 'pending')
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-0.5 rounded-full">⏳ Menunggu</span>
                @else
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">✓ Dibalas</span>
                @endif
            </div>
            <p class="text-gray-700">{{ $message->message }}</p>
            
            @if($message->reply)
            <div class="mt-2 pt-2 border-t">
                <p class="text-sm text-blue-600">📨 Balasan:</p>
                <p class="text-gray-700">{{ $message->reply }}</p>
            </div>
            @endif
        </div>
        @empty
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <span class="text-4xl">📭</span>
            <p class="text-gray-500 mt-2">Belum ada pesan</p>
        </div>
        @endforelse
    </div>
</div>
</x-app-layout>