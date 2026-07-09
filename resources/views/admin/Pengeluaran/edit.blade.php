<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">✏️ Edit Permintaan Pengeluaran</h1>
                <p class="text-gray-600 mt-1">Edit permintaan pengeluaran yang masih berstatus pending</p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                @php $pr = auth()->user()->role === 'admin' ? 'admin' : 'user'; @endphp
                <form method="POST" action="{{ route($pr . '.pengeluaran.update', $pengeluaran) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    @include('admin.Pengeluaran._form')

                    <div class="flex justify-end gap-3">
                        <a href="{{ route($pr . '.pengeluaran.index') }}"
                           class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
