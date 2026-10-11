<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SiFokus - Pilih Peran Masuk</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎥</text></svg>">
        
        <!-- Fonts & Tailwind CSS CDN -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-indigo-900 via-indigo-800 to-slate-900 min-h-screen flex items-center justify-center p-6">
        
        <div class="max-w-md w-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl text-center text-white">
            
            <!-- Logo & Judul -->
            <div class="inline-flex bg-indigo-600 text-white p-4 rounded-2xl text-3xl shadow-lg mb-4">
                🎥
            </div>
            <h1 class="text-2xl font-bold tracking-tight">Selamat Datang di SiFokus</h1>
            <p class="text-indigo-200 text-sm mt-1 mb-8">Sistem Peminjaman Proyektor</p>

            <p class="text-sm font-medium mb-4 text-gray-200">Silakan pilih akses masuk Anda:</p>

            <!-- Tombol Pilihan Peran -->
            <div class="space-y-4">
                <!-- Tombol Pengguna / Siswa -->
                <a href="{{ route('login') }}" class="w-full flex items-center justify-between p-4 bg-white/10 hover:bg-white/20 border border-white/10 rounded-2xl transition group shadow-md">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">👤</span>
                        <div class="text-left">
                            <div class="font-bold text-white">Pengguna / Siswa</div>
                            <div class="text-xs text-indigo-200">Peminjaman & Lapor Kendala</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-indigo-300 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Tombol Admin -->
                <a href="{{ route('admin.login') }}" class="w-full flex items-center justify-between p-4 bg-indigo-600 hover:bg-indigo-500 rounded-2xl transition group shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">🛡️</span>
                        <div class="text-left">
                            <div class="font-bold text-white">Administrator</div>
                            <div class="text-xs text-indigo-200">Kelola Data & kelola kendala</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-white group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="mt-8 text-xs text-indigo-300">
                &copy; {{ date('Y') }} infocus • peminjaman infocus
            </div>
        </div>

    </body>
</html>