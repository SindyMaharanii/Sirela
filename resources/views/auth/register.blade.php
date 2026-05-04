<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SISOREL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #0f2b5c, #1e3a8a, #2563eb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 16px;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            width: 340px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body>

<div class="login-card overflow-hidden">
    <!-- Header compact -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 py-2 text-center">
        <div class="inline-flex items-center justify-center gap-1">
            <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-circle text-white text-sm"></i>
            </div>
            <h2 class="text-white text-base font-semibold">Login</h2>
        </div>
    </div>

    <div class="p-5">
        @if($errors->any())
            <div class="mb-3 text-xs text-red-600 bg-red-50 p-2 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-2">
                <label class="block text-gray-700 text-xs font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-2">
                <label class="block text-gray-700 text-xs font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex items-center justify-between mb-3 text-xs">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-1 w-3 h-3">
                    <span class="text-gray-600">Ingat saya</span>
                </label>
                <a href="#" class="text-blue-600 hover:underline">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-1.5 rounded-lg font-semibold text-sm hover:from-blue-700 hover:to-indigo-700 transition">
                Login
            </button>

            <div class="text-center mt-3 pt-2 border-t">
                <p class="text-xs text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold">Daftar</a>
                </p>
            </div>
        </form>
    </div>
</div>

<script>
    // Optional: tambahkan toggle password jika mau
</script>
</body>
</html>