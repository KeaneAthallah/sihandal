{{-- resources/views/layouts/navigation.blade.php --}}
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left side with mobile menu button -->
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = true"
                    class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Page title -->
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">
                        @yield('title', 'Dashboard')
                    </h1>
                    <p class="text-sm text-gray-500 hidden sm:block">Portal Internal Pemerintah</p>
                </div>
            </div>

            <!-- Right side with notifications and user -->
            <div class="flex items-center space-x-4">


                <!-- User dropdown -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center space-x-2 focus:outline-none">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500 hidden sm:block" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-20">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700">Profil
                            Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
