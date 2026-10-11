<style>
    /* Mematikan ikon mata/reveal bawaan dari browser */
    input::-ms-reveal,
    input::-ms-clear {
        display: none !important;
    }
</style>

<section class="space-y-6 bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-gray-100">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Kata Sandi Saat Ini -->
        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-700">Kata Sandi Saat Ini</label>
            <div class="relative mt-1">
                <input id="update_password_current_password" name="current_password" type="password" class="block w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 pr-10 border" autocomplete="current-password" />
                <button type="button" onclick="togglePassword('update_password_current_password', 'icon_current')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                    <!-- Default: Mata Tercoret -->
                    <svg id="icon_current" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @if($errors->updatePassword->get('current_password'))
                <p class="text-sm text-red-600 mt-2">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <!-- Kata Sandi Baru -->
        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-700">Kata Sandi Baru</label>
            <div class="relative mt-1">
                <input id="update_password_password" name="password" type="password" class="block w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 pr-10 border" autocomplete="new-password" />
                <button type="button" onclick="togglePassword('update_password_password', 'icon_new')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                    <!-- Default: Mata Tercoret -->
                    <svg id="icon_new" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @if($errors->updatePassword->get('password'))
                <p class="text-sm text-red-600 mt-2">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Kata Sandi</label>
            <div class="relative mt-1">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 pr-10 border" autocomplete="new-password" />
                <button type="button" onclick="togglePassword('update_password_password_confirmation', 'icon_confirm')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                    <!-- Default: Mata Tercoret -->
                    <svg id="icon_confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @if($errors->updatePassword->get('password_confirmation'))
                <p class="text-sm text-red-600 mt-2">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl text-sm font-medium shadow-md transition">Simpan</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium">Tersimpan.</p>
            @endif
        </div>
    </form>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            
            if (input.type === "password") {
                // Saat sandi dibuka (jadi text) -> Ubah jadi Mata Normal (Tanpa Garis)
                input.type = "text";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            } else {
                // Saat sandi ditutup/disembunyikan -> Ubah jadi Mata Tercoret (Ada Garisnya)
                input.type = "password";
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            }
        }

        // Skrip otomatis untuk membuang ikon duplikat yang menumpuk di tombol
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('form[action*="password"] button[type="button"]').forEach(button => {
                const svgs = button.querySelectorAll('svg');
                if (svgs.length > 1) {
                    for (let i = 1; i < svgs.length; i++) {
                        svgs[i].remove();
                    }
                }
            });
        });
    </script>
</section>