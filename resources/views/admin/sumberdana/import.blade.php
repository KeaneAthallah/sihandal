<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-6">Import Data Sumber Dana (CSV)</h1>

                <form action="{{ route('sumberdana.import') }}" method="POST" enctype="multipart/form-data"
                    id="importForm">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            File CSV (Comma Separated Values)
                        </label>
                        <input type="file" name="file" id="fileInput" accept=".csv,.txt"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500
                                  @error('file') border-red-500 @enderror"
                            required>

                        @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <p class="text-sm text-gray-500 mt-2">
                            Maksimal ukuran file: 20MB. Format yang didukung: .csv, .txt<br>
                            <strong>Mendukung hingga 15.000+ baris data</strong>
                        </p>
                    </div>

                    <div id="loadingContainer" class="hidden mb-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="animate-spin h-5 w-5 text-blue-600 mr-3" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-medium text-blue-800">Sedang mengimport data...</p>
                                    <p class="text-sm text-blue-600">Proses ini mungkin memakan waktu beberapa menit.
                                        Harap jangan menutup halaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="font-bold text-blue-800 mb-2">Format File CSV:</h3>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>✓ File CSV <strong>TIDAK menggunakan header</strong> (baris pertama langsung data)</li>
                            <li>✓ Kolom dipisahkan dengan koma (,) atau titik koma (;)</li>
                            <li>✓ Urutan kolom sesuai template yang disediakan</li>
                            <li>✓ Kolom <strong>KD REK (kolom ke-10)</strong> wajib diisi</li>
                            <li>✓ Format angka PAGU: gunakan angka tanpa pemisah (contoh: 39744976250)</li>
                            <li>✓ Support hingga <strong>15.000+ baris</strong> data</li>
                        </ul>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <h3 class="font-bold text-yellow-800 mb-2">📋 Urutan Kolom CSV:</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <tr class="border-b">
                                    <td class="py-1 font-mono">1</td>
                                    <td class="py-1">NO</td>
                                    <td class="py-1 text-gray-500">Nomor urut (opsional)</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">2</td>
                                    <td class="py-1">KD SKPD</td>
                                    <td class="py-1 text-gray-500">Kode SKPD</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">3</td>
                                    <td class="py-1">NM SKPD</td>
                                    <td class="py-1 text-gray-500">Nama SKPD</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">4</td>
                                    <td class="py-1">KD SUB UNIT</td>
                                    <td class="py-1 text-gray-500">Kode Sub Unit</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">5</td>
                                    <td class="py-1">NM SUB UNIT</td>
                                    <td class="py-1 text-gray-500">Nama Sub Unit</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">6</td>
                                    <td class="py-1">KD KEGIATAN</td>
                                    <td class="py-1 text-gray-500">Kode Kegiatan</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">7</td>
                                    <td class="py-1">NM KEGIATAN</td>
                                    <td class="py-1 text-gray-500">Nama Kegiatan</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">8</td>
                                    <td class="py-1">KD SUB KEGIATAN</td>
                                    <td class="py-1 text-gray-500">Kode Sub Kegiatan</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">9</td>
                                    <td class="py-1">NM SUB KEGIATAN</td>
                                    <td class="py-1 text-gray-500">Nama Sub Kegiatan</td>
                                </tr>
                                <tr class="border-b bg-yellow-100">
                                    <td class="py-1 font-mono font-bold">10</td>
                                    <td class="py-1 font-bold">KD REK</td>
                                    <td class="py-1 text-red-600 font-bold">Kode Rekening (WAJIB)</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">11</td>
                                    <td class="py-1">NM REK</td>
                                    <td class="py-1 text-gray-500">Nama Rekening</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-1 font-mono">12</td>
                                    <td class="py-1">PAGU</td>
                                    <td class="py-1 text-gray-500">Pagu Anggaran</td>
                                </tr>
                                <tr>
                                    <td class="py-1 font-mono">13</td>
                                    <td class="py-1">SUMBER DANA</td>
                                    <td class="py-1 text-gray-500">Sumber Dana</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('sumberdana.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Batal
                        </a>

                        <div class="space-x-2">
                            <a href="{{ route('sumberdana.template') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Download Template CSV
                            </a>

                            <button type="submit" id="submitBtn"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Import CSV
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('importForm').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('fileInput');
            const submitBtn = document.getElementById('submitBtn');
            const loadingContainer = document.getElementById('loadingContainer');

            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                const fileExtension = fileName.split('.').pop().toLowerCase();

                if (!['csv', 'txt'].includes(fileExtension)) {
                    e.preventDefault();
                    alert('Hanya file CSV atau TXT yang diperbolehkan');
                    return;
                }

                const fileSize = fileInput.files[0].size / 1024 / 1024;

                if (fileSize > 20) {
                    e.preventDefault();
                    alert('File terlalu besar. Maksimal 20MB');
                    return;
                }

                loadingContainer.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Importing...';
            }
        });
    </script>
</x-app-layout>
