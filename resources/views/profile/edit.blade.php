<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        {{-- Profile Information --}}
        <div class="card">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Profil Saya</h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="input-field">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Instansi</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input-field">
                </div>

                <div>
                    <label for="nip" class="block text-sm font-medium text-slate-700 mb-1.5">NIP</label>
                    <input type="text" id="nip" name="nip" value="{{ old('nip', $user->nip) }}" class="input-field bg-slate-50" readonly>
                    <p class="text-xs text-slate-400 mt-1">NIP tidak dapat diubah</p>
                </div>

                <div>
                    <label for="unit" class="block text-sm font-medium text-slate-700 mb-1.5">Unit Kerja</label>
                    <select id="unit" name="unit" class="input-field">
                        <option value="Sekretariat" {{ old('unit', $user->unit) == 'Sekretariat' ? 'selected' : '' }}>Sekretariat Daerah</option>
                        <option value="Dinas Pendidikan" {{ old('unit', $user->unit) == 'Dinas Pendidikan' ? 'selected' : '' }}>Dinas Pendidikan</option>
                        <option value="Dinas Kesehatan" {{ old('unit', $user->unit) == 'Dinas Kesehatan' ? 'selected' : '' }}>Dinas Kesehatan</option>
                        <option value="Dinas PUPR" {{ old('unit', $user->unit) == 'Dinas PUPR' ? 'selected' : '' }}>Dinas PUPR</option>
                        <option value="Bappeda" {{ old('unit', $user->unit) == 'Bappeda' ? 'selected' : '' }}>Bappeda</option>
                        <option value="Inspektorat" {{ old('unit', $user->unit) == 'Inspektorat' ? 'selected' : '' }}>Inspektorat</option>
                    </select>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="btn-primary">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="card">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Ubah Kata Sandi</h2>

            <form method="POST" action="{{ route('profile.password') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="input-field">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" class="input-field">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-field">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="btn-primary">
                        Ubah Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>