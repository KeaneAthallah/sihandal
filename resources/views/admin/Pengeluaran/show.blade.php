<x-app-layout>
    <div class="container mx-auto py-6 max-w-xl">
        <h1 class="text-xl font-semibold mb-4">Detail Permintaan Pengeluaran</h1>

        <dl class="space-y-2 mb-6">
            <div>
                <dt class="font-medium">SKPD</dt>
                <dd>{{ $pengeluaran->sumberdana->nm_skpd }}</dd>
            </div>
            <div>
                <dt class="font-medium">Rekening</dt>
                <dd>{{ $pengeluaran->sumberdana->nm_rek }}</dd>
            </div>
            <div>
                <dt class="font-medium">Diajukan Oleh</dt>
                <dd>{{ $pengeluaran->user->name }}</dd>
            </div>
            <div>
                <dt class="font-medium">Tanggal</dt>
                <dd>{{ $pengeluaran->tanggal->format('d-m-Y') }}</dd>
            </div>
            <div>
                <dt class="font-medium">Jumlah</dt>
                <dd>{{ number_format($pengeluaran->jumlah, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="font-medium">Keterangan</dt>
                <dd>{{ $pengeluaran->keterangan }}</dd>
            </div>
            <div>
                <dt class="font-medium">Status</dt>
                <dd>{{ ucfirst($pengeluaran->status) }}</dd>
            </div>

            @if ($pengeluaran->status !== 'pending')
                <div>
                    <dt class="font-medium">Diproses Oleh</dt>
                    <dd>{{ $pengeluaran->approver->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-medium">Diproses Pada</dt>
                    <dd>{{ $pengeluaran->approved_at?->format('d-m-Y H:i') }}</dd>
                </div>
            @endif

            @if ($pengeluaran->status === 'rejected')
                <div>
                    <dt class="font-medium">Alasan Ditolak</dt>
                    <dd>{{ $pengeluaran->rejection_reason }}</dd>
                </div>
            @endif
        </dl>

        @can('approve-pengeluaran', $pengeluaran)
            @if ($pengeluaran->status === 'pending')
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('pengeluaran.approve', $pengeluaran) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                            Setujui
                        </button>
                    </form>

                    <button type="button" onclick="document.getElementById('rejectForm').classList.toggle('hidden')"
                        class="px-4 py-2 bg-red-600 text-white rounded">
                        Tolak
                    </button>
                </div>

                <form id="rejectForm" method="POST" action="{{ route('pengeluaran.reject', $pengeluaran) }}"
                    class="hidden mt-3">
                    @csrf
                    <textarea name="rejection_reason" placeholder="Alasan penolakan..." class="w-full border rounded px-3 py-2" required></textarea>
                    @error('rejection_reason')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="mt-2 px-4 py-2 bg-red-600 text-white rounded">
                        Konfirmasi Tolak
                    </button>
                </form>
            @endif
        @endcan

        <a href="{{ route('pengeluaran.index') }}" class="inline-block mt-4 text-blue-600">
            &larr; Kembali
        </a>
    </div>
</x-app-layout>
