@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">Kelola Kendala Proyektor</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Daftar laporan masalah atau kerusakan unit proyektor dari siswa.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Daftar Kendala Terlaporkan (Full Lebar) -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-md font-bold text-gray-900 mb-4">Riwayat & Daftar Kendala Terlaporkan</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Proyektor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendala</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($laporans ?? [] as $laporan)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                    {{ $laporan->nama_pelapor }}<br>
                                    <span class="text-xs text-gray-500 font-normal">{{ $laporan->kelas }}</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $laporan->unit_proyektor }}</td>
                                <td class="px-4 py-4 text-sm text-gray-900 max-w-xs truncate">{{ $laporan->deskripsi ?? $laporan->kendala }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if(isset($laporan->status) && $laporan->status == 'Selesai')
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                    <!-- Tombol Selesaikan (jika rutenya ada) -->
                                    @if(!isset($laporan->status) || $laporan->status != 'Selesai')
                                        <form action="{{ route('admin.laporan.selesaikan', $laporan->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded text-xs transition">Selesai</button>
                                        </form>
                                    @endif

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded text-xs transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">Belum ada laporan kendala yang masuk dari siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection