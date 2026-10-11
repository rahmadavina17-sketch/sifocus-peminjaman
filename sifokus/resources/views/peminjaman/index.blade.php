<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Peminjaman Proyektor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-gray-100">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-bold text-gray-900 text-base">Daftar Peminjaman Aktif & Riwayat</h3>
                        <p class="text-xs text-gray-500">Kelola dan pantau status peminjaman unit proyektor beserta kartu pelajar.</p>
                    </div>
                    <!-- Tombol ajukan peminjaman -->
                    <a href="{{ route('peminjaman.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs uppercase tracking-wider rounded-xl shadow transition">
                        + Ajukan Peminjaman
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-3 py-2 rounded-xl text-xs">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Peminjam</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Unit Proyektor</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kartu Pelajar</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($peminjamans as $item)
                            <tr>
                                <td class="px-4 py-3 text-xs font-medium text-gray-900">{{ $item->peminjam }}</td>
                                <td class="px-4 py-3 text-xs text-gray-500">{{ $item->kelas }}</td>
                                <td class="px-4 py-3 text-xs text-gray-500">{{ $item->unit_proyektor }}</td>
                                <td class="px-4 py-3 text-xs text-gray-500">{{ $item->tanggal }}</td>
                                <td class="px-4 py-3 text-xs text-gray-500">
                                    @if($item->kartu_pelajar)
                                    <a href="{{ asset('storage/' . $item->kartu_pelajar) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition border border-indigo-200 shadow-sm">
                                        <!-- Ikon Mata -->
                                        <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Foto
                                    </a>
                                    @else
                                    <span class="text-gray-400 italic">Tidak ada</span>
                                @endif
                            </td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $item->status == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-xs text-center">
                                    @if($item->status != 'Selesai')
                                        <form action="{{ route('peminjaman.selesaikan', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-semibold shadow transition">
                                                Selesaikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 italic">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-xs text-gray-400 italic">Belum ada data peminjaman proyektor.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>