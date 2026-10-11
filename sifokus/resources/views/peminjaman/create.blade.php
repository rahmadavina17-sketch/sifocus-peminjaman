<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pengajuan Peminjaman Proyektor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Menggunakan overflow-visible dan mb-24 agar dropdown terbuka ke bawah dengan leluasa -->
            <div class="bg-white overflow-visible shadow-sm sm:rounded-2xl border border-gray-100 p-6 mb-24">
                
                <!-- Peringatan Error jika validasi gagal -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                        <strong class="font-semibold">Oops! Gagal Disimpan:</strong>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                        <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XI PPLG 1" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Unit Proyektor</label>
                        <select name="unit_proyektor" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
                            <option value="">-- Pilih Unit Proyektor --</option>
                            <option value="Epson EB-X450">Epson EB-X450</option>
                            <option value="Epson EB-S400">Epson EB-S400</option>
                            <option value="BenQ MS550">BenQ MS550</option>
                            <option value="Acer X1123H">Acer X1123H</option>
                            <option value="InFocus IN114xx">InFocus IN114xx</option>
                        </select>
                    </div>

                    <!-- BAGIAN FOTO KARTU PELAJAR -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kartu Pelajar (Wajib Kamera)</label>
                        
                        <div class="border-2 border-dashed border-indigo-300 rounded-2xl p-4 bg-indigo-50/50 flex flex-col items-center justify-center text-center">
                            
                            <div id="preview-container" class="mb-3 hidden">
                                <p class="text-xs font-semibold text-emerald-600 mb-1">✓ Foto Kartu Pelajar Berhasil Diambil</p>
                                <img id="image-preview" src="#" alt="Preview Kartu Pelajar" class="max-h-48 rounded-xl shadow-md border border-gray-200 mx-auto object-cover">
                                <button type="button" onclick="ulangFoto()" class="mt-2 text-xs text-indigo-600 hover:underline font-medium block mx-auto">Ambil Ulang Foto</button>
                            </div>

                            <div id="laptop-camera-box" class="mb-3 hidden w-full max-w-md">
                                <video id="webcam" autoplay playsinline class="w-full rounded-xl shadow-md border border-gray-300 bg-black"></video>
                                <button type="button" onclick="takeSnapshot()" class="mt-2 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 rounded-xl shadow transition text-sm flex items-center justify-center gap-2">
                                    Jepret Foto Sekarang
                                </button>
                            </div>

                            <div id="button-container">
                                <button type="button" onclick="bukaKamera()" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-xl shadow-md transition text-sm">
                                    Buka Kamera Kartu Pelajar
                                </button>
                                <p class="text-xs text-gray-500 mt-2">Otomatis membuka kamera HP atau Laptop.</p>
                            </div>

                            <input type="file" id="kartu_pelajar_file" name="kartu_pelajar" accept="image/*" capture="environment" required class="hidden" onchange="previewMobileImage(event)">
                            <canvas id="canvas" class="hidden"></canvas>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('peminjaman.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-300 transition">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-700 shadow-md transition">Simpan Pengajuan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Script Kamera -->
    <script>
        let videoStream = null;

        function isMobileDevice() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        async function bukaKamera() {
            if (isMobileDevice()) {
                document.getElementById('kartu_pelajar_file').click();
            } else {
                const video = document.getElementById('webcam');
                const laptopCameraBox = document.getElementById('laptop-camera-box');
                const buttonContainer = document.getElementById('button-container');

                buttonContainer.classList.add('hidden');
                laptopCameraBox.classList.remove('hidden');

                try {
                    videoStream = await navigator.mediaDevices.getUserMedia({ video: { width: 640, height: 480 }, audio: false });
                    video.srcObject = videoStream;
                } catch (error) {
                    alert("Kamera tidak dapat diakses! Pastikan izin kamera di browser sudah diizinkan.");
                    buttonContainer.classList.remove('hidden');
                    laptopCameraBox.classList.add('hidden');
                }
            }
        }

        function takeSnapshot() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const imagePreview = document.getElementById('image-preview');
            const laptopCameraBox = document.getElementById('laptop-camera-box');
            const previewContainer = document.getElementById('preview-container');
            const fileInput = document.getElementById('kartu_pelajar_file');

            canvas.width = video.videoWidth || 640;
            canvas.height = video.videoHeight || 480;

            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            if (videoStream) {
                videoStream.getTracks().forEach(track => track.stop());
            }

            canvas.toBlob(function(blob) {
                const file = new File([blob], "kartu_pelajar_" + Date.now() + ".png", { type: "image/png" });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                imagePreview.src = canvas.toDataURL('image/png');
                laptopCameraBox.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }, 'image/png');
        }

        function previewMobileImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const buttonContainer = document.getElementById('button-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    buttonContainer.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function ulangFoto() {
            document.getElementById('preview-container').classList.add('hidden');
            document.getElementById('button-container').classList.remove('hidden');
            document.getElementById('kartu_pelajar_file').value = "";
        }
    </script>
</x-app-layout>