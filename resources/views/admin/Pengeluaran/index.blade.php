<x-app-layout>
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold">Permintaan Pengeluaran</h1>
            <a href="{{ route('pengeluaran.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                Ajukan Pengeluaran
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari SKPD, rekening, atau keterangan..." class="border rounded px-3 py-2 flex-1">
            <select name="status" class="border rounded px-3 py-2">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-200 rounded">Filter</button>
        </form>

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Tanggal</th>
                    <th class="border p-2 text-left">SKPD</th>
                    <th class="border p-2 text-left">Diajukan Oleh</th>
                    <th class="border p-2 text-right">Jumlah</th>
                    <th class="border p-2 text-center">Status</th>
                    <th class="border p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengeluarans as $item)
                    <tr>
                        <td class="border p-2">{{ $item->tanggal->format('d-m-Y') }}</td>
                        <td class="border p-2">{{ $item->sumberdana->nm_skpd }}</td>
                        <td class="border p-2">{{ $item->user->name }}</td>
                        <td class="border p-2 text-right">
                            {{ number_format($item->jumlah, 2, ',', '.') }}
                        </td>
                        <td class="border p-2 text-center">
                            @php
                                $badge = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                ][$item->status];
                            @endphp
                            <span class="px-2 py-1 rounded text-xs {{ $badge }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="border p-2 text-center space-x-2">
                            <a href="{{ route('pengeluaran.show', $item) }}" class="text-blue-600">Lihat</a>
                            @if ($item->status === 'pending' && $item->user_id === auth()->id())
                                <a href="{{ route('pengeluaran.edit', $item) }}" class="text-yellow-600">Edit</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border p-4 text-center text-gray-500">
                            Belum ada permintaan pengeluaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $pengeluarans->links() }}
        </div>
    </div>
</x-app-layout>
