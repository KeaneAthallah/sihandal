<x-app-layout>
    <div class="space-y-6">
        {{-- Welcome Card --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 p-6 sm:p-8 text-white">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="relative">
                <h2 class="text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-primary-100 text-sm">Pantau dan kelola seluruh data keuangan daerah.</p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="card flex items-center gap-4">
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="stat-label">Total Sumber Dana</p>
                    <p class="stat-value">{{ number_format($totalSumberdana) }}</p>
                </div>
            </div>

            <div class="card flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="stat-label">Total Pagu</p>
                    <p class="stat-value">Rp {{ number_format($totalPagu, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="card flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <p class="stat-label">Pemasukan</p>
                    <p class="stat-value">{{ number_format($totalPemasukan) }}</p>
                    <div class="flex gap-2 mt-1">
                        <span class="badge-success">{{ $totalPemasukanApproved }} Disetujui</span>
                        <span class="badge-warning">{{ $totalPemasukanPending }} Pending</span>
                    </div>
                </div>
            </div>

            <div class="card flex items-center gap-4">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </div>
                <div>
                    <p class="stat-label">Pengeluaran</p>
                    <p class="stat-value">{{ number_format($totalPengeluaran) }}</p>
                    <div class="flex gap-2 mt-1">
                        <span class="badge-success">{{ $totalPengeluaranApproved }} Disetujui</span>
                        <span class="badge-warning">{{ $totalPengeluaranPending }} Pending</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Transactions --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-slate-800">Pemasukan Terbaru</h3>
                    <a href="{{ route('admin.pemasukan.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">Lihat Semua &rarr;</a>
                </div>
                @if ($recentPemasukans->count() > 0)
                    <div class="space-y-2">
                        @foreach ($recentPemasukans as $item)
                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                                <div>
                                    <p class="text-sm font-medium text-slate-800">{{ $item->user->name }}</p>
                                    <p class="text-xs text-slate-500">Rp {{ number_format($item->jumlah, 0, ',', '.') }} &middot; {{ $item->tanggal->format('d-m-Y') }}</p>
                                </div>
                                <span class="badge {{ $item->status === 'approved' ? 'badge-success' : ($item->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm text-slate-400">Belum ada pemasukan</p>
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-semibold text-slate-800">Pengeluaran Terbaru</h3>
                    <a href="{{ route('admin.pengeluaran.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">Lihat Semua &rarr;</a>
                </div>
                @if ($recentPengeluarans->count() > 0)
                    <div class="space-y-2">
                        @foreach ($recentPengeluarans as $item)
                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                                <div>
                                    <p class="text-sm font-medium text-slate-800">{{ $item->user->name }}</p>
                                    <p class="text-xs text-slate-500">Rp {{ number_format($item->jumlah, 0, ',', '.') }} &middot; {{ $item->tanggal->format('d-m-Y') }}</p>
                                </div>
                                <span class="badge {{ $item->status === 'approved' ? 'badge-success' : ($item->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm text-slate-400">Belum ada pengeluaran</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>