{{-- resources/views/realisasi/index.blade.php --}}
<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Realisasi Rincian Belanja</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data realisasi belanja pemerintah daerah</p>
            </div>
            <a href="{{ route('realisasi.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg transition shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Realisasi
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <form method="GET" action="{{ route('realisasi.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <select name="tahun"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition bg-white">
                        <option value="">Semua Tahun</option>
                        @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                    <select name="bulan"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition bg-white">
                        <option value="">Semua Bulan</option>
                        <option value="1" {{ request('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ request('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ request('bulan') == '4' ? 'selected' : '' }}>April</option>
                        <option value="5" {{ request('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ request('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ request('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ request('bulan') == '9' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Dana</label>
                    <select name="sumberdana"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition bg-white">
                        <option value="">Semua Sumber Dana</option>
                        <option value="APBD" {{ request('sumberdana') == 'APBD' ? 'selected' : '' }}>APBD</option>
                        <option value="APBN" {{ request('sumberdana') == 'APBN' ? 'selected' : '' }}>APBN</option>
                        <option value="DAK" {{ request('sumberdana') == 'DAK' ? 'selected' : '' }}>DAK</option>
                        <option value="Dana Desa" {{ request('sumberdana') == 'Dana Desa' ? 'selected' : '' }}>Dana
                            Desa</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="No SP2D, SKPD, Rekening..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                </div>
                <div class="md:col-span-4 flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-lg transition">
                        Filter
                    </button>
                    <a href="{{ route('realisasi.index') }}"
                        class="ml-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Total Realisasi</p>
                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalNilai, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Jumlah Transaksi</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalTransaksi }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Rata-rata per SP2D</p>
                <p class="text-2xl font-bold text-gray-800">Rp
                    {{ number_format($totalTransaksi > 0 ? $totalNilai / $totalTransaksi : 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Bulan Aktif</p>
                <p class="text-2xl font-bold text-gray-800">{{ $bulanAktif }}</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bulan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD SKPD</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM SKPD</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD SUBUNIT</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM SUBUNIT</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD KEGIATAN</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM KEGIATAN</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD SUBKEGIATAN</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM SUBKEGIATAN</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KD REK</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NM REK</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nilai</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tgl SP2D</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No SP2D</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sumber Dana</th>
                            <th
                                class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($realisasi as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                    {{ $index + $realisasi->firstItem() }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    {{ $bulanList[$item->bulan] ?? $item->bulan }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kdskpd }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $item->nmskpd }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kdsubunit }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $item->nmsubunit }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kdkegiatan }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $item->nmkegiatan }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kdsubkegiatan }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item->nmsubkegiatan }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->kdrek }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $item->nmrek }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-right font-semibold text-gray-700">
                                    Rp {{ number_format($item->nilai, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tgl_sp2d)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $item->no_sp2d }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $item->sumberdana == 'APBD' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $item->sumberdana == 'APBN' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $item->sumberdana == 'DAK' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $item->sumberdana == 'Dana Desa' ? 'bg-purple-100 text-purple-800' : '' }}">
                                        {{ $item->sumberdana }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('realisasi.edit', $item->id) }}"
                                            class="text-blue-600 hover:text-blue-800 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('realisasi.destroy', $item->id) }}"
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
                                <td colspan="17" class="px-4 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p>Belum ada data realisasi belanja</p>
                                    <a href="{{ route('realisasi.create') }}"
                                        class="text-blue-600 hover:text-blue-800 mt-2 inline-block">Tambah data
                                        pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $realisasi->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
