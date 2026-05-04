@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-t-xl px-6 py-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-edit text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Edit Kategori</h2>
                <p class="text-yellow-100 text-sm">Edit nama kategori lembaga sosial</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('kategori.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-4 py-2 rounded-lg transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection