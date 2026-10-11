<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Profil - SiFokus</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎥</text></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            
            <!-- Tombol Kembali ke Dashboard & Logo Sederhana -->
            <div class="sm:mx-auto sm:w-full sm:max-w-xl mb-6 flex items-center justify-between px-4 sm:px-0">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
                <div class="font-bold text-gray-800 flex items-center gap-2">
                    <span class="bg-indigo-600 text-white p-1.5 rounded-xl text-sm">🎥</span> SiFokus
                </div>
            </div>

            <!-- Konten Halaman Profil (Bersih tanpa navigasi atas) -->
            <div class="sm:mx-auto sm:w-full sm:max-w-xl">
                <div class="bg-white py-8 px-4 shadow-xl sm:rounded-2xl sm:px-10 border border-gray-100 space-y-6">
                    
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Pengaturan Profil & Akun</h2>
                        <p class="text-sm text-gray-500 mt-1">Perbarui informasi profil, ubah kata sandi, atau hapus akun Anda di sini.</p>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Bagian 1: Informasi Profil -->
                    <div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <hr class="border-gray-100">

                    <!-- Bagian 2: Perbarui Password -->
                    <div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <hr class="border-gray-100">

                    <!-- Bagian 3: Hapus Akun -->
                    <div>
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>

        </div>
    </body>
</html>