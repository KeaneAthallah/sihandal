<div class="flex flex-col h-full">
    {{-- Logo --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-200/60">
        <img src="{{ asset('logo-sihandal.png') }}" alt="sihandal" class="h-9 w-auto">
        <div>
            <span class="font-bold text-lg text-slate-800 block leading-tight">sihandal</span>
            <span class="text-xs text-slate-400">Sistem Informasi Handal</span>
        </div>
    </div>

    {{-- User info --}}
    <div class="px-6 py-4 border-b border-slate-200/60 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-primary-700 font-bold text-base">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->skpd_name ?? Auth::user()->skpd ?? Auth::user()->nip }}</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        @php
            $role = auth()->user()->role;
            $prefix = $role === 'admin' ? 'admin' : 'user';
        @endphp

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>

        @if ($role === 'admin')
        <a href="{{ route('sumberdana.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 {{ request()->routeIs('sumberdana*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Sumber Dana
        </a>
        @endif

        {{-- Anggaran dropdown --}}
        <div x-data="{ open: {{ request()->routeIs($prefix . '.pemasukan*') || request()->routeIs($prefix . '.pengeluaran*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 {{ request()->routeIs($prefix . '.pemasukan*') || request()->routeIs($prefix . '.pengeluaran*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                <span class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Anggaran
                </span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" x-collapse class="pl-11 space-y-0.5 mt-1">
                <a href="{{ route($prefix . '.pemasukan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg transition-all duration-150 {{ request()->routeIs($prefix . '.pemasukan*') ? 'bg-primary-50 text-primary-700 font-medium' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-700' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Pemasukan
                </a>
                <a href="{{ route($prefix . '.pengeluaran.index') }}"
                    class="flex items-center gap-3 px-4 py-2 text-sm rounded-lg transition-all duration-150 {{ request()->routeIs($prefix . '.pengeluaran*') ? 'bg-primary-50 text-primary-700 font-medium' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-700' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                    Pengeluaran
                </a>
            </div>
        </div>

        @if ($role === 'admin')
        <a href="{{ route('realisasi.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 {{ request()->routeIs('realisasi*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Realisasi
        </a>

        <a href="{{ route('header-belanja.index') }}"
            class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 {{ request()->routeIs('header-belanja*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Laporan
        </a>
        @endif

        <!-- Spacer -->
        <div class="pt-4 mt-2 border-t border-slate-200/60"></div>

        @if ($role === 'admin')
        <a href="{{ route('admin.setting') }}"
            class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 {{ request()->routeIs('admin.setting') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Pengaturan Pagu
        </a>
        @endif

        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 {{ request()->routeIs('profile.edit') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Profil Saya
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium rounded-xl text-slate-600 hover:bg-red-50 hover:text-red-600 transition-all duration-150">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Keluar
            </button>
        </form>
    </nav>
</div>