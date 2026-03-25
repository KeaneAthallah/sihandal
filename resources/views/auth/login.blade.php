{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-bold text-gray-800">Portal Internal Pemerintah</h2>
        <p class="text-sm text-gray-600 mt-1">Masuk ke akun Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email / NIP</label>
            <input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="email" name="email" :value="old('email')" required autofocus />
            @error('email')
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

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif

            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-md">
                Masuk
            </button>
        </div>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-700 font-medium hover:underline">Daftar sekarang</a>
        </div>
    </form>
</x-guest-layout>
