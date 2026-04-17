<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold text-gray-800 mb-4">
Tambah Lembaga
</h2>

<form action="{{ route('lembaga.store') }}" method="POST">

@csrf

<label class="block mb-2">Nama Lembaga</label>
<input type="text" name="nama_lembaga" class="border p-2 w-full rounded">

<br>

<label class="block mb-2">Alamat</label>
<textarea name="alamat" class="border p-2 w-full rounded"></textarea>

<br>

<label class="block mb-2">Kontak</label>
<input type="text" name="kontak" class="border p-2 w-full rounded">

<br>

<label class="block mb-2">Kategori</label>

@foreach($kategori as $k)
<div>
<input type="checkbox" name="kategori_id[]" value="{{ $k->kategori_id }}">
{{ $k->nama_kategori }}
</div>
@endforeach

<br>

<button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
Simpan
</button>

</form>

</div>

</x-app-layout>