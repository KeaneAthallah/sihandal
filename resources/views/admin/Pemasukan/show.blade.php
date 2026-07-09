<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $pr = auth()->user()->role === 'admin' ? 'admin' : 'user';
                $model = $pemasukan;
            @endphp

            {{-- Header --}}
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Detail Pemasukan</h1>
                    <p class="text-sm text-slate-500 mt-1">Informasi lengkap permintaan pemasukan</p>
                </div>
                <span class="badge {{ \App\Models\Pemasukan::statusColor($model->status) }} text-sm px-4 py-1.5">
                    {{ \App\Models\Pemasukan::statusLabel($model->status) }}
                </span>
            </div>

            {{-- Alert Messages --}}
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Workflow Timeline --}}
            <div class="card mb-6">
                <h3 class="text-sm font-semibold text-slate-800 mb-4">Alur Persetujuan</h3>
                <div class="flex flex-wrap items-center gap-0">
                    @php
                        $steps = [
                            ['status' => 'pending', 'label' => 'Diajukan'],
                            ['status' => 'approved_1', 'label' => 'Disetujui Lv.1'],
                            ['status' => 'docs_1_uploaded', 'label' => 'Dok.1 Diupload'],
                            ['status' => 'approved_2', 'label' => 'Disetujui Lv.2'],
                            ['status' => 'docs_2_uploaded', 'label' => 'Dok.2 Diupload'],
                            ['status' => 'completed', 'label' => 'Selesai'],
                        ];
                        $currentIdx = array_search($model->status, array_column($steps, 'status'));
                        if ($currentIdx === false) $currentIdx = -1;
                        $isRejected = $model->status === 'rejected';
                    @endphp

                    @foreach ($steps as $i => $step)
                        @php
                            $done = $i <= $currentIdx;
                            $isCurrent = $i === $currentIdx;
                        @endphp
                        <div class="flex items-center flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0
                                    {{ $isRejected && $isCurrent ? 'bg-red-100 text-red-700' : ($done ? 'bg-primary-100 text-primary-700' : 'bg-slate-100 text-slate-400') }}">
                                    @if ($isRejected && $isCurrent)
                                        ✕
                                    @elseif ($done)
                                        ✓
                                    @else
                                        {{ $i + 1 }}
                                    @endif
                                </div>
                                <span class="text-xs {{ $isCurrent ? 'font-semibold text-slate-800' : ($done ? 'text-slate-600' : 'text-slate-400') }} whitespace-nowrap">
                                    {{ $step['label'] }}
                                </span>
                            </div>
                            @if (!$loop->last)
                                <div class="flex-1 h-px mx-2 {{ $i < $currentIdx ? 'bg-primary-300' : 'bg-slate-200' }}"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if ($isRejected)
                    <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                        <strong>Ditolak:</strong> {{ $model->rejection_reason ?? '-' }}
                    </div>
                @endif
                @if ($model->status === 'completed')
                    <div class="mt-3 p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700">
                        Dana sebesar <strong>Rp {{ number_format($model->jumlah, 0, ',', '.') }}</strong> telah dikurangkan dari pagu sumber dana.
                    </div>
                @endif
            </div>

            {{-- Detail Info --}}
            <div class="card mb-6">
                <h3 class="text-base font-semibold text-slate-800 mb-4">Informasi Pemasukan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wide mb-1">Tanggal</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $model->tanggal->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wide mb-1">Jumlah</p>
                        <p class="text-lg font-bold text-emerald-700">Rp {{ number_format($model->jumlah, 2, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wide mb-1">Sumber Dana</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $model->sumberdana->nm_skpd ?? '-' }}</p>
                        <p class="text-xs text-slate-500">{{ $model->sumberdana->nm_rek ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wide mb-1">Diajukan Oleh</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $model->user->name }}</p>
                        <p class="text-xs text-slate-500">{{ $model->user->email }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs font-medium text-slate-400 uppercase tracking-wide mb-1">Keterangan</p>
                        <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl">{{ $model->keterangan ?? '-' }}</p>
                    </div>
                </div>

                @if ($model->status !== 'pending' && $model->status !== 'rejected' && $model->approver)
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <h4 class="text-sm font-semibold text-slate-700 mb-3">Riwayat Persetujuan</h4>
                        <div class="text-xs text-slate-500">
                            Diproses oleh <span class="font-medium text-slate-700">{{ $model->approver->name }}</span>
                            pada {{ $model->approved_at?->format('d F Y H:i') ?? '-' }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Dokumen Pendukung --}}
            <div class="card mb-6">
                <h3 class="text-base font-semibold text-slate-800 mb-4">Dokumen Pendukung</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Dokumen 1 --}}
                    <div class="bg-slate-50 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-medium text-slate-700">Dokumen Pendukung 1</h4>
                            <span class="text-xs {{ $model->document_1_path ? 'text-emerald-600' : 'text-slate-400' }}">
                                {{ $model->document_1_path ? 'Sudah' : 'Belum' }} diupload
                            </span>
                        </div>
                        @if ($model->document_1_path)
                            <p class="text-xs text-slate-500 mb-2">{{ $model->document_1_name }}</p>
                            <a href="{{ route($pr . '.pemasukan.download-document', [$model, 1]) }}"
                               class="inline-flex items-center gap-1 text-xs font-medium text-primary-600 hover:text-primary-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download Dokumen
                            </a>
                        @else
                            <p class="text-xs text-slate-400">Belum ada dokumen</p>
                        @endif
                    </div>

                    {{-- Dokumen 2 --}}
                    <div class="bg-slate-50 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm font-medium text-slate-700">Dokumen Pendukung 2</h4>
                            <span class="text-xs {{ $model->document_2_path ? 'text-emerald-600' : 'text-slate-400' }}">
                                {{ $model->document_2_path ? 'Sudah' : 'Belum' }} diupload
                            </span>
                        </div>
                        @if ($model->document_2_path)
                            <p class="text-xs text-slate-500 mb-2">{{ $model->document_2_name }}</p>
                            <a href="{{ route($pr . '.pemasukan.download-document', [$model, 2]) }}"
                               class="inline-flex items-center gap-1 text-xs font-medium text-primary-600 hover:text-primary-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download Dokumen
                            </a>
                        @else
                            <p class="text-xs text-slate-400">Belum ada dokumen</p>
                        @endif
                    </div>
                </div>

                {{-- Upload Form for User --}}
                @if (auth()->user()->role !== 'admin' && $model->user_id === auth()->id())
                    @if ($model->status === \App\Models\Pemasukan::STATUS_APPROVED_1)
                        <div class="mt-4 p-4 bg-primary-50 border border-primary-200 rounded-xl">
                            <h4 class="text-sm font-semibold text-primary-800 mb-2">Upload Dokumen Pendukung 1</h4>
                            <form action="{{ route('user.pemasukan.upload-document', [$model, 1]) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-end gap-3">
                                @csrf
                                <div class="flex-1 min-w-0">
                                    <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required
                                           class="block w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                    <p class="text-xs text-slate-400 mt-1">Maks. 5MB (PDF, JPG, PNG, DOC)</p>
                                </div>
                                <button type="submit" class="btn-primary text-sm">Upload</button>
                            </form>
                        </div>
                    @elseif ($model->status === \App\Models\Pemasukan::STATUS_APPROVED_2)
                        <div class="mt-4 p-4 bg-primary-50 border border-primary-200 rounded-xl">
                            <h4 class="text-sm font-semibold text-primary-800 mb-2">Upload Dokumen Pendukung 2</h4>
                            <form action="{{ route('user.pemasukan.upload-document', [$model, 2]) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-end gap-3">
                                @csrf
                                <div class="flex-1 min-w-0">
                                    <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required
                                           class="block w-full text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                    <p class="text-xs text-slate-400 mt-1">Maks. 5MB (PDF, JPG, PNG, DOC)</p>
                                </div>
                                <button type="submit" class="btn-primary text-sm">Upload</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-wrap gap-3">
                <a href="{{ route($pr . '.pemasukan.index') }}"
                   class="btn-secondary text-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>

                @if ($model->status === 'pending' && $model->user_id === auth()->id())
                    <a href="{{ route($pr . '.pemasukan.edit', $model) }}" class="btn-secondary text-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                @endif

                @if (auth()->user()->role === 'admin')
                    @if (in_array($model->status, [\App\Models\Pemasukan::STATUS_PENDING, \App\Models\Pemasukan::STATUS_DOCS_1_UPLOADED, \App\Models\Pemasukan::STATUS_DOCS_2_UPLOADED]))
                        <form action="{{ route('admin.pemasukan.approve', $model) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" onclick="return confirm('{{ $model->status === \App\Models\Pemasukan::STATUS_DOCS_2_UPLOADED ? 'Selesaikan dan kurangkan dana dari pagu?' : 'Setujui permintaan ini?' }}')"
                                    class="btn-primary text-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $model->status === \App\Models\Pemasukan::STATUS_DOCS_2_UPLOADED ? 'Setujui & Selesaikan' : 'Setujui' }}
                            </button>
                        </form>

                        <button onclick="showRejectModal()" class="btn-secondary text-sm text-red-600 border-red-200 hover:bg-red-50 hover:border-red-300">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Tolak
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{-- Reject Modal --}}
    @if (auth()->user()->role === 'admin' && in_array($model->status, [\App\Models\Pemasukan::STATUS_PENDING, \App\Models\Pemasukan::STATUS_DOCS_1_UPLOADED, \App\Models\Pemasukan::STATUS_DOCS_2_UPLOADED]))
        <div id="rejectModal" class="fixed inset-0 bg-slate-900/40 hidden overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-6 w-full max-w-md rounded-2xl bg-white shadow-xl">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Tolak Pemasukan</h3>
                <form method="POST" action="{{ route('admin.pemasukan.reject', $model) }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alasan Penolakan</label>
                        <textarea name="rejection_reason" rows="4" required
                                  class="input-field"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeRejectModal()" class="btn-secondary text-sm">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition-all text-sm">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function showRejectModal() {
                document.getElementById('rejectModal').classList.remove('hidden');
            }
            function closeRejectModal() {
                document.getElementById('rejectModal').classList.add('hidden');
            }
            window.onclick = function(event) {
                if (event.target.classList.contains('fixed')) {
                    closeRejectModal();
                }
            }
        </script>
    @endif
</x-app-layout>