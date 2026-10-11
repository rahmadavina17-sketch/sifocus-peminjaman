<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Laporan Kendala Proyektor') }}
                </h2>
                <span class="text-xs text-gray-500">Laporkan masalah atau kerusakan unit proyektor</span>
            </div>
        </div>
    </x-slot>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Notifikasi Sukses dengan SweetAlert2 -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    });
                </script>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Kolom Form Kirim Laporan -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-fit">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Formulir Kendala
                    </h2>

                    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelapor</label>
                            <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm border px-3 py-2" placeholder="Nama lengkap siswa">
                            @error('nama_pelapor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                            <input type="text" name="kelas" value="{{ old('kelas') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm border px-3 py-2" placeholder="Contoh: XI PPLG 1">
                            @error('kelas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit Proyektor</label>
                            <select name="unit_proyektor" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm border px-3 py-2">
                                <option value="" disabled selected>-- Pilih Merek Proyektor --</option>
                                <option value="Epson EB-X450">Epson EB-X450</option>
                                <option value="Epson EB-S400">Epson EB-S400</option>
                                <option value="BenQ MS550">BenQ MS550</option>
                                <option value="Acer X1123H">Acer X1123H</option>
                                <option value="InFocus IN114xx">InFocus IN114xx</option>
                            </select>
                            @error('unit_proyektor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kendala</label>
                            <textarea name="kendala" rows="3" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm border px-3 py-2" placeholder="Jelaskan kendalanya (misal: layar redup, kabel HDMI longgar, dll)"></textarea>
                            @error('kendala') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-xl transition duration-200 shadow-sm text-sm">
                            Kirim Laporan
                        </button>
                    </form>
                </div>

                <!-- Kolom Daftar Laporan Masuk -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Riwayat & Daftar Kendala Terlaporkan</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Pelapor</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Unit Proyektor</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Kendala</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($laporans as $laporan)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">{{ $laporan->nama_pelapor }}</div>
                                            <div class="text-gray-500 text-xs">{{ $laporan->kelas }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $laporan->unit_proyektor }}</td>
                                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $laporan->kendala }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $laporan->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500 italic">Belum ada laporan kendala yang dikirim.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>