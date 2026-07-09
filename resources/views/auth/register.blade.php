<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - sihandal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white min-h-screen flex">
    {{-- Left: Branding --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 p-12 xl:p-16 flex-col justify-between relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')] opacity-30"></div>
        <div class="absolute top-20 -right-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

        <div class="relative">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('logo-sihandal.png') }}" alt="sihandal" class="h-10 w-auto brightness-0 invert">
                <span class="text-2xl font-bold text-white">sihandal</span>
            </a>
        </div>

        <div class="relative space-y-6">
            <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight">
                Bergabung dengan<br>
                <span class="text-primary-200">sihandal</span>
            </h1>
            <p class="text-primary-100 text-lg max-w-md leading-relaxed">
                Daftarkan akun Anda dan mulai kelola anggaran daerah secara digital, 
                transparan, dan real-time bersama sihandal.
            </p>
            <div class="space-y-4 pt-2">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Akses sesuai SKPD</p>
                        <p class="text-xs text-primary-200">Setiap unit kerja memiliki akses data masing-masing</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Approval Workflow</p>
                        <p class="text-xs text-primary-200">Setiap transaksi melalui persetujuan admin</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Monitoring Real-time</p>
                        <p class="text-xs text-primary-200">Pantau realisasi anggaran kapan saja</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative text-sm text-primary-200">
            &copy; {{ date('Y') }} sihandal. All rights reserved.
        </div>
    </div>

    {{-- Right: Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-10 xl:p-16 overflow-y-auto">
        <div class="w-full max-w-md py-8">
            {{-- Mobile logo --}}
            <div class="lg:hidden flex justify-center mb-8">
                <a href="/" class="flex items-center gap-2.5">
                    <img src="{{ asset('logo-sihandal.png') }}" alt="sihandal" class="h-9 w-auto">
                    <span class="font-bold text-xl text-slate-800">sihandal</span>
                </a>
            </div>

            <div class="text-center lg:text-left mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Daftar Akun Baru</h2>
                <p class="text-slate-500 mt-1">Registrasi untuk Aparatur Sipil Negara</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        class="input-field" placeholder="Nama lengkap Anda" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Instansi</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        class="input-field" placeholder="email@instansi.go.id" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nip" class="block text-sm font-medium text-slate-700 mb-1.5">NIP</label>
                    <input id="nip" type="text" name="nip" :value="old('nip')" required
                        class="input-field" placeholder="Nomor Induk Pegawai" />
                    @error('nip')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="skpd" class="block text-sm font-medium text-slate-700 mb-1.5">Unit Kerja</label>
                    <select id="skpd" name="skpd" class="input-field">
                        <option value="">Pilih Unit Kerja</option>
                        <option value="5.03.0.00.0.00.01.0000">Badan Kepegawaian Daerah Provinsi Sulawesi Tengah</option>
                        <option value="8.01.0.00.0.00.01.0000">Badan Kesatuan Bangsa dan Politik Daerah Provinsi Sulawesi Tengah</option>
                        <option value="1.05.0.00.0.00.02.0000">Badan Penanggulangan Bencana Daerah Provinsi Tengah</option>
                        <option value="5.02.0.00.0.00.01.0000">Badan Pendapatan Daerah Provinsi Sulawesi Tengah</option>
                        <option value="5.02.0.00.0.00.02.0000">Badan Pengelolaan Keuangan dan Aset Daerah Provinsi Sulawesi Tengah</option>
                        <option value="5.04.0.00.0.00.01.0000">Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Sulawesi Tengah</option>
                        <option value="5.07.0.00.0.00.01.0000">Badan Penghubung Provinsi Sulawesi Tengah</option>
                        <option value="5.01.0.00.0.00.01.0000">Badan Perencanaan Pembangunan Daerah Provinsi Sulawesi Tengah</option>
                        <option value="5.05.0.00.0.00.01.0000">Badan Riset dan Inovasi Daerah Provinsi Sulawesi Tengah</option>
                        <option value="1.03.0.00.0.00.01.0000">Dinas Bina Marga dan Penataan Ruang Provinsi Sulawesi Tengah</option>
                        <option value="1.03.0.00.0.00.02.0000">Dinas Cipta Karya dan Sumberdaya Air</option>
                        <option value="3.29.0.00.0.00.01.0000">Dinas Energi dan Sumber Daya Mineral Provinsi Sulawesi Tengah</option>
                        <option value="2.22.0.00.0.00.01.0000">Dinas Kebudayaan Daerah Provinsi Sulawesi Tengah</option>
                        <option value="3.28.0.00.0.00.01.0000">Dinas Kehutanan Provinsi Sulawesi Tengah</option>
                        <option value="3.25.0.00.0.00.01.0000">Dinas Kelautan dan Perikanan Provinsi Sulawesi Tengah</option>
                        <option value="2.12.0.00.0.00.01.0000">Dinas Kependudukan dan Pencatatan Sipil Provinsi Sulawesi Tengah</option>
                        <option value="1.02.0.00.0.00.01.0000">Dinas Kesehatan Provinsi Sulawesi Tengah</option>
                        <option value="2.16.2.21.2.20.01.0000">Dinas Komunikasi, Informatika, Persandian dan Statistik Provinsi Sulawesi Tengah</option>
                        <option value="2.17.0.00.0.00.01.0000">Dinas Koperasi, Usaha Kecil dan Menengah Provinsi Sulawesi Tengah</option>
                        <option value="2.11.0.00.0.00.01.0000">Dinas Lingkungan Hidup Provinsi Sulawesi Tengah</option>
                        <option value="2.09.0.00.0.00.01.0000">Dinas Pangan Provinsi Sulawesi Tengah</option>
                        <option value="3.26.0.00.0.00.01.0000">Dinas Pariwisata Provinsi Sulawesi Tengah</option>
                        <option value="2.13.0.00.0.00.01.0000">Dinas Pemberdayaan Masyarakat dan Desa Provinsi Sulawesi Tengah</option>
                        <option value="2.08.0.00.0.00.01.0000">Dinas Pemberdayaan Perempuan dan Perlindungan Anak Provinsi Sulawesi Tengah</option>
                        <option value="2.19.0.00.0.00.01.0000">Dinas Pemuda dan Olah Raga Provinsi Sulawesi Tengah</option>
                        <option value="2.18.0.00.0.00.01.0000">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Provinsi Sulawesi Tengah</option>
                        <option value="1.01.0.00.0.00.01.0000">Dinas Pendidikan Daerah Provinsi Sulawesi Tengah</option>
                        <option value="2.14.0.00.0.00.01.0000">Dinas Pengendalian Penduduk dan Keluarga Berencana Provinsi Sulawesi Tengah</option>
                        <option value="2.15.0.00.0.00.01.0000">Dinas Perhubungan Provinsi Sulawesi Tengah</option>
                        <option value="3.31.3.30.0.00.01.0000">Dinas Perindustrian dan Perdagangan Provinsi Sulawesi Tengah</option>
                        <option value="3.27.0.00.0.00.02.0000">Dinas Perkebunan dan Peternakan Provinsi Sulawesi Tengah</option>
                        <option value="2.23.2.24.0.00.01.0000">Dinas Perpustakaan dan Kearsipan Provinsi Sulawesi Tengah</option>
                        <option value="1.04.2.10.0.00.01.0000">Dinas Perumahan, Kawasan Permukiman dan Pertanahan Provinsi Sulawesi Tengah</option>
                        <option value="1.06.0.00.0.00.01.0000">Dinas Sosial Provinsi Sulawesi Tengah</option>
                        <option value="3.27.0.00.0.00.01.0000">Dinas Tanaman Pangan dan Hortikultura Provinsi Sulawesi Tengah</option>
                        <option value="2.07.3.32.0.00.01.0000">Dinas Tenaga Kerja dan Transmigrasi Provinsi Sulawesi Tengah</option>
                        <option value="6.01.0.00.0.00.01.0000">Inspektorat Daerah Provinsi Sulawesi Tengah</option>
                        <option value="1.05.0.00.0.00.01.0000">Satuan Polisi Pamong Praja Provinsi Sulawesi Tengah</option>
                        <option value="4.01.0.00.0.00.01.0000">Sekretariat Daerah Sulawesi Tengah</option>
                        <option value="4.02.0.00.0.00.01.0000">Sekretariat DPRD Provinsi Sulawesi Tengah</option>
                    </select>
                    @error('unit')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        class="input-field" placeholder="Minimal 8 karakter" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="input-field" placeholder="Ulangi kata sandi" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full">
                    Daftar
                </button>

                <p class="text-center text-sm text-slate-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-700 transition-colors">
                        Masuk
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>