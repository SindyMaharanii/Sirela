<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SISOREL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-6">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-5 py-3 text-center">
                    <h1 class="text-xl font-bold text-white">SISOREL</h1>
                    <p class="text-blue-100 text-xs">Sistem Informasi Sosial & Relawan</p>
                </div>
                
                <div class="p-5">
                    <h2 class="text-lg font-bold text-gray-800 text-center">Daftar Akun</h2>
                    <p class="text-gray-500 text-center text-xs mb-3">Buat akun baru untuk bergabung</p>

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-1.5 rounded mb-3 text-xs">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-2">
                            <label for="name" class="block text-gray-700 font-semibold text-xs mb-1">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-2">
                            <label for="email" class="block text-gray-700 font-semibold text-xs mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-2">
                            <label for="password" class="block text-gray-700 font-semibold text-xs mb-1">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-8">
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="block text-gray-700 font-semibold text-xs mb-1">Konfirmasi Password</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-8">
                                <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 rounded-lg transition text-sm">
                            Daftar
                        </button>

                        <div class="text-center mt-3 pt-2 border-t">
                            <p class="text-xs text-gray-600">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold ml-1">
                                    Login Sekarang
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        if(togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                const svg = this.querySelector('svg');
                svg.style.color = type === 'text' ? '#2563eb' : '#9ca3af';
            });
        }
        
        const toggleConfirm = document.getElementById('toggleConfirmPassword');
        const confirmInput = document.getElementById('password_confirmation');
        if(toggleConfirm) {
            toggleConfirm.addEventListener('click', function() {
                const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmInput.setAttribute('type', type);
                const svg = this.querySelector('svg');
                svg.style.color = type === 'text' ? '#2563eb' : '#9ca3af';
            });
        }
    </script>
</body>
</html>