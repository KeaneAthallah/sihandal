{{-- resources/views/admin/setting.blade.php --}}
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">⚙️ Pengaturan Persentase Pagu SKPD</h1>
                <p class="text-gray-600 mt-1">Atur persentase pagu yang akan ditampilkan untuk setiap SKPD (0% - 100%)
                </p>
            </div>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-5 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Aksi Cepat</h3>
                <div class="flex flex-wrap gap-3">
                    <button onclick="openBatchModal()"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Update Batch
                    </button>

                    <button onclick="openPercentageModal()"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                        Terapkan ke Semua SKPD
                    </button>

                    <form action="{{ route('admin.setting.reset') }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Yakin ingin mereset semua persentase ke 0%?')">
                        @csrf
                        @method('POST')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Reset Semua (0%)
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistics Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow p-4">
                    <div class="text-blue-600 text-sm font-semibold">Total SKPD</div>
                    <div class="text-2xl font-bold text-blue-800">{{ $skpdSettings->count() }}</div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow p-4">
                    <div class="text-green-600 text-sm font-semibold">Total Pagu Keseluruhan</div>
                    <div class="text-2xl font-bold text-green-800">Rp
                        {{ number_format($totalPaguOverall, 0, ',', '.') }}</div>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow p-4">
                    <div class="text-purple-600 text-sm font-semibold">SKPD dengan Setting</div>
                    <div class="text-2xl font-bold text-purple-800">
                        {{ $skpdSettings->filter(function ($item) {return $item->percentage > 0;})->count() }}
                    </div>
                </div>
            </div>

            <!-- SKPD Settings Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            32
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode SKPD</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama SKPD</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Pagu</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Persentase (%)</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pagu Ditampilkan</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($skpdSettings as $index => $skpd)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-mono text-gray-600">{{ $skpd->kd_skpd }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $skpd->nm_skpd }}</td>
                                    <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                        Rp {{ number_format($skpd->total_pagu, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center">
                                            <div class="w-20 bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-blue-600 h-2 rounded-full"
                                                    style="width: {{ $skpd->percentage }}%"></div>
                                            </div>
                                            <span
                                                class="text-sm font-bold {{ $skpd->percentage > 0 ? 'text-blue-600' : 'text-gray-400' }}">
                                                {{ number_format($skpd->percentage, 2) }}%
                                            </span>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-right font-semibold {{ $skpd->percentage > 0 ? 'text-green-600' : 'text-gray-400' }}">
                                        Rp {{ number_format($skpd->display_pagu, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button
                                            onclick="openEditModal('{{ $skpd->kd_skpd }}', '{{ $skpd->nm_skpd }}', {{ $skpd->percentage }}, {{ $skpd->total_pagu }})"
                                            class="text-blue-600 hover:text-blue-900 font-medium">
                                            ✏️ Edit Persentase
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-bold text-gray-900 mb-4">✏️ Edit Persentase Pagu</h3>
                <form id="editForm" method="POST" action="{{ route('admin.setting.update') }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="kd_skpd" id="editKdSkpd">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama SKPD</label>
                        <p id="editNmSkpd" class="text-gray-900 font-medium bg-gray-50 p-2 rounded"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Total Pagu</label>
                        <p id="editTotalPagu" class="text-gray-900 font-medium bg-gray-50 p-2 rounded"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Persentase (%)
                            <span class="text-xs text-gray-500">(0% - 100%)</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="percentage" id="editPercentage"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                step="0.01" min="0" max="100" required>
                            <div class="absolute right-3 top-2 text-gray-400">%</div>
                        </div>
                        <div class="mt-2">
                            <input type="range" id="percentageSlider" min="0" max="100"
                                step="0.01" class="w-full"
                                oninput="document.getElementById('editPercentage').value = this.value">
                        </div>
                    </div>
                    <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                        <label class="flex items-center">
                            <input type="checkbox" name="apply_to_all" value="1" class="mr-2">
                            <span class="text-sm text-blue-700 font-medium">Terapkan ke semua data SKPD ini</span>
                        </label>
                        <p class="text-xs text-blue-600 mt-1">Centang jika ingin menerapkan persentase ke semua record
                            SKPD ini</p>
                    </div>
                    <div class="mb-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Hasil Perhitungan:</p>
                            <p class="text-lg font-bold text-green-600" id="previewPagu">Rp 0</p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            Simpan Persentase
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Batch Update Modal -->
    <div id="batchModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-[700px] shadow-lg rounded-lg bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Update Batch Persentase</h3>
                <p class="text-sm text-gray-600 mb-4">Atur persentase untuk setiap SKPD (0% - 100%)</p>
                <form id="batchForm" method="POST" action="{{ route('admin.setting.update.batch') }}">
                    @csrf
                    @method('POST')
                    <div class="max-h-96 overflow-y-auto mb-4 space-y-2">
                        @foreach ($skpdSettings as $skpd)
                            <div class="p-3 border rounded-lg hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="font-medium text-sm">{{ $skpd->nm_skpd }}</div>
                                        <div class="text-xs text-gray-500">{{ $skpd->kd_skpd }}</div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            Total: Rp {{ number_format($skpd->total_pagu, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="w-32">
                                        <input type="hidden" name="settings[{{ $loop->index }}][kd_skpd]"
                                            value="{{ $skpd->kd_skpd }}">
                                        <div class="relative">
                                            <input type="number" name="settings[{{ $loop->index }}][percentage]"
                                                value="{{ $skpd->percentage }}"
                                                class="w-full px-3 py-2 border rounded-lg text-sm" step="0.01"
                                                min="0" max="100"
                                                onchange="updateBatchPreview(this, {{ $skpd->total_pagu }})">
                                            <div class="absolute right-3 top-2 text-gray-400 text-xs">%</div>
                                        </div>
                                        <div class="text-xs text-green-600 mt-1" id="preview-{{ $loop->index }}">
                                            Rp {{ number_format($skpd->display_pagu, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeBatchModal()"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                            Simpan Semua Persentase
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Percentage Modal (Apply to All) -->
    <div id="percentageModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-bold text-gray-900 mb-4">📊 Terapkan Persentase ke Semua SKPD</h3>
                <form method="POST" action="{{ route('admin.setting.apply.all') }}">
                    @csrf
                    @method('POST')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Persentase (%)
                            <span class="text-xs text-gray-500">(0% - 100%)</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="percentage"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                step="0.01" min="0" max="100" required>
                            <div class="absolute right-3 top-2 text-gray-400">%</div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Persentase ini akan diterapkan ke SEMUA SKPD yang ada
                        </p>
                    </div>
                    <div class="bg-yellow-50 p-3 rounded-lg mb-4">
                        <p class="text-sm text-yellow-800">
                            ⚠️ Perhatian: Tindakan ini akan mengubah semua setting persentase yang sudah ada.
                        </p>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closePercentageModal()"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                            Terapkan ke Semua
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentTotalPagu = 0;

        function openEditModal(kdSkpd, nmSkpd, percentage, totalPagu) {
            document.getElementById('editKdSkpd').value = kdSkpd;
            document.getElementById('editNmSkpd').innerText = nmSkpd;
            document.getElementById('editTotalPagu').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPagu);
            document.getElementById('editPercentage').value = percentage;
            document.getElementById('percentageSlider').value = percentage;
            currentTotalPagu = totalPagu;
            updatePreview();
            document.getElementById('editModal').classList.remove('hidden');
        }

        function updatePreview() {
            const percentage = parseFloat(document.getElementById('editPercentage').value) || 0;
            const displayPagu = (currentTotalPagu * percentage) / 100;
            document.getElementById('previewPagu').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(displayPagu);
        }

        function updateBatchPreview(input, totalPagu) {
            const percentage = parseFloat(input.value) || 0;
            const displayPagu = (totalPagu * percentage) / 100;
            const previewId = input.closest('.w-32').querySelector('.text-green-600');
            if (previewId) {
                previewId.innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(displayPagu);
            }
        }

        // Add event listeners
        document.getElementById('editPercentage').addEventListener('input', function() {
            document.getElementById('percentageSlider').value = this.value;
            updatePreview();
        });

        document.getElementById('percentageSlider').addEventListener('input', function() {
            document.getElementById('editPercentage').value = this.value;
            updatePreview();
        });

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openBatchModal() {
            document.getElementById('batchModal').classList.remove('hidden');
        }

        function closeBatchModal() {
            document.getElementById('batchModal').classList.add('hidden');
        }

        function openPercentageModal() {
            document.getElementById('percentageModal').classList.remove('hidden');
        }

        function closePercentageModal() {
            document.getElementById('percentageModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                closeModal();
                closeBatchModal();
                closePercentageModal();
            }
        }
    </script>
</x-app-layout>
