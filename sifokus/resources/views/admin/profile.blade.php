<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Profil Admin - SiFokus</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS & Alpine.js via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-screen">
    <div class="py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">
        
        <!-- Header Atas: Tombol Kembali & Logo -->
        <div class="flex items-center justify-between pb-2">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>

            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-indigo-700 flex items-center justify-center text-white shadow-sm font-bold text-sm">
                    🎥
                </div>
                <span class="font-bold text-gray-900 text-lg">SiFokus</span>
            </div>
        </div>

        <!-- Judul Halaman -->
        <div class="mb-6 px-4 sm:px-0">
            <h2 class="text-xl font-bold text-gray-900 leading-tight">Profil Admin</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola informasi akun, kata sandi, dan preferensi akun administrator Anda.</p>
        </div>

        @if(session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md text-sm shadow-sm">
                Profil berhasil diperbarui.
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md text-sm shadow-sm">
                Kata sandi berhasil diperbarui.
            </div>
        @endif

        <!-- 1. Form Update Informasi Profil -->
        <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-200 rounded-xl">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h3 class="text-lg font-medium text-gray-900">Informasi Profil</h3>
                        <p class="mt-1 text-sm text-gray-600">Perbarui nama akun dan alamat email administrator Anda.</p>
                    </header>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input id="name" name="name" type="text" class="mt-1 block w-full bg-white border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm font-semibold text-gray-900 px-3 py-2" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email" class="mt-1 block w-full bg-white border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm font-semibold text-gray-900 px-3 py-2" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-800 transition">Simpan</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!-- 2. Form Perbarui Kata Sandi -->
        <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-200 rounded-xl">
            <div class="max-w-xl">
                <section>

                        <!-- 2. Form Perbarui Kata Sandi -->
                        <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-200 sm:rounded-lg">
                            <div class="max-w-xl">
                                <section>
                                    <header>
                                        <h3 class="text-lg font-medium text-gray-900">Perbarui Kata Sandi</h3>
                                        <p class="mt-1 text-sm text-gray-600">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                                    </header>

                                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                        @csrf
                                        @method('put')

                                        <!-- Kata Sandi Saat Ini -->
                                        <div x-data="{ show: false }">
                                            <label for="current_password" class="block text-sm font-medium text-gray-700">Kata Sandi Saat Ini</label>
                                            <div class="relative mt-1">
                                                <input :type="show ? 'text' : 'password'" id="current_password" name="current_password" class="block w-full px-3 py-2 pr-10 bg-white border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm font-semibold text-gray-900 [&::-ms-reveal]:hidden [&::-ms-clear]:hidden" autocomplete="current-password">
                                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                                    <!-- Tampil Mata Tercoret saat sandi tersembunyi (titik-titik) -->
                                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                    <!-- Tampil Mata Terbuka saat sandi terlihat (teks) -->
                                                    <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </button>
                                            </div>
                                            @error('current_password', 'updatePassword')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Kata Sandi Baru -->
                                        <div x-data="{ show: false }">
                                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                                            <div class="relative mt-1">
                                                <input :type="show ? 'text' : 'password'" id="password" name="password" class="block w-full px-3 py-2 pr-10 bg-white border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm font-semibold text-gray-900 [&::-ms-reveal]:hidden [&::-ms-clear]:hidden" autocomplete="new-password">
                                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                                    <!-- Tampil Mata Tercoret saat sandi tersembunyi (titik-titik) -->
                                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                    <!-- Tampil Mata Terbuka saat sandi terlihat (teks) -->
                                                    <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </button>
                                            </div>
                                            @error('password', 'updatePassword')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Konfirmasi Kata Sandi Baru -->
                                        <div x-data="{ show: false }">
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi Baru</label>
                                            <div class="relative mt-1">
                                                <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" class="block w-full px-3 py-2 pr-10 bg-white border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm font-semibold text-gray-900 [&::-ms-reveal]:hidden [&::-ms-clear]:hidden" autocomplete="new-password">
                                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                                    <!-- Tampil Mata Tercoret saat sandi tersembunyi (titik-titik) -->
                                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                    <!-- Tampil Mata Terbuka saat sandi terlihat (teks) -->
                                                    <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </button>
                                            </div>
                                            @error('password_confirmation', 'updatePassword')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-800 transition">Simpan</button>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>

        <!-- 3. Hapus Akun -->
        <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-200 rounded-xl" x-data="{ confirmingUserDeletion: false }">
            <div class="max-w-xl">
                <section class="space-y-6">
                    <header>
                        <h3 class="text-lg font-medium text-gray-900">Hapus Akun</h3>
                        <p class="mt-1 text-sm text-gray-600">Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen.</p>
                    </header>

                    <button @click="confirmingUserDeletion = true" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 transition">Hapus Akun</button>

                    <div x-show="confirmingUserDeletion" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center">
                        <div x-show="confirmingUserDeletion" class="fixed inset-0 transform transition-all" @click="confirmingUserDeletion = false">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div x-show="confirmingUserDeletion" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6 z-10" x-data="{ showDelPass: false }">
                            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    Apakah Anda yakin ingin menghapus akun Anda?
                                </h2>

                                <p class="text-sm text-gray-600">
                                    Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengonfirmasi.
                                </p>

                                <div>
                                    <label for="password_delete" class="sr-only">Kata Sandi</label>
                                    <div class="relative mt-1">
                                        <input :type="showDelPass ? 'text' : 'password'" id="password_delete" name="password" class="block w-full px-3 py-2 pr-10 bg-white border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm font-semibold text-gray-900 [&::-ms-reveal]:hidden [&::-ms-clear]:hidden" placeholder="Kata Sandi">
                                        <button type="button" @click="showDelPass = !showDelPass" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                            <svg x-show="!showDelPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <svg x-show="showDelPass" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                        </button>
                                    </div>
                                    @error('password', 'userDeletion')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end gap-3">
                                    <button type="button" @click="confirmingUserDeletion = false" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">Batal</button>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 transition">Hapus Akun</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
</body>
</html>