{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Profil Saya</h2>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                            Instansi</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip', $user->nip) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                        <p class="text-xs text-gray-500 mt-1">NIP tidak dapat diubah</p>
                    </div>

                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                        <select id="unit" name="unit"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition bg-white">
                            <option value="Sekretariat"
                                {{ old('unit', $user->unit) == 'Sekretariat' ? 'selected' : '' }}>Sekretariat Daerah
                            </option>
                            <option value="Dinas Pendidikan"
                                {{ old('unit', $user->unit) == 'Dinas Pendidikan' ? 'selected' : '' }}>Dinas Pendidikan
                            </option>
                            <option value="Dinas Kesehatan"
                                {{ old('unit', $user->unit) == 'Dinas Kesehatan' ? 'selected' : '' }}>Dinas Kesehatan
                            </option>
                            <option value="Dinas PUPR" {{ old('unit', $user->unit) == 'Dinas PUPR' ? 'selected' : '' }}>
                                Dinas PUPR</option>
                            <option value="Bappeda" {{ old('unit', $user->unit) == 'Bappeda' ? 'selected' : '' }}>
                                Bappeda</option>
                            <option value="Inspektorat"
                                {{ old('unit', $user->unit) == 'Inspektorat' ? 'selected' : '' }}>Inspektorat</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded-lg transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Ubah Kata Sandi</h2>

                <form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi
                            Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi
                            Baru</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded-lg transition">
                            Ubah Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
