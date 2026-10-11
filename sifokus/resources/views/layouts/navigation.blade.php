<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <!-- Baris Utama: Logo & Profil User -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Logo SiFokus -->
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 font-bold text-xl text-gray-800 hover:text-indigo-600 transition">
                    <span class="bg-indigo-600 text-white p-2.5 rounded-2xl text-lg shadow-md flex items-center justify-center">🎥</span>
                    <div>
                        <span class="tracking-wide text-indigo-900 block leading-tight">SiFokus</span>
                        <span class="text-xs font-normal text-gray-500">Sistem Peminjaman Proyektor</span>
                    </div>
                </a>
            </div>

            <!-- Settings Dropdown Manual (Profil di Kanan Atas yang Bisa Diklik) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <!-- Tombol Pemicu Dropdown -->
                    <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 border border-gray-200 text-sm leading-4 font-medium rounded-xl text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <!-- Isi Menu Dropdown -->
                    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-transition.origin.top.right class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none z-50" style="display: none;">

                        <!-- Menu Profil -->
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-medium">
                            Profil
                        </a>
                         <!-- Authentication / Logout -->
                          <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Baris Kedua: Menu Navigasi (Dinamis Admin / User) -->
    <div class="bg-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex space-x-6 py-2.5 text-sm font-medium">
            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-indigo-800 shadow-inner' : 'hover:bg-indigo-800/50' }} transition">
                Dashboard
            </a>
            
            @if(auth()->check() && strtolower(auth()->user()->role) === 'admin')
                <a href="{{ route('admin.peminjaman.index') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('admin.peminjaman.*') ? 'bg-indigo-800 shadow-inner' : 'hover:bg-indigo-800/50' }} transition">
                    Kelola Peminjaman
                </a>
            @else
                <a href="{{ route('peminjaman.index') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('peminjaman.*') ? 'bg-indigo-800 shadow-inner' : 'hover:bg-indigo-800/50' }} transition">
                    Data Peminjaman
                </a>
                
                <!-- Menu Lapor Kendala Khusus User -->
                <a href="{{ url('/laporan') }}" class="px-3 py-1.5 rounded-lg {{ request()->is('laporan*') ? 'bg-indigo-800 shadow-inner' : 'hover:bg-indigo-800/50' }} transition flex items-center gap-1">
                    Lapor Kendala
                </a>
            @endif
        </div>
    </div>
</nav>