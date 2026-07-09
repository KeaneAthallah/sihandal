{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <div class="space-y-6">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-700 to-blue-800 rounded-xl shadow-lg p-6 text-white">
            <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
            <p class="text-blue-100">Selamat datang di Portal Transaksi Internal Pemerintah. Sistem siap membantu
                aktivitas administrasi Anda.</p>
            @if (Auth::user()->skpd)
                <div class="mt-3 pt-3 border-t border-blue-600">
                    <p class="text-sm text-blue-100">
                        <span class="font-semibold">Unit Kerja:</span>
                        {{ Auth::user()->skpd_name ?? Auth::user()->skpd }}
                    </p>
                </div>
            @endif
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Pagu SKPD Card -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Pagu SKPD</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            Rp {{ number_format($totalPaguSkpd ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->skpd_name ?? 'Unit Kerja' }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Jumlah Kegiatan Card -->
            <div
                class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jumlah Kegiatan</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ number_format($jumlahKegiatan ?? 0) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Program & Kegiatan</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Jumlah Sub Kegiatan Card -->
            <div
                class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jumlah Sub Kegiatan</p>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ number_format($jumlahSubKegiatan ?? 0) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Detail Kegiatan</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
