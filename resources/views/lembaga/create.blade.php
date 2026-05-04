@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-building text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Buat Profil Lembaga</h2>
                <p class="text-blue-100 text-sm">Lengkapi data lembaga sosial Anda</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('lembaga.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Nama Lembaga <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga') }}" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                    <textarea name="alamat" rows="2" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Lokasi / Kota</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Contoh: Jakarta, Bandung, Surabaya">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Kontak (Telepon/WA)</label>
                    <input type="text" name="kontak" value="{{ old('kontak') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="08123456789">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Visi</label>
                    <textarea name="visi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('visi') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Misi</label>
                    <textarea name="misi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('misi') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi Lembaga</label>
                    <textarea name="deskripsi" rows="3" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Kategori Lembaga</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 p-3 bg-gray-50 rounded-lg">
                        @foreach($kategori as $k)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="kategori_id[]" value="{{ $k->kategori_id }}"
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">{{ $k->nama_kategori }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection