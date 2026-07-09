{{-- resources/views/realisasi/create.blade.php --}}
<x-app-layout>
    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('realisasi.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Tambah Realisasi Rincian Belanja</h2>
                <p class="text-sm text-gray-500 mt-1">Isi form berikut untuk menambahkan data realisasi belanja baru</p>
            </div>

            <form method="POST" action="{{ route('realisasi.store') }}" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Bulan <span
                                class="text-red-500">*</span></label>
                        <select id="bulan" name="bulan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition bg-white"
                            required>
                            <option value="">Pilih Bulan</option>
                            <option value="1" {{ old('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ old('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ old('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ old('bulan') == '4' ? 'selected' : '' }}>April</option>
                            <option value="5" {{ old('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ old('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ old('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ old('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ old('bulan') == '9' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ old('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ old('bulan') == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ old('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                        </select>
                        @error('bulan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tgl_sp2d" class="block text-sm font-medium text-gray-700 mb-1">Tanggal SP2D <span
                                class="text-red-500">*</span></label>
                        <input type="date" id="tgl_sp2d" name="tgl_sp2d" value="{{ old('tgl_sp2d') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('tgl_sp2d')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_sp2d" class="block text-sm font-medium text-gray-700 mb-1">No SP2D <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="no_sp2d" name="no_sp2d" value="{{ old('no_sp2d') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('no_sp2d')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kdskpd" class="block text-sm font-medium text-gray-700 mb-1">KD SKPD <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="kdskpd" name="kdskpd" value="{{ old('kdskpd') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('kdskpd')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nmskpd" class="block text-sm font-medium text-gray-700 mb-1">NM SKPD <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nmskpd" name="nmskpd" value="{{ old('nmskpd') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('nmskpd')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kdsubunit" class="block text-sm font-medium text-gray-700 mb-1">KD SUBUNIT</label>
                        <input type="text" id="kdsubunit" name="kdsubunit" value="{{ old('kdsubunit') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kdsubunit')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nmsubunit" class="block text-sm font-medium text-gray-700 mb-1">NM SUBUNIT</label>
                        <input type="text" id="nmsubunit" name="nmsubunit" value="{{ old('nmsubunit') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nmsubunit')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kdkegiatan" class="block text-sm font-medium text-gray-700 mb-1">KD KEGIATAN</label>
                        <input type="text" id="kdkegiatan" name="kdkegiatan" value="{{ old('kdkegiatan') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kdkegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nmkegiatan" class="block text-sm font-medium text-gray-700 mb-1">NM
                            KEGIATAN</label>
                        <input type="text" id="nmkegiatan" name="nmkegiatan" value="{{ old('nmkegiatan') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nmkegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kdsubkegiatan" class="block text-sm font-medium text-gray-700 mb-1">KD
                            SUBKEGIATAN</label>
                        <input type="text" id="kdsubkegiatan" name="kdsubkegiatan"
                            value="{{ old('kdsubkegiatan') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kdsubkegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nmsubkegiatan" class="block text-sm font-medium text-gray-700 mb-1">NM
                            SUBKEGIATAN</label>
                        <input type="text" id="nmsubkegiatan" name="nmsubkegiatan"
                            value="{{ old('nmsubkegiatan') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nmsubkegiatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kdrek" class="block text-sm font-medium text-gray-700 mb-1">KD REK</label>
                        <input type="text" id="kdrek" name="kdrek" value="{{ old('kdrek') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('kdrek')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nmrek" class="block text-sm font-medium text-gray-700 mb-1">NM REK</label>
                        <input type="text" id="nmrek" name="nmrek" value="{{ old('nmrek') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                        @error('nmrek')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nilai" class="block text-sm font-medium text-gray-700 mb-1">Nilai (Rp) <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="nilai" name="nilai" value="{{ old('nilai') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('nilai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sumberdana" class="block text-sm font-medium text-gray-700 mb-1">SUMBER DANA <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="sumberdana" name="sumberdana" value="{{ old('sumberdana') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition"
                            required>
                        @error('sumberdana')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_smb" class="block text-sm font-medium text-gray-700 mb-1">ID Sumber
                            Dana</label>
                        <select id="id_smb" name="id_smb"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition bg-white">
                            <option value="">Pilih ID Sumber Dana</option>
                            @foreach ($sumberDana as $smb)
                                <option value="{{ $smb->id }}"
                                    {{ old('id_smb') == $smb->id ? 'selected' : '' }}>
                                    {{ $smb->kdskpd }} - {{ $smb->nmskpd }} ({{ $smb->sumberdana }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_smb')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('realisasi.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
