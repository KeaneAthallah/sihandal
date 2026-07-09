<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">💰 Ajukan Permintaan Pemasukan</h1>
                <p class="text-gray-600 mt-1">Formulir untuk mengajukan permintaan pemasukan dana</p>
            </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        @php $pr = auth()->user()->role === 'admin' ? 'admin' : 'user'; @endphp
        <form method="POST" action="{{ route($pr . '.pemasukan.store') }}" class="space-y-6">
            @csrf
            @include('admin.Pemasukan._form')

            <div class="flex justify-end gap-3">
                <a href="{{ route($pr . '.pemasukan.index') }}" 
                   class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200">
                    Batal
                </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Ajukan Pemasukan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>