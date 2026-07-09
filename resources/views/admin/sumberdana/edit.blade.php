<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold mb-6">Edit Data Sumber Dana</h1>

                <form action="{{ route('sumberdana.update', $sumberdana) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">No</label>
                        <input type="text" name="no" value="{{ old('no', $sumberdana->no) }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kode SKPD</label>
                        <input type="text" name="kd_skpd" value="{{ old('kd_skpd', $sumberdana->kd_skpd) }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama SKPD</label>
                        <input type="text" name="nm_skpd" value="{{ old('nm_skpd', $sumberdana->nm_skpd) }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kode Rekening *</label>
                        <input type="text" name="kd_rek" value="{{ old('kd_rek', $sumberdana->kd_rek) }}" required
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Rekening</label>
                        <input type="text" name="nm_rek" value="{{ old('nm_rek', $sumberdana->nm_rek) }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pagu</label>
                        <input type="number" name="pagu" value="{{ old('pagu', $sumberdana->pagu) }}" step="0.01"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('sumberdana.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
