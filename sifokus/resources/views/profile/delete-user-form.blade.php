<section class="space-y-6 bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-gray-100">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md transition">
        {{ __('Hapus Akun Ini') }}
    </button>

    <div x-data="{ show: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }" 
         x-show="show" 
         @open-modal.window="$event.detail == 'confirm-user-deletion' ? show = true : null" 
         @close.window="show = false" 
         style="display: none;" 
         class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center">
        
        <!-- Background Overlay -->
        <div x-show="show" class="fixed inset-0 transform transition-all" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Modal Box -->
        <div x-show="show" class="bg-white rounded-2xl overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6 z-10" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
            
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Setelah akun dihapus, semua data akan hilang permanen. Harap masukkan kata sandi Anda untuk konfirmasi.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="{{ __('Kata Sandi') }}" />
                    
                    @if($errors->userDeletion->get('password'))
                        <ul class="text-sm text-red-600 space-y-1 mt-2">
                            @foreach((array) $errors->userDeletion->get('password') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="show = false" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium transition">
                        {{ __('Batal') }}
                    </button>

                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md transition">
                        {{ __('Hapus Akun') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>