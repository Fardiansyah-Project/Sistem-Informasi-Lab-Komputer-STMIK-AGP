@extends('layouts.app')

@section('title', 'Buat Pengajuan')
@section('page-title', 'Buat Pengajuan Baru')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('proposals.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Pengajuan
            </a>
        </div>

        <form method="POST" action="{{ route('proposals.store') }}" id="proposal-form">
            @csrf

            {{-- Informasi Surat --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 mb-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Informasi Surat</h2>
                    <p class="text-sm text-slate-500 mt-1">Data header surat permohonan pengadaan barang</p>
                </div>

                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="nomor_surat" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor
                                Surat</label>
                            <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}"
                                required placeholder="001/UPT-LAB/VII/2026"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                        </div>
                        <div>
                            <label for="tanggal_surat" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal
                                Surat</label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat"
                                value="{{ old('tanggal_surat', date('Y-m-d')) }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="lampiran" class="block text-sm font-medium text-slate-700 mb-1.5">Lampiran</label>
                            <input type="text" name="lampiran" id="lampiran"
                                value="{{ old('lampiran', '1 (satu) lembar') }}" required placeholder="1 (satu) lembar"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                        </div>
                        <div>
                            <label for="perihal" class="block text-sm font-medium text-slate-700 mb-1.5">Perihal</label>
                            <input type="text" name="perihal" id="perihal"
                                value="{{ old('perihal', 'Permohonan Pengadaan Barang') }}" required
                                placeholder="Permohonan Pengadaan Barang"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="tujuan_surat" class="block text-sm font-medium text-slate-700 mb-1.5">Tujuan Surat
                                (Kepada Yth.)</label>
                            <input type="text" name="tujuan_surat" id="tujuan_surat"
                                value="{{ old('tujuan_surat', 'Ketua STMIK Adhi Guna') }}" required
                                placeholder="Ketua STMIK Adhi Guna"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-sm font-medium text-slate-700">Tembusan</label>
                                <button type="button" id="add-tembusan-btn"
                                    class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Tembusan
                                </button>
                            </div>

                            <div id="tembusan-container" class="space-y-2">
                                <div class="tembusan-item flex items-center gap-2" data-index="0">
                                    <input type="text" name="tembusans[0][tembusan]" placeholder="Contoh: Wakil Ketua"
                                        value="{{ old('tembusans.0.tembusan') }}"
                                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                                    <button type="button"
                                        class="remove-tembusan-btn hidden p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all shrink-0"
                                        title="Hapus Tembusan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-slate-700 mb-1.5">Pembuat
                                Surat</label>
                            <select name="user_id" id="user_id" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                                <option value="">Pilih Pembuat</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} {{ $user->nidn ? '(' . $user->nidn . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Item --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Daftar Barang</h2>
                        <p class="text-sm text-slate-500 mt-1">Tambahkan item barang yang diajukan</p>
                    </div>
                    <button type="button" id="add-item-btn"
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 text-emerald-700 text-sm font-semibold rounded-xl hover:bg-emerald-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Item
                    </button>
                </div>

                <div id="items-container" class="space-y-4">
                    {{-- Item template (first item) --}}
                    <div class="item-card bg-slate-50 rounded-xl border border-slate-200 p-5 relative" data-index="0">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Item #<span
                                    class="item-number">1</span></span>
                            <button type="button"
                                class="remove-item-btn hidden p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                title="Hapus Item">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Nama Barang</label>
                                <input type="text" name="details[0][nama_barang]" required
                                    placeholder="Komputer Desktop"
                                    class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Jumlah</label>
                                <input type="number" name="details[0][jumlah]" required min="1" value="1"
                                    class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Ruang Tujuan</label>
                                <input type="text" name="details[0][ruang_tujuan]" required placeholder="Lab Hardware"
                                    class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Keterangan</label>
                                <input type="text" name="details[0][keterangan]" placeholder="Opsional"
                                    class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="px-8 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all duration-200">
                    Simpan Pengajuan
                </button>
                <a href="{{ route('proposals.index') }}"
                    class="px-6 py-3 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('items-container');
                const addBtn = document.getElementById('add-item-btn');
                let itemIndex = 1;

                addBtn.addEventListener('click', function() {
                    const newItem = document.createElement('div');
                    newItem.className =
                        'item-card bg-slate-50 rounded-xl border border-slate-200 p-5 relative animate-slide-down';
                    newItem.dataset.index = itemIndex;
                    newItem.innerHTML = `
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Item #<span class="item-number">${itemIndex + 1}</span></span>
                    <button type="button" class="remove-item-btn p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Hapus Item">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Nama Barang</label>
                        <input type="text" name="details[${itemIndex}][nama_barang]" required placeholder="Komputer Desktop"
                               class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Jumlah</label>
                        <input type="number" name="details[${itemIndex}][jumlah]" required min="1" value="1"
                               class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Ruang Tujuan</label>
                        <input type="text" name="details[${itemIndex}][ruang_tujuan]" required placeholder="Lab Hardware"
                               class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Keterangan</label>
                        <input type="text" name="details[${itemIndex}][keterangan]" placeholder="Opsional"
                               class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                    </div>
                </div>
            `;
                    container.appendChild(newItem);
                    itemIndex++;
                    updateRemoveButtons();
                });

                container.addEventListener('click', function(e) {
                    const removeBtn = e.target.closest('.remove-item-btn');
                    if (removeBtn) {
                        removeBtn.closest('.item-card').remove();
                        updateItemNumbers();
                        updateRemoveButtons();
                    }
                });

                function updateItemNumbers() {
                    const items = container.querySelectorAll('.item-card');
                    items.forEach((item, i) => {
                        item.querySelector('.item-number').textContent = i + 1;
                    });
                }

                function updateRemoveButtons() {
                    const items = container.querySelectorAll('.item-card');
                    items.forEach((item, i) => {
                        const btn = item.querySelector('.remove-item-btn');
                        if (items.length <= 1) {
                            btn.classList.add('hidden');
                        } else {
                            btn.classList.remove('hidden');
                        }
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const addBtn = document.getElementById('add-tembusan-btn');
                const tembusanContainer = document.getElementById('tembusan-container');
                let tembusanIndex = 1;

                addBtn.addEventListener('click', function() {
                    const newTembusan = document.createElement('div');
                    newTembusan.className = 'tembusan-item flex items-center gap-2 animate-slide-down';
                    newTembusan.dataset.index = tembusanIndex;
                    newTembusan.innerHTML = `
            <input type="text" name="tembusans[${tembusanIndex}][tembusan]" placeholder="Contoh: Wakil Ketua"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            <button type="button" class="remove-tembusan-btn p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all shrink-0" title="Hapus Tembusan">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
                    tembusanContainer.appendChild(newTembusan);
                    tembusanIndex++;
                    updateTembusanRemoveButtons();
                });

                tembusanContainer.addEventListener('click', function(e) {
                    const removeBtn = e.target.closest('.remove-tembusan-btn');
                    if (removeBtn) {
                        removeBtn.closest('.tembusan-item').remove();
                        updateTembusanRemoveButtons();
                    }
                });

                function updateTembusanRemoveButtons() {
                    const items = tembusanContainer.querySelectorAll('.tembusan-item');
                    items.forEach((item) => {
                        const btn = item.querySelector('.remove-tembusan-btn');
                        if (items.length <= 1) {
                            btn.classList.add('hidden');
                        } else {
                            btn.classList.remove('hidden');
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
