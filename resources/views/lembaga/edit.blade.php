<x-app-layout>
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Edit Profil Lembaga</h2>
                    <p class="text-blue-100 text-sm">Perbarui informasi profil lembaga Anda</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-b-xl shadow-lg p-6">
            <form action="{{ route('lembaga.update', $lembaga->lembaga_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lembaga</label>
                    <input type="text" name="nama_lembaga" value="{{ $lembaga->nama_lembaga }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                    <textarea name="alamat" rows="2" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $lembaga->alamat }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ $lembaga->lokasi }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Jakarta, Bandung, Surabaya">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Kontak</label>
                    <input type="text" name="kontak" value="{{ $lembaga->kontak }}" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nomor telepon / WhatsApp">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Visi</label>
                    <textarea name="visi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $lembaga->visi }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Misi</label>
                    <textarea name="misi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $lembaga->misi }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $lembaga->deskripsi }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 p-3 bg-gray-50 rounded-lg">
                        @foreach($kategori as $k)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kategori_id[]" value="{{ $k->kategori_id }}" 
                                   @if($lembaga->kategori->contains($k->kategori_id)) checked @endif
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">{{ $k->nama_kategori }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('lembaga.index') }}" 
                       style="background-color: #6b7280 !important; color: white !important; padding: 8px 20px !important; border-radius: 8px !important; text-decoration: none !important;">
                        Batal
                    </a>
                    <button type="submit" 
                            style="background-color: #2563eb !important; color: white !important; font-weight: 500 !important; padding: 8px 20px !important; border-radius: 8px !important; border: none !important; cursor: pointer !important;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>