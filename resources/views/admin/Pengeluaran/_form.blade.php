<div>
    <label class="block mb-1 font-medium">Sumber Dana</label>
    <select name="sumberdana_id" class="w-full border rounded px-3 py-2">
        <option value="">-- Pilih Sumber Dana --</option>
        @foreach ($sumberdanas as $sd)
            <option value="{{ $sd->id }}"
                {{ old('sumberdana_id', $pengeluaran->sumberdana_id ?? '') == $sd->id ? 'selected' : '' }}>
                {{ $sd->nm_skpd }} - {{ $sd->nm_rek }}
            </option>
        @endforeach
    </select>
    @error('sumberdana_id')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block mb-1 font-medium">Tanggal</label>
    <input type="date" name="tanggal"
        value="{{ old('tanggal', isset($pengeluaran) ? $pengeluaran->tanggal->format('Y-m-d') : '') }}"
        class="w-full border rounded px-3 py-2">
    @error('tanggal')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block mb-1 font-medium">Jumlah</label>
    <input type="number" step="0.01" name="jumlah" value="{{ old('jumlah', $pengeluaran->jumlah ?? '') }}"
        class="w-full border rounded px-3 py-2">
    @error('jumlah')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block mb-1 font-medium">Keterangan</label>
    <textarea name="keterangan" class="w-full border rounded px-3 py-2">{{ old('keterangan', $pengeluaran->keterangan ?? '') }}</textarea>
    @error('keterangan')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>
