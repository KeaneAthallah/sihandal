<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Header Belanja</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap header SP2D belanja</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('header-belanja.edit', $headerBelanja) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg transition shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('header-belanja.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Detail Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nomor</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->nomor }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal SP2D</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->tgl_sp2d ? $headerBelanja->tgl_sp2d->format('d F Y') : '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nomor SP2D</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->no_sp2d }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Unit SKPD</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->unit_skpd }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Penerima</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->nama_penerima }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Jenis SP2</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->jenis_sp2_label }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Brutto</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->formatted_brutto }}</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Keterangan</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $headerBelanja->keterangan ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Delete Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Hapus Data</h3>
            <p class="text-sm text-gray-600 mb-4">Tindakan ini tidak dapat dibatalkan. Hapus header belanja ini?</p>
            <form method="POST" action="{{ route('header-belanja.destroy', $headerBelanja) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                    Hapus Header Belanja
                </button>
            </form>
        </div>
    </div>
</x-app-layout>