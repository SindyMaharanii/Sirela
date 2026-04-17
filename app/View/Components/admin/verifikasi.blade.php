<x-app-layout>

<div class="p-6">

<h2 class="text-xl font-bold mb-4">Verifikasi Akun Lembaga</h2>

<table class="w-full border">

<tr class="bg-gray-200">
    <th class="p-2">Nama</th>
    <th class="p-2">Email</th>
    <th class="p-2">Status</th>
    <th class="p-2">Aksi</th>
</tr>

@foreach($users as $u)

<tr>
    <td class="p-2">{{ $u->name }}</td>
    <td class="p-2">{{ $u->email }}</td>
    <td class="p-2">{{ $u->status_akun }}</td>

    <td class="p-2">
        <form action="{{ route('verifikasi.update', $u->id) }}" method="POST">
            @csrf
            <button class="bg-blue-500 text-white px-3 py-1 rounded">
                Ubah Status
            </button>
        </form>
    </td>
</tr>

@endforeach

</table>

</div>

</x-app-layout>