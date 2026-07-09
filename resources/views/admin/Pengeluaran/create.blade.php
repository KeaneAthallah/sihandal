<x-app-layout>
    <div class="container mx-auto py-6 max-w-xl">
        <h1 class="text-xl font-semibold mb-4">Ajukan Permintaan Pengeluaran</h1>

        <form method="POST" action="{{ route('pengeluaran.store') }}" class="space-y-4">
            @csrf
            @include('pengeluaran._form')

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Ajukan
            </button>
        </form>
    </div>
</x-app-layout>
