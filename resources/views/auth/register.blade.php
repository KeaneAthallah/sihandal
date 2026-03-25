{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-bold text-gray-800">Daftar Akun Baru</h2>
        <p class="text-sm text-gray-600 mt-1">Registrasi untuk Aparatur Sipil Negara</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input id="name"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="text" name="name" :value="old('name')" required autofocus />
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Instansi</label>
            <input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="email" name="email" :value="old('email')" required />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
            <input id="nip"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="text" name="nip" :value="old('nip')" required />
            @error('nip')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="unit" class="block text-sm font-medium text-gray-700">Unit Kerja</label>
            <select id="unit" name="unit"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                <option value="">Pilih Unit Kerja</option>
                <option value="Sekretariat">Sekretariat Daerah</option>
                <option value="Dinas Pendidikan">Dinas Pendidikan</option>
                <option value="Dinas Kesehatan">Dinas Kesehatan</option>
                <option value="Dinas PUPR">Dinas PUPR</option>
                <option value="Bappeda">Bappeda</option>
                <option value="Inspektorat">Inspektorat</option>
            </select>
            @error('unit')
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

        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata
                Sandi</label>
            <input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                type="password" name="password_confirmation" required />
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit"
                class="ms-4 bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-md">
                Daftar
            </button>
        </div>
    </form>
</x-guest-layout>
