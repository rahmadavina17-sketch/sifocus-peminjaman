<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register Administrator - SiFokus</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎥</text></svg>">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            /* Mematikan ikon mata/reveal bawaan dari browser */
            input::-ms-reveal,
            input::-ms-clear {
                display: none !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100 min-h-screen flex items-center justify-center p-6 text-gray-800">
        
        <div class="max-w-md w-full bg-white rounded-2xl p-10 shadow-sm border border-gray-200/60">
            
            <!-- Logo & Brand Header -->
            <div class="flex items-center space-x-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg text-gray-900 leading-tight">SiFokus</h1>
                    <p class="text-xs text-gray-500">Sistem Peminjaman Proyektor</p>
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-900 mb-6">Pendaftaran Akun Admin</h2>

            <!-- Form Register -->
            <form method="POST" action="{{ route('register') }}" autocomplete="off" class="space-y-4">
                @csrf

                <!-- Input tersembunyi agar otomatis jadi admin -->
                <input type="hidden" name="role" value="admin">

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="off" class="w-full px-3.5 py-2 rounded-lg border @error('name') border-red-500 @else border-gray-300 @enderror text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-650 transition text-sm" placeholder="Nama Admin">
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="off" class="w-full px-3.5 py-2 rounded-lg border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-650 transition text-sm" placeholder="nama@email.com">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input id="admin_register_password" type="password" name="password" required autocomplete="new-password" value="" class="w-full px-3.5 py-2 pr-10 rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-650 transition text-sm" placeholder="••••••••">
                        
                        <!-- Tombol Kustom Show/Hide Password -->
                        <button type="button" onclick="togglePassword('admin_register_password', 'icon_admin_reg')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="icon_admin_reg" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="admin_register_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" value="" class="w-full px-3.5 py-2 pr-10 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-650 transition text-sm" placeholder="••••••••">
                        
                        <!-- Tombol Kustom Show/Hide Konfirmasi Password -->
                        <button type="button" onclick="togglePassword('admin_register_confirmation', 'icon_admin_conf')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="icon_admin_conf" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition shadow-sm text-sm mt-2">
                    Daftar Sebagai Admin
                </button>
            </form>

            <div class="mt-8 text-center text-xs text-gray-600">
                Sudah punya akun admin? <a href="{{ route('admin.login') }}" class="font-medium text-indigo-600 hover:underline">Masuk di sini</a>
            </div>

        </div>

        <!-- Script Toggle Password -->
        <script>
            function togglePassword(fieldId, iconId) {
                const input = document.getElementById(fieldId);
                const icon = document.getElementById(iconId);
                
                if (input.type === "password") {
                    input.type = "text";
                    // Mata Normal (Tanpa Garis) saat terbuka
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                } else {
                    input.type = "password";
                    // Mata Tercoret saat tertutup
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                }
            }
        </script>
    </body>
</html>