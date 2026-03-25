{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal Internal Pemerintah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js Collapse Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity.duration.200ms @click="sidebarOpen = false"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 lg:hidden">
        </div>

        <!-- Sidebar -->
        <aside x-show="sidebarOpen" x-transition:enter="transform transition ease-in-out duration-200"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-30 lg:static lg:translate-x-0 lg:shadow-none"
            :class="{ 'hidden': !sidebarOpen, 'block': sidebarOpen }">
            @include('layouts.sidebar')
        </aside>

        <!-- Force desktop sidebar to always show -->
        <aside class="hidden lg:block w-64 bg-white border-r border-gray-200 flex-shrink-0">
            @include('layouts.sidebar')
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.navigation')

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
