<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height">
    <title>Login - SIRELA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #0f2b5c 0%, #1e3a8a 50%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 2rem;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-5 pt-5 pb-6">
            <a href="/" class="inline-flex items-center gap-1.5 text-white/70 hover:text-white mb-4 text-xs">
                <i class="fas fa-arrow-left text-xs"></i> Kembali
            </a>
            
            <div class="flex items-center justify-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <span class="text-white text-xl font-bold">S</span>
                </div>
                <div class="text-left">
                    <h1 class="text-lg font-bold text-white">SIRELA</h1>
                    <p class="text-blue-100 text-[11px]">Sistem Informasi Sosial</p>
                </div>
            </div>
        </div>

        <div class="bg-white px-5 pb-6 pt-5">
            <div class="text-center mb-5">
                <h2 class="text-xl font-bold text-gray-800">Login</h2>
                <p class="text-gray-400 text-xs mt-1">Masuk ke akun SISOREL Anda</p>
                <div class="h-0.5 w-12 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full mx-auto mt-2"></div>
            </div>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        <i class="fas fa-envelope text-blue-400 mr-1.5 text-xs"></i>Email
                    </label>
                    <input type="email" name="email" required 
                        class="form-input w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:border-blue-400 transition text-sm bg-gray-50 hover:bg-white focus:bg-white"
                        placeholder="email@anda.com">
                </div>

                <div class="mb-3">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        <i class="fas fa-lock text-blue-400 mr-1.5 text-xs"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                            class="form-input w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:border-blue-400 transition pr-9 text-sm bg-gray-50 hover:bg-white focus:bg-white"
                            placeholder="Masukkan password">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <i class="fas fa-eye-slash text-gray-400 hover:text-blue-500 transition text-xs"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center gap-1.5">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-500 focus:ring-blue-400 w-3.5 h-3.5">
                        <span class="text-xs text-gray-500">Ingat saya</span>
                    </label>
                    <a href="#" class="text-xs text-blue-500 hover:text-blue-600 hover:underline">Lupa password?</a>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white py-2.5 rounded-xl font-semibold transition shadow-md text-sm">
                    <i class="fas fa-sign-in-alt mr-1.5 text-xs"></i> Login
                </button>

                <p class="text-center text-xs text-gray-400 mt-4">
                    Belum punya akun? 
                    <a href="<?php echo e(route('register')); ?>" class="text-blue-500 font-semibold hover:text-blue-600 hover:underline">Daftar disini</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        if(togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    icon.style.color = '#3b82f6';
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    icon.style.color = '#9ca3af';
                }
            });
        }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Sirela\resources\views/auth/login.blade.php ENDPATH**/ ?>