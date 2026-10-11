<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Peminjaman Proyektor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6">
                
                <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                        <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas', $peminjaman->kelas) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Unit Proyektor</label>
                        <select name="unit_proyektor" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                            <option value="Proyektor 01" {{ $peminjaman->unit_proyektor == 'Proyektor 01' ? 'selected' : '' }}>Proyektor 01 (Lab PPLG)</option>
                            <option value="Proyektor 02" {{ $peminjaman->unit_proyektor == 'Proyektor 02' ? 'selected' : '' }}>Proyektor 02 (Multimedia)</option>
                            <option value="Proyektor 03" {{ $peminjaman->unit_proyektor == 'Proyektor 03' ? 'selected' : '' }}>Proyektor 03 (Ruang Guru)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Kartu Pelajar</label>
                        @if($peminjaman->kartu_pelajar)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $peminjaman->kartu_pelajar) }}" target="_blank" class="text-indigo-600 text-sm underline font-medium">Lihat Kartu Pelajar Saat Ini</a>
                            </div>
                        @endif
                        <input type="file" name="kartu_pelajar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-xl">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto kartu pelajar.</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Status Peminjaman</label>
                        <select name="status" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                            <option value="Pending" {{ $peminjaman->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Dipinjam" {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="Selesai" {{ $peminjaman->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('peminjaman.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-300 transition">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-700 shadow-md transition">Perbarui Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>