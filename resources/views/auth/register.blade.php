{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-bold text-gray-800">Daftar Akun Baru</h2>
        <p class="text-sm text-gray-600 mt-1">Registrasi untuk Aparatur Sipil Negara</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input id="name"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="text" name="name" :value="old('name')" required autofocus />
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Instansi</label>
            <input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="email" name="email" :value="old('email')" required />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
            <input id="nip"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="text" name="nip" :value="old('nip')" required />
            @error('nip')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="skpd" class="block text-sm font-medium text-gray-700">Unit Kerja</label>
            <select id="skpd" name="skpd"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                <option value="">Pilih Unit Kerja</option>
                <option value="5.03.0.00.0.00.01.0000">Badan Kepegawaian Daerah Provinsi Sulawesi Tengah</option>
                <option value="8.01.0.00.0.00.01.0000">Badan Kesatuan Bangsa dan Politik Daerah Provinsi Sulawesi Tengah
                </option>
                <option value="1.05.0.00.0.00.02.0000">Badan Penanggulangan Bencana Daerah Provinsi Tengah</option>
                <option value="5.02.0.00.0.00.01.0000">Badan Pendapatan Daerah Provinsi Sulawesi Tengah</option>
                <option value="5.02.0.00.0.00.02.0000">Badan Pengelolaan Keuangan dan Aset Daerah Provinsi Sulawesi
                    Tengah</option>
                <option value="5.04.0.00.0.00.01.0000">Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Sulawesi
                    Tengah</option>
                <option value="5.07.0.00.0.00.01.0000">Badan Penghubung Provinsi Sulawesi Tengah</option>
                <option value="5.01.0.00.0.00.01.0000">Badan Perencanaan Pembangunan Daerah Provinsi Sulawesi Tengah
                </option>
                <option value="5.05.0.00.0.00.01.0000">Badan Riset dan Inovasi Daerah Provinsi Sulawesi Tengah</option>
                <option value="1.03.0.00.0.00.01.0000">Dinas Bina Marga dan Penataan Ruang Provinsi Sulawesi Tengah
                </option>
                <option value="1.03.0.00.0.00.02.0000">Dinas Cipta Karya dan Sumberdaya Air</option>
                <option value="3.29.0.00.0.00.01.0000">Dinas Energi dan Sumber Daya Mineral Provinsi Sulawesi Tengah
                </option>
                <option value="2.22.0.00.0.00.01.0000">Dinas Kebudayaan Daerah Provinsi Sulawesi Tengah</option>
                <option value="3.28.0.00.0.00.01.0000">Dinas Kehutanan Provinsi Sulawesi Tengah</option>
                <option value="3.25.0.00.0.00.01.0000">Dinas Kelautan dan Perikanan Provinsi Sulawesi Tengah</option>
                <option value="2.12.0.00.0.00.01.0000">Dinas Kependudukan dan Pencatatan Sipil Provinsi Sulawesi Tengah
                </option>
                <option value="1.02.0.00.0.00.01.0000">Dinas Kesehatan Provinsi Sulawesi Tengah</option>
                <option value="2.16.2.21.2.20.01.0000">Dinas Komunikasi, Informatika, Persandian dan Statistik Provinsi
                    Sulawesi Tengah</option>
                <option value="2.17.0.00.0.00.01.0000">Dinas Koperasi, Usaha Kecil dan Menengah Provinsi Sulawesi Tengah
                </option>
                <option value="2.11.0.00.0.00.01.0000">Dinas Lingkungan Hidup Provinsi Sulawesi Tengah</option>
                <option value="2.09.0.00.0.00.01.0000">Dinas Pangan Provinsi Sulawesi Tengah</option>
                <option value="3.26.0.00.0.00.01.0000">Dinas Pariwisata Provinsi Sulawesi Tengah</option>
                <option value="2.13.0.00.0.00.01.0000">Dinas Pemberdayaan Masyarakat dan Desa Provinsi Sulawesi Tengah
                </option>
                <option value="2.08.0.00.0.00.01.0000">Dinas Pemberdayaan Perempuan dan Perlindungan Anak Provinsi
                    Sulawesi Tengah</option>
                <option value="2.19.0.00.0.00.01.0000">Dinas Pemuda dan Olah Raga Provinsi Sulawesi Tengah</option>
                <option value="2.18.0.00.0.00.01.0000">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Provinsi
                    Sulawesi Tengah</option>
                <option value="1.01.0.00.0.00.01.0000">Dinas Pendidikan Daerah Provinsi Sulawesi Tengah</option>
                <option value="2.14.0.00.0.00.01.0000">Dinas Pengendalian Penduduk dan Keluarga Berencana Provinsi
                    Sulawesi Tengah</option>
                <option value="2.15.0.00.0.00.01.0000">Dinas Perhubungan Provinsi Sulawesi Tengah</option>
                <option value="3.31.3.30.0.00.01.0000">Dinas Perindustrian dan Perdagangan Provinsi Sulawesi Tengah
                </option>
                <option value="3.27.0.00.0.00.02.0000">Dinas Perkebunan dan Peternakan Provinsi Sulawesi Tengah</option>
                <option value="2.23.2.24.0.00.01.0000">Dinas Perpustakaan dan Kearsipan Provinsi Sulawesi Tengah
                </option>
                <option value="1.04.2.10.0.00.01.0000">Dinas Perumahan, Kawasan Permukiman dan Pertanahan Provinsi
                    Sulawesi Tengah</option>
                <option value="1.06.0.00.0.00.01.0000">Dinas Sosial Provinsi Sulawesi Tengah</option>
                <option value="3.27.0.00.0.00.01.0000">Dinas Tanaman Pangan dan Hortikultura Provinsi Sulawesi Tengah
                </option>
                <option value="2.07.3.32.0.00.01.0000">Dinas Tenaga Kerja dan Transmigrasi Provinsi Sulawesi Tengah
                </option>
                <option value="6.01.0.00.0.00.01.0000">Inspektorat Daerah Provinsi Sulawesi Tengah</option>
                <option value="1.05.0.00.0.00.01.0000">Satuan Polisi Pamong Praja Provinsi Sulawesi Tengah</option>
                <option value="4.01.0.00.0.00.01.0000">Sekretariat Daerah Sulawesi Tengah</option>
                <option value="4.02.0.00.0.00.01.0000">Sekretariat DPRD Provinsi Sulawesi Tengah</option>
            </select>
            @error('unit')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
            <input id="password"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="password" name="password" required />
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata
                Sandi</label>
            <input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="password" name="password_confirmation" required />
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit"
                class="ms-4 bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-md">
                Daftar
            </button>
        </div>
    </form>
</x-guest-layout>
