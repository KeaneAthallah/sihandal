<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>sihandal - Sistem Informasi Handal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-slate-50">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        {{-- Mobile overlay --}}
        <div x-show="sidebarOpen" x-transition.opacity.duration.200ms @click="sidebarOpen = false"
            class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-20 lg:hidden">
        </div>

        {{-- Sidebar (mobile) --}}
        <aside x-show="sidebarOpen" x-transition:enter="transform transition ease-in-out duration-200"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 w-72 bg-white shadow-2xl z-30 lg:static lg:translate-x-0 lg:shadow-none"
            :class="{ 'hidden': !sidebarOpen, 'block': sidebarOpen }">
            @include('layouts.sidebar')
        </aside>

        {{-- Sidebar (desktop) --}}
        <aside class="hidden lg:block w-72 bg-white border-r border-slate-200/60 flex-shrink-0">
            @include('layouts.sidebar')
        </aside>

        {{-- Main area --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.navigation')

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-slate-50">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>