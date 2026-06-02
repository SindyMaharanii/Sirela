@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-5">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">Menunggu Verifikasi</h1>
                    <p class="text-amber-100 text-sm">Akun Anda belum diaktifkan oleh administrator</p>
                </div>
            </div>
        </div>

        <div class="p-8 text-center">
            <div class="w-24 h-24 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-hourglass-half text-amber-500 text-5xl"></i>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-3">Akun Belum Diverifikasi</h2>
            
            <p class="text-gray-600 mb-4 max-w-md mx-auto">
                Akun Anda masih menunggu verifikasi dari administrator. 
                Silakan tunggu proses verifikasi.
            </p>

            <div class="bg-blue-50 rounded-xl p-5 mb-6 max-w-sm mx-auto text-left">
                <p class="font-semibold text-blue-800 mb-3">📌 Fitur setelah verifikasi:</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-green-500 text-xs"></i> Membuat / Mengedit Profil Lembaga</li>
                    <li><i class="fas fa-check-circle text-green-500 text-xs"></i> Mengelola Informasi Donasi & Anak Asuh</li>
                    <li><i class="fas fa-check-circle text-green-500 text-xs"></i> Melihat dan Mengkonfirmasi Donasi</li>
                </ul>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-8 py-3 rounded-xl font-semibold shadow-md inline-flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
            <p class="text-xs text-gray-400 mt-4">Hubungi admin: admin@sisorel.com</p>
        </div>
    </div>
</div>
@endsection