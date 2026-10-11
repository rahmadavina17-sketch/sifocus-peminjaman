<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SiFokus</title>
    <!-- Tailwind CSS v4 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Mematikan ikon mata/reveal bawaan dari browser */
        input::-ms-reveal,
        input::-ms-clear {
            display: none !important;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
        
        <!-- Header / Logo Sesuai Tema Aplikasi -->
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 bg-[#3038b7] rounded-xl flex items-center justify-center text-white shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-900 tracking-tight">SiFokus</h1>
                <p class="text-xs text-gray-500">Sistem Peminjaman Proyektor</p>
            </div>
        </div>

        <h2 class="text-lg font-semibold text-gray-800 mb-4">Silakan Masuk ke Akun Anda</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Error Validation Notification -->
        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" autocomplete="off" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="off"
                    class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3038b7] focus:border-transparent transition"
                    placeholder="nama@email.com">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-medium mb-1.5">Password</label>
                <div class="relative">
                    <input id="login_password" type="password" name="password" required autocomplete="new-password" value=""
                        class="w-full px-4 py-2.5 pr-10 bg-white border border-gray-300 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3038b7] focus:border-transparent transition"
                        placeholder="••••••••">
                    
                    <!-- Tombol Kustom Show/Hide Password (Default: Mata Tercoret) -->
                    <button type="button" onclick="togglePassword('login_password', 'icon_login')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg id="icon_login" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#3038b7] focus:ring-[#3038b7]">
                    <span class="ml-2">Ingat Saya</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-[#3038b7] hover:bg-[#252c96] text-white font-medium py-2.5 px-4 rounded-xl shadow-sm transition duration-200 cursor-pointer">
                    Masuk
                </button>
            </div>
        </form>

        <!-- Footer / Link Register -->
        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-[#3038b7] hover:underline font-medium">
                Daftar di sini
            </a>
        </p>

    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            
            if (input.type === "password") {
                input.type = "text";
                // Ikon Mata Normal (Tanpa Garis) saat terbuka
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            } else {
                input.type = "password";
                // Ikon Mata Tercoret saat tertutup
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            }
        }
    </script>
</body>
</html>