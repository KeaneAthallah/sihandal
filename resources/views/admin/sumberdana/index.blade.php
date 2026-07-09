{{-- resources/views/sumberdana/index.blade.php --}}
<x-app-layout>
    <div class="">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">📊 Data Sumber Dana</h1>
                <p class="text-gray-600 mt-1">Kelola data sumber dana anggaran dengan mudah</p>
            </div>

            {{-- Statistics Cards - Larger and Clearer --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-md p-5 border border-blue-200">
                    <div class="text-blue-600 text-sm font-semibold uppercase tracking-wide">Total Data</div>
                    <div class="text-3xl font-bold text-blue-800 mt-2">{{ number_format($statistics['total_records']) }}
                    </div>
                    <div class="text-xs text-blue-600 mt-1">records</div>
                </div>

                <div
                    class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-md p-5 border border-green-200">
                    <div class="text-green-600 text-sm font-semibold uppercase tracking-wide">Total Anggaran</div>
                    <div class="text-2xl font-bold text-green-800 mt-2">Rp
                        {{ number_format($statistics['total_pagu'] / 1000000000, 2) }} M</div>
                    <div class="text-xs text-green-600 mt-1">≈ Rp
                        {{ number_format($statistics['total_pagu'], 0, ',', '.') }}</div>
                </div>

                <div
                    class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-md p-5 border border-purple-200">
                    <div class="text-purple-600 text-sm font-semibold uppercase tracking-wide">SKPD Aktif</div>
                    <div class="text-3xl font-bold text-purple-800 mt-2">{{ number_format($statistics['unique_skpd']) }}
                    </div>
                    <div class="text-xs text-purple-600 mt-1">unit kerja</div>
                </div>

                <div
                    class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-md p-5 border border-orange-200">
                    <div class="text-orange-600 text-sm font-semibold uppercase tracking-wide">Kegiatan</div>
                    <div class="text-3xl font-bold text-orange-800 mt-2">
                        {{ number_format($statistics['unique_kegiatan']) }}</div>
                    <div class="text-xs text-orange-600 mt-1">program & kegiatan</div>
                </div>
            </div>

            {{-- Action Buttons - Large and Clear --}}
            <div class="bg-white rounded-xl shadow-md p-5 mb-6">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('sumberdana.import.form') }}"
                        class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Import Data CSV
                    </a>

                    <a href="{{ route('sumberdana.template') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        Download Template
                    </a>

                    <a href="{{ route('sumberdana.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Data Baru
                    </a>

                    @if (auth()->user()->role === 'admin')
                        <form action="{{ route('sumberdana.truncate') }}" method="POST" class="inline-block"
                            id="truncateForm">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="showDeleteWarning()"
                                class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Semua Data
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Alert Messages - Larger and Clearer --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm">
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
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg mb-6 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        <span class="font-medium">{{ session('warning') }}</span>
                    </div>
                </div>
            @endif

            {{-- Search and Filter - Simple and Clear --}}
            <div class="bg-white rounded-xl shadow-md p-5 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">🔍 Cari & Filter Data</h3>
                <form method="GET" action="{{ route('sumberdana.index') }}" class="flex flex-wrap gap-3">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="search" placeholder="Cari nama SKPD, kegiatan, atau rekening..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="w-64">
                        <select name="kd_skpd"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">📋 Semua SKPD</option>
                            @foreach ($skpdList as $skpd)
                                <option value="{{ $skpd->kd_skpd }}"
                                    {{ request('kd_skpd') == $skpd->kd_skpd ? 'selected' : '' }}>
                                    {{ $skpd->nm_skpd }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-64">
                        <select name="sumberdana"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">💰 Semua Sumber Dana</option>
                            @foreach ($sumberDanaList as $sumber)
                                <option value="{{ $sumber->sumberdana }}"
                                    {{ request('sumberdana') == $sumber->sumberdana ? 'selected' : '' }}>
                                    {{ $sumber->sumberdana }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                        🔍 Cari
                    </button>

                    @if (request()->has('search') || request()->has('kd_skpd') || request()->has('sumberdana'))
                        <a href="{{ route('sumberdana.index') }}"
                            class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200">
                            ↺ Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Data Table - Clean and Readable --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    SKPD</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kegiatan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sub Kegiatan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Rekening</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Rekening</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pagu (Rp)</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sumber Dana</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($sumberdana as $data)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $data->no ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $data->nm_skpd ?? '-' }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $data->kd_skpd ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $data->nm_kegiatan ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $data->kd_kegiatan ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $data->nm_subkegiatan ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $data->kd_subkegiatan ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-mono text-gray-900">{{ $data->kd_rek ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $data->nm_rek ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">
                                        Rp {{ number_format($data->pagu, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $data->sumberdana ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Edit Button --}}
                                            <a href="{{ route('sumberdana.edit', $data) }}"
                                                class="inline-flex items-center px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium rounded-lg transition duration-200 border border-blue-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('sumberdana.destroy', $data) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                    class="inline-flex items-center px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-medium rounded-lg transition duration-200 border border-red-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p class="mt-2 text-lg">Belum ada data</p>
                                        <p class="text-sm">Silakan import data CSV atau tambah data baru</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $sumberdana->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mt-4">⚠️ Peringatan Penting!</h3>
                <div class="mt-4">
                    <p class="text-gray-600">Tindakan ini akan menghapus <strong class="text-red-600">SEMUA
                            DATA</strong> sumber dana.</p>
                    <p class="text-gray-600 mt-2">Data yang sudah dihapus <strong class="text-red-600">TIDAK DAPAT
                            DIKEMBALIKAN</strong>.</p>
                    <p class="text-gray-600 mt-2">Apakah Anda yakin ingin melanjutkan?</p>
                </div>
                <div class="flex justify-center gap-3 mt-6">
                    <button onclick="closeModal()"
                        class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition duration-200">
                        ❌ Batal
                    </button>
                    <button onclick="confirmDelete()"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-200">
                        🗑️ Ya, Hapus Semua
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteWarning() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function confirmDelete() {
            closeModal();
            if (confirm('KONFIRMASI AKHIR: Data akan dihapus permanen. Lanjutkan?')) {
                document.getElementById('truncateForm').submit();
            }
        }
    </script>
</x-app-layout>
