{{-- resources/views/sumberdana/index.blade.php --}}
<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Sumber Dana</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data sumber dana anggaran pemerintah</p>
            </div>
            <a href="{{ route('sumberdana.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg transition shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Sumber Dana
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD SKPD</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM SKPD</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD SUBUNIT</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM SUBUNIT</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD KEGIATAN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM KEGIATAN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD SUBKEGIATAN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM SUBKEGIATAN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD REK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM REK</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                PAGU</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                SUMBER DANA</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($sumberdana as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $index + $sumberdana->firstItem() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kd_skpd }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nm_skpd }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kd_subunit }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nm_subunit }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kd_kegiatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nm_kegiatan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kd_subkegiatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item->nm_subkegiatan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kd_rek }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nm_rek }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-gray-700">
                                    Rp {{ number_format($item->pagu, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $item->sumberdana == 'APBD' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $item->sumberdana == 'APBN' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $item->sumberdana == 'DAK' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $item->sumberdana == 'Dana Desa' ? 'bg-purple-100 text-purple-800' : '' }}">
                                        {{ $item->sumberdana }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('sumberdana.edit', $item->id) }}"
                                            class="text-blue-600 hover:text-blue-800 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('sumberdana.destroy', $item->id) }}"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p>Belum ada data sumber dana</p>
                                    <a href="{{ route('sumberdana.create') }}"
                                        class="text-blue-600 hover:text-blue-800 mt-2 inline-block">Tambah data
                                        pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $sumberdana->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('search')?.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    window.location.href = '{{ route('sumberdana.index') }}?search=' + this.value;
                }
            });

            document.getElementById('filter_jenis')?.addEventListener('change', function() {
                window.location.href = '{{ route('sumberdana.index') }}?filter=' + this.value;
            });
        </script>
    @endpush
</x-app-layout>
