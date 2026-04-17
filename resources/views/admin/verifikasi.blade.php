<x-app-layout>
<div class="p-6">

    <h2 class="text-2xl font-bold text-black mb-6">
        <i class="fas fa-user-check mr-2"></i>
        Verifikasi Akun Lembaga
    </h2>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-black p-4 mb-4 rounded">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100" style="background: #2563eb !important;">
    <th class="p-3 border text-left" style="color: white !important;">Email</th>
    <th class="p-3 border text-left" style="color: white !important;">Status</th>
    <th class="p-3 border text-center" style="color: white !important;">Aksi</th>
</tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3 border text-black">
                        <i class="fas fa-envelope mr-2 text-gray-500"></i>
                        {{ $user->email }}
                    </td>
                    <td class="p-3 border">
                        @if($user->status_akun == 'aktif')
                            <span class="text-green-600 font-semibold">
                                <i class="fas fa-check-circle"></i> Aktif
                            </span>
                        @else
                            <span class="text-red-600 font-semibold">
                                <i class="fas fa-times-circle"></i> Nonaktif
                            </span>
                        @endif
                    </td>
                    <td class="p-3 border text-center">
                        <form action="{{ route('verifikasi.toggle', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            @if($user->status_akun == 'nonaktif')
                                <button type="submit" class="action-btn btn-edit" title="Aktifkan">
                                    <i class="fas fa-check-circle"></i> Aktifkan
                                </button>
                            @else
                                <button type="submit" class="action-btn btn-delete" title="Nonaktifkan">
                                    <i class="fas fa-ban"></i> Nonaktifkan
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</x-app-layout>