<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>sihandal - Sistem Informasi Handal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-700 antialiased bg-gradient-to-br from-slate-50 to-primary-50/30 min-h-screen">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-12 px-4">
        <div class="mb-8">
            <a href="/" class="flex flex-col items-center gap-2">
                <img src="{{ asset('logo-sihandal.png') }}" alt="sihandal" class="h-14 w-auto drop-shadow-sm">
                <span class="text-xl font-bold text-slate-800">sihandal</span>
            </a>
        </div>

        <div class="w-full sm:max-w-lg bg-white rounded-2xl shadow-sm border border-slate-200/60 p-8">
            {{ $slot }}
        </div>

        <p class="mt-8 text-xs text-slate-400">&copy; {{ date('Y') }} sihandal</p>
    </div>
</body>
</html>