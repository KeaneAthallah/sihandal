{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Internal Pemerintah</title>
    @vite(['resources/css/app.css'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 font-sans">

    {{-- Navigation --}}
    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-700 rounded-md flex items-center justify-center">
                        <span class="text-white font-bold text-sm">RI</span>
                    </div>
                    <span class="font-bold text-xl text-gray-800">e-Transaksi</span>
                    <span class="hidden md:block text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">Internal
                        Pemerintah</span>
                </div>
                <div class="hidden md:flex space-x-6 text-sm font-medium">
                    <a href="#" class="text-gray-700 hover:text-blue-700">Beranda</a>
                    <a href="#" class="text-gray-700 hover:text-blue-700">Layanan</a>
                    <a href="#" class="text-gray-700 hover:text-blue-700">Informasi</a>
                    <a href="#" class="text-gray-700 hover:text-blue-700">Bantuan</a>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}"
                        class="bg-blue-50 text-blue-700 px-4 py-1.5 rounded-md text-sm font-medium hover:bg-blue-100 transition">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-700 text-white px-4 py-1.5 rounded-md text-sm font-medium hover:bg-blue-800 transition">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <main>
        <div class="bg-gradient-to-br from-blue-50 via-white to-blue-50 py-12 md:py-20">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4">
                        Portal Transaksi Internal<br>
                        <span class="text-blue-700">Pemerintah Indonesia</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                        Sistem informasi terintegrasi untuk pengelolaan dokumen, disposisi, dan transaksi kepegawaian
                        secara digital.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('register') }}"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded-lg transition">Buat
                            Akun Baru</a>
                        <a href="{{ route('login') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition">Login</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Feature Section --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Fitur Unggulan</h2>
                <p class="text-gray-500 mt-2">Dukungan penuh untuk administrasi pemerintahan modern</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Dokumen Digital</h3>
                    <p class="text-gray-600">Kelola surat masuk/keluar, arsip digital, dan disposisi elektronik.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Transparansi Anggaran</h3>
                    <p class="text-gray-600">Pantau realisasi anggaran dan belanja internal dengan dashboard real-time.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Manajemen ASN</h3>
                    <p class="text-gray-600">Data kepegawaian, cuti, dan kinerja terpusat untuk seluruh unit kerja.</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="bg-white border-t border-gray-100 py-10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm">
                <p>© 2025 Kementerian Dalam Negeri - Portal Transaksi Internal Pemerintah</p>
            </div>
        </div>
    </main>
</body>

</html>
