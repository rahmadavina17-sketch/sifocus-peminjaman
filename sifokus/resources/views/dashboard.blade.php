<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <!-- Logo Sederhana / Ikon Proyektor -->
            <div class="bg-indigo-600 text-white p-2 rounded-lg font-bold text-lg shadow">
                🎥 SiFokus
            </div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard SiFokus
                </h2>
                <p class="text-xs text-gray-500">Sistem Informasi Peminjaman Proyektor Kelas</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Kartu Sambutan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 border-l-4 border-indigo-500">
                <h3 class="text-lg font-bold text-gray-800">Selamat datang, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-sm text-gray-600 mt-1">Kamu telah berhasil masuk ke dalam sistem SiFokus. Silakan gunakan aplikasi ini untuk peminjaman proyektor dengan tertib.</p>
            </div>

            <!-- Kartu Alur / Cara Kerja Peminjaman -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-md font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span>📌</span> Alur & Cara Kerja Peminjaman Proyektor
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Langkah 1 -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-indigo-600 font-bold text-lg mb-1">01</div>
                        <h4 class="font-semibold text-gray-700 text-sm">menu data peminjaman</h4>
                        <p class="text-xs text-gray-500 mt-1">buka menu data peminjaman pada navigasi atas.</p>
                    </div>

                    <!-- Langkah 2 -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-indigo-600 font-bold text-lg mb-1">02</div>
                        <h4 class="font-semibold text-gray-700 text-sm">klik ajukan peminjaman</h4>
                        <p class="text-xs text-gray-500 mt-1">siswa bisa mengklik bagian tombol + ajukan peminjaman yang ada di dalam halaman data peminjaman.</p>
                    </div>

                    <!-- Langkah 3 -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-indigo-600 font-bold text-lg mb-1">03</div>
                        <h4 class="font-semibold text-gray-700 text-sm">isi form peminjaman</h4>
                        <p class="text-xs text-gray-500 mt-1">setelah klik tombol + ajukan peminjaman kita di arahkan ke form yang berisi nama,kelas,unit proyrktor,foto kartu pelajar yang harus kita isi.selesai isi form data akan masuk ke tabel yang ada di menu data peminjaman.</p>
                    </div>

                    <!-- Langkah 4 -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="text-indigo-600 font-bold text-lg mb-1">04</div>
                        <h4 class="font-semibold text-gray-700 text-sm">Pengembalian</h4>
                        <p class="text-xs text-gray-500 mt-1">Kembalikan unit proyektor tinggal mengklik tombol selesai yang ada di tabel bagian aksi.</p>
                    </div>
                </div>
            </div>

            <!-- Alur & Cara Kerja Laporan Kendala Proyektor (Baru) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span>📌</span> Alur & Cara Kerja Laporan Kendala Proyektor
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Langkah 1 -->
                    <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50">
                        <span class="text-xl font-bold text-indigo-600">01</span>
                        <h4 class="font-semibold text-gray-800 mt-2">menu lapor kendala</h4>
                        <p class="text-sm text-gray-600 mt-1">buka menu lapor kendala pada navigasi atas.</p>
                    </div>
                    <!-- Langkah 2 -->
                    <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50">
                        <span class="text-xl font-bold text-indigo-600">02</span>
                        <h4 class="font-semibold text-gray-800 mt-2">isi form</h4>
                        <p class="text-sm text-gray-600 mt-1">di halaman lapor kendala siswa bisa mengisi langsung form yang berisi nama pelapor,kelas,unit proyektor yang rusak,dan deskripsi kendala yang terjadi pada proyektor.klik tombol kirim laporan juga form sudah di isi.</p>
                    </div>
                    <!-- Langkah 3 -->
                    <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/50">
                        <span class="text-xl font-bold text-indigo-600">03</span>
                        <h4 class="font-semibold text-gray-800 mt-2">tindak lanjut</h4>
                        <p class="text-sm text-gray-600 mt-1">selesai kirim lapor kendala nanti di bagian tabel akan muncul laporan kendala yang sudah kamu buat,tinggal menunggu respon dari admin agar tulisan panding yang ada di status menjadi selesai.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>