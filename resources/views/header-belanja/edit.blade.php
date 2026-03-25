{{-- resources/views/header_belanja/edit.blade.php --}}
<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('header-belanja.index') }}"
                class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Edit Header Belanja</h2>
                <p class="text-sm text-gray-500 mt-1">Edit data header belanja yang sudah ada</p>
            </div>

            <form method="POST" action="{{ route('header-belanja.update', $headerBelanja->id) }}"
                class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nomor" class="block text-sm font-medium text-gray-700 mb-1">Nomor <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nomor" name="nomor"
                            value="{{ old('nomor', $headerBelanja->nomor) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('nomor')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tgl_sp2d" class="block text-sm font-medium text-gray-700 mb-1">Tanggal SP2D <span
                                class="text-red-500">*</span></label>
                        <input type="date" id="tgl_sp2d" name="tgl_sp2d"
                            value="{{ old('tgl_sp2d', $headerBelanja->tgl_sp2d) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('tgl_sp2d')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_sp2d" class="block text-sm font-medium text-gray-700 mb-1">No SP2D <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="no_sp2d" name="no_sp2d"
                            value="{{ old('no_sp2d', $headerBelanja->no_sp2d) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('no_sp2d')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_skpd" class="block text-sm font-medium text-gray-700 mb-1">Unit SKPD <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="unit_skpd" name="unit_skpd"
                            value="{{ old('unit_skpd', $headerBelanja->unit_skpd) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('unit_skpd')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_penerima" class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima
                            <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_penerima" name="nama_penerima"
                            value="{{ old('nama_penerima', $headerBelanja->nama_penerima) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('nama_penerima')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_sp2" class="block text-sm font-medium text-gray-700 mb-1">Jenis SP2 <span
                                class="text-red-500">*</span></label>
                        <select id="jenis_sp2" name="jenis_sp2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition bg-white"
                            required>
                            <option value="">Pilih Jenis SP2</option>
                            <option value="LS"
                                {{ old('jenis_sp2', $headerBelanja->jenis_sp2) == 'LS' ? 'selected' : '' }}>LS
                                (Langsung)</option>
                            <option value="GU"
                                {{ old('jenis_sp2', $headerBelanja->jenis_sp2) == 'GU' ? 'selected' : '' }}>GU (Ganti
                                Uang)</option>
                            <option value="TU"
                                {{ old('jenis_sp2', $headerBelanja->jenis_sp2) == 'TU' ? 'selected' : '' }}>TU (Tambah
                                Uang)</option>
                            <option value="UP"
                                {{ old('jenis_sp2', $headerBelanja->jenis_sp2) == 'UP' ? 'selected' : '' }}>UP (Uang
                                Persediaan)</option>
                        </select>
                        @error('jenis_sp2')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            placeholder="Keterangan tambahan">{{ old('keterangan', $headerBelanja->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="brutto" class="block text-sm font-medium text-gray-700 mb-1">Brutto (Rp) <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="brutto" name="brutto"
                            value="{{ old('brutto', $headerBelanja->brutto) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('brutto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('header-belanja.index') }}"
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
