<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php $pr = auth()->user()->role === 'admin' ? 'admin' : 'user'; @endphp

            {{-- Header --}}
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Pemasukan</h1>
                    <p class="text-sm text-slate-500 mt-1">Kelola permintaan pemasukan dana</p>
                </div>
                <a href="{{ route($pr . '.pemasukan.create') }}" class="btn-primary text-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Ajukan Pemasukan
                </a>
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm">{{ session('error') }}</div>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="card flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="stat-label">Total</p>
                        <p class="stat-value text-lg">Rp {{ number_format($pemasukans->sum('jumlah'), 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="card flex items-center gap-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="stat-label">Selesai</p>
                        <p class="stat-value text-lg">{{ $pemasukans->where('status', 'completed')->count() }}</p>
                    </div>
                </div>
                <div class="card flex items-center gap-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="stat-label">Pending</p>
                        <p class="stat-value text-lg">{{ $pemasukans->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Search & Filter --}}
            <div class="card mb-6">
                <form method="GET" action="{{ route($pr . '.pemasukan.index') }}" class="flex flex-wrap gap-3">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="search" placeholder="Cari SKPD, rekening, atau keterangan..."
                               value="{{ request('search') }}" class="input-field text-sm">
                    </div>
                    <div class="w-44">
                        <select name="status" class="input-field text-sm">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="approved_1" {{ request('status') == 'approved_1' ? 'selected' : '' }}>Disetujui Lv.1</option>
                            <option value="docs_1_uploaded" {{ request('status') == 'docs_1_uploaded' ? 'selected' : '' }}>Dok.1 Diupload</option>
                            <option value="approved_2" {{ request('status') == 'approved_2' ? 'selected' : '' }}>Disetujui Lv.2</option>
                            <option value="docs_2_uploaded" {{ request('status') == 'docs_2_uploaded' ? 'selected' : '' }}>Dok.2 Diupload</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary text-sm">Cari</button>
                    @if (request()->hasAny(['search', 'status']))
                        <a href="{{ route($pr . '.pemasukan.index') }}" class="btn-secondary text-sm">Reset</a>
                    @endif
                </form>
            </div>

            {{-- Export Buttons (admin only) --}}
            @if (auth()->user()->role === 'admin')
                <div class="flex gap-2 mb-6">
                    <a href="{{ route('admin.pemasukan.export-pdf') }}" class="btn-secondary text-sm" target="_blank">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Export PDF
                    </a>
                    <a href="{{ route('admin.pemasukan.export-excel') }}" class="btn-secondary text-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export Excel
                    </a>
                </div>
            @endif

            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">SKPD</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Pengaju</th>
                                <th class="px-5 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-5 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="px-5 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($pemasukans as $item)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-5 py-4 text-sm text-slate-700">{{ $item->tanggal->format('d-m-Y') }}</td>
                                    <td class="px-5 py-4">
                                        <div class="text-sm font-medium text-slate-800">{{ $item->sumberdana->nm_skpd ?? '-' }}</div>
                                        <div class="text-xs text-slate-400">{{ $item->sumberdana->nm_rek ?? '' }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $item->user->name }}</td>
                                    <td class="px-5 py-4 text-sm text-right font-semibold text-emerald-700">
                                        Rp {{ number_format($item->jumlah, 2, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <span class="badge {{ \App\Models\Pemasukan::statusColor($item->status) }}">
                                            {{ \App\Models\Pemasukan::statusLabel($item->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route($pr . '.pemasukan.show', $item) }}"
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-100 transition-colors">
                                                Detail
                                            </a>
                                            @if ($item->status === 'pending' && $item->user_id === auth()->id())
                                                <a href="{{ route($pr . '.pemasukan.edit', $item) }}"
                                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors">
                                                    Edit
                                                </a>
                                            @endif
                                            @if (auth()->user()->role === 'admin' && in_array($item->status, ['pending', 'docs_1_uploaded', 'docs_2_uploaded']))
                                                <form action="{{ route('admin.pemasukan.approve', $item) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Setujui?')"
                                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">
                                                        Setujui
                                                    </button>
                                                </form>
                                            @endif
                                            @if (auth()->user()->role === 'admin' && $item->document_1_path)
                                                <a href="{{ route('admin.pemasukan.download-document', [$item, 1]) }}"
                                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-slate-600 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                                                    Dok.1
                                                </a>
                                            @endif
                                            @if (auth()->user()->role === 'admin' && $item->document_2_path)
                                                <a href="{{ route('admin.pemasukan.download-document', [$item, 2]) }}"
                                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-slate-600 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                                                    Dok.2
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center text-slate-400">
                                        <svg class="mx-auto h-10 w-10 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        <p class="text-sm">Belum ada data pemasukan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $pemasukans->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>