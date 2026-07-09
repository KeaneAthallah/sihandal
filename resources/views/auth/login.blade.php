<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - sihandal</title>
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
                Kelola Keuangan<br>
                <span class="text-primary-200">Makin Mudah</span>
            </h1>
            <p class="text-primary-100 text-lg max-w-md leading-relaxed">
                Platform terintegrasi untuk pengelolaan sumber dana, pemasukan, pengeluaran, 
                dan realisasi anggaran daerah secara real-time.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                <div class="flex items-center gap-2 text-sm text-white/80">
                    <svg class="w-5 h-5 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Real-time Dashboard
                </div>
                <div class="flex items-center gap-2 text-sm text-white/80">
                    <svg class="w-5 h-5 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Approval Workflow
                </div>
                <div class="flex items-center gap-2 text-sm text-white/80">
                    <svg class="w-5 h-5 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Multi-SKPD
                </div>
            </div>
        </div>

        <div class="relative text-sm text-primary-200">
            &copy; {{ date('Y') }} sihandal. All rights reserved.
        </div>
    </div>

    {{-- Right: Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-10 xl:p-16">
        <div class="w-full max-w-md">
            {{-- Mobile logo --}}
            <div class="lg:hidden flex justify-center mb-8">
                <a href="/" class="flex items-center gap-2.5">
                    <img src="{{ asset('logo-sihandal.png') }}" alt="sihandal" class="h-9 w-auto">
                    <span class="font-bold text-xl text-slate-800">sihandal</span>
                </a>
            </div>

            <div class="text-center lg:text-left mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Selamat Datang Kembali</h2>
                <p class="text-slate-500 mt-1">Masuk ke akun sihandal Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email / NIP</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="input-field" placeholder="contoh@email.com" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-medium text-slate-700">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-medium text-primary-600 hover:text-primary-700">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required
                        class="input-field" placeholder="Masukkan kata sandi" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label for="remember_me" class="inline-flex items-center gap-2">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-slate-300 text-primary-600 shadow-sm focus:ring-primary-500">
                        <span class="text-sm text-slate-600">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full">
                    Masuk
                </button>

                <p class="text-center text-sm text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-700 transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>