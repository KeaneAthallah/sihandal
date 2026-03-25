{{-- resources/views/sumberdana/edit.blade.php --}}
<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('sumberdana.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Edit Sumber Dana</h2>
                <p class="text-sm text-gray-500 mt-1">Edit data sumber dana yang sudah ada</p>
            </div>

            <form method="POST" action="{{ route('sumberdana.update', $sumberdana->id) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kd_skpd" class="block text-sm font-medium text-gray-700 mb-1">KD SKPD <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="kd_skpd" name="kd_skpd"
                            value="{{ old('kd_skpd', $sumberdana->kd_skpd) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('kd_skpd')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nm_skpd" class="block text-sm font-medium text-gray-700 mb-1">NM SKPD <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nm_skpd" name="nm_skpd"
                            value="{{ old('nm_skpd', $sumberdana->nm_skpd) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('nm_skpd')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kd_subunit" class="block text-sm font-medium text-gray-700 mb-1">KD SUBUNIT</label>
                        <input type="text" id="kd_subunit" name="kd_subunit"
                            value="{{ old('kd_subunit', $sumberdana->kd_subunit) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kd_subunit')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nm_subunit" class="block text-sm font-medium text-gray-700 mb-1">NM SUBUNIT</label>
                        <input type="text" id="nm_subunit" name="nm_subunit"
                            value="{{ old('nm_subunit', $sumberdana->nm_subunit) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nm_subunit')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kd_kegiatan" class="block text-sm font-medium text-gray-700 mb-1">KD
                            KEGIATAN</label>
                        <input type="text" id="kd_kegiatan" name="kd_kegiatan"
                            value="{{ old('kd_kegiatan', $sumberdana->kd_kegiatan) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kd_kegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nm_kegiatan" class="block text-sm font-medium text-gray-700 mb-1">NM
                            KEGIATAN</label>
                        <input type="text" id="nm_kegiatan" name="nm_kegiatan"
                            value="{{ old('nm_kegiatan', $sumberdana->nm_kegiatan) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nm_kegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kd_subkegiatan" class="block text-sm font-medium text-gray-700 mb-1">KD
                            SUBKEGIATAN</label>
                        <input type="text" id="kd_subkegiatan" name="kd_subkegiatan"
                            value="{{ old('kd_subkegiatan', $sumberdana->kd_subkegiatan) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kd_subkegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nm_subkegiatan" class="block text-sm font-medium text-gray-700 mb-1">NM
                            SUBKEGIATAN</label>
                        <input type="text" id="nm_subkegiatan" name="nm_subkegiatan"
                            value="{{ old('nm_subkegiatan', $sumberdana->nm_subkegiatan) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nm_subkegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kd_rek" class="block text-sm font-medium text-gray-700 mb-1">KD REK</label>
                        <input type="text" id="kd_rek" name="kd_rek"
                            value="{{ old('kd_rek', $sumberdana->kd_rek) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kd_rek')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nm_rek" class="block text-sm font-medium text-gray-700 mb-1">NM REK</label>
                        <input type="text" id="nm_rek" name="nm_rek"
                            value="{{ old('nm_rek', $sumberdana->nm_rek) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nm_rek')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pagu" class="block text-sm font-medium text-gray-700 mb-1">PAGU <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="pagu" name="pagu"
                            value="{{ old('pagu', $sumberdana->pagu) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('pagu')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sumberdana" class="block text-sm font-medium text-gray-700 mb-1">SUMBER DANA <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="sumberdana" name="sumberdana"
                            value="{{ old('sumberdana', $sumberdana->sumberdana) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('sumberdana')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('sumberdana.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
