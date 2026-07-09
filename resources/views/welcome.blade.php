<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sihandal - Sistem Informasi Handal</title>
    @vite(['resources/css/app.css'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-slate-700 antialiased">

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-2.5">
                    <img src="{{ asset('logo-sihandal.png') }}" alt="sihandal" class="h-9 w-auto">
                    <span class="font-bold text-xl text-slate-800">sihandal</span>
                </a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="btn-ghost text-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-primary-50/60 via-white to-white">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[600px] bg-gradient-to-b from-primary-200/20 to-transparent rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20 md:pt-24 md:pb-28">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Left: Text --}}
                <div class="text-center lg:text-left">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700 mb-5">Platform Resmi Pemerintah Daerah</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
                        Kelola Anggaran Daerah<br>
                        <span class="text-primary-600">Mudah, Cepat, Transparan</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-500 leading-relaxed max-w-xl mx-auto lg:mx-0 mb-8">
                        sihandal adalah sistem informasi terpadu untuk pengelolaan keuangan daerah — mencatat pemasukan, 
                        pengeluaran, dan memonitor realisasi anggaran secara real-time oleh seluruh SKPD.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                        <a href="{{ route('register') }}" class="btn-primary text-base px-8 py-3 shadow-lg shadow-primary-500/20">
                            Mulai Sekarang
                        </a>
                        <a href="#tentang" class="btn-secondary text-base px-8 py-3">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                    {{-- Mini stats --}}
                    <div class="flex flex-wrap justify-center lg:justify-start gap-6 mt-10 pt-8 border-t border-slate-100">
                        <div>
                            <p class="text-2xl font-bold text-slate-800">7441+</p>
                            <p class="text-xs text-slate-400">Sumber Dana</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-slate-800">50+</p>
                            <p class="text-xs text-slate-400">SKPD Aktif</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-slate-800">24/7</p>
                            <p class="text-xs text-slate-400">Akses Online</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Illustration / visual --}}
                <div class="hidden lg:flex justify-center">
                    <div class="relative w-full max-w-md">
                        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                                <img src="{{ asset('logo-sihandal.png') }}" alt="" class="h-8 w-auto">
                                <span class="font-bold text-slate-800">sihandal</span>
                                <span class="ml-auto badge-info">Live</span>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-slate-50 rounded-xl p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-slate-600">Total Pagu</span>
                                        <span class="text-xs text-slate-400">TA 2026</span>
                                    </div>
                                    <p class="text-lg font-bold text-slate-800">Rp 4,2 Triliun</p>
                                    <div class="mt-2 w-full bg-slate-200 rounded-full h-2">
                                        <div class="bg-primary-500 h-2 rounded-full" style="width: 68%"></div>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1">68% terealisasi</p>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-emerald-50 rounded-xl p-3">
                                        <p class="text-xs text-emerald-600 font-medium">Pemasukan</p>
                                        <p class="text-sm font-bold text-slate-800">Rp 1,2 T</p>
                                    </div>
                                    <div class="bg-red-50 rounded-xl p-3">
                                        <p class="text-xs text-red-600 font-medium">Pengeluaran</p>
                                        <p class="text-sm font-bold text-slate-800">Rp 892 M</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Decorative dots --}}
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-primary-100/50 rounded-full -z-10"></div>
                        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-primary-200/30 rounded-full -z-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About / Tentang --}}
    <section id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700 mb-4">Tentang</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mb-4">Apa Itu <span class="text-primary-600">sihandal</span>?</h2>
                <p class="text-slate-500 leading-relaxed mb-4">
                    <strong class="text-slate-700">Sistem Informasi Handal</strong> (sihandal) adalah platform digital yang dikembangkan 
                    untuk membantu Pemerintah Daerah dalam mengelola data keuangan secara terintegrasi.
                </p>
                <p class="text-slate-500 leading-relaxed mb-6">
                    Mulai dari pencatatan sumber dana, realisasi anggaran, pemasukan, hingga pengeluaran — 
                    semua tersaji dalam satu sistem yang aman, transparan, dan dapat diakses kapan saja. 
                    sihandal memudahkan setiap SKPD untuk mengajukan transaksi dan memudahkan admin 
                    untuk melakukan monitoring serta persetujuan.
                </p>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Berbasis Web
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Multi-SKPD
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approval Workflow
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Real-time Dashboard
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="card-hover text-center py-8">
                    <p class="text-3xl font-bold text-primary-600">7441+</p>
                    <p class="text-sm text-slate-500 mt-1">Sumber Dana</p>
                </div>
                <div class="card-hover text-center py-8">
                    <p class="text-3xl font-bold text-primary-600">50+</p>
                    <p class="text-sm text-slate-500 mt-1">SKPD Terdaftar</p>
                </div>
                <div class="card-hover text-center py-8">
                    <p class="text-3xl font-bold text-primary-600">Real-time</p>
                    <p class="text-sm text-slate-500 mt-1">Monitoring</p>
                </div>
                <div class="card-hover text-center py-8">
                    <p class="text-3xl font-bold text-primary-600">24/7</p>
                    <p class="text-sm text-slate-500 mt-1">Akses Online</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How it Works --}}
    <section class="bg-slate-50/70 py-20 md:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700 mb-4">Alur Kerja</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">Bagaimana Cara Kerjanya?</h2>
                <p class="text-slate-500 mt-3 max-w-xl mx-auto">Empat langkah mudah dalam mengelola keuangan daerah.</p>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-primary-600">1</span>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Input Sumber Dana</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Admin memasukkan data sumber dana dan pagu anggaran per SKPD.</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-primary-600">2</span>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Ajukan Transaksi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Setiap SKPD mencatat pemasukan dan pengeluaran sesuai kegiatan.</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-primary-600">3</span>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Approval</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Admin melakukan verifikasi dan menyetujui atau menolak transaksi.</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-primary-600">4</span>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800 mb-2">Monitoring</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Dashboard real-time menampilkan progres realisasi anggaran.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features detailed --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="text-center mb-14">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700 mb-4">Fitur</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">Fitur Unggulan</h2>
            <p class="text-slate-500 mt-3 max-w-xl mx-auto">Semua fitur dirancang untuk memudahkan pengelolaan keuangan daerah.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="card-hover">
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Manajemen Sumber Dana</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Kelola data sumber dana, pagu anggaran, dan alokasi per SKPD. Import data dari spreadsheet untuk kemudahan migrasi.</p>
            </div>
            <div class="card-hover">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Pencatatan Pemasukan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Catat setiap pemasukan dana dengan detail sumber, jumlah, dan tanggal. Dilengkapi status persetujuan untuk kontrol penuh.</p>
            </div>
            <div class="card-hover">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Pencatatan Pengeluaran</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Kelola pengeluaran anggaran per kegiatan dan sub kegiatan. Setiap transaksi melalui alur persetujuan yang transparan.</p>
            </div>
            <div class="card-hover">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Realisasi & Laporan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Pantau realisasi anggaran secara real-time. Lihat progres per SKPD, per kegiatan, dan unduh laporan untuk kebutuhan evaluasi.</p>
            </div>
            <div class="card-hover">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Dashboard Interaktif</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Visualisasi data keuangan dalam bentuk grafik dan angka ringkas. Monitoring jadi lebih mudah dan informatif.</p>
            </div>
            <div class="card-hover">
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Keamanan & Role-based</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Sistem dengan hak akses berbasis peran (admin & user). Setiap SKPD hanya dapat mengelola data unitnya masing-masing.</p>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 py-16 md:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">Siap Mengelola Anggaran dengan Lebih Baik?</h2>
            <p class="text-primary-100 text-lg mb-8 max-w-2xl mx-auto">Bergabunglah dengan puluhan SKPD yang sudah menggunakan sihandal untuk transparansi dan efisiensi pengelolaan keuangan daerah.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-white text-primary-700 font-semibold rounded-xl hover:bg-primary-50 transition-all duration-200 shadow-lg">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 bg-white/10 text-white font-semibold rounded-xl border border-white/20 hover:bg-white/20 transition-all duration-200">
                    Masuk ke Akun
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('logo-sihandal.png') }}" alt="sihandal" class="h-7 w-auto">
                    <span class="font-semibold text-slate-700">sihandal</span>
                </div>
                <p class="text-sm text-slate-400">&copy; {{ date('Y') }} sihandal. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>