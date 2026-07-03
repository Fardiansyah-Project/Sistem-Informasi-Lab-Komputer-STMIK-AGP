@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('page-title', 'Tambah Inventaris')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('inventories.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Inventaris
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Tambah Barang Baru</h2>
            <p class="text-sm text-slate-500 mt-1">Masukkan informasi barang inventaris laboratorium</p>
        </div>

        <form method="POST" action="{{ route('inventories.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Kode Barang --}}
                <div>
                    <label for="kode_barang" class="block text-sm font-medium text-slate-700 mb-1.5">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang') }}" required placeholder="HW-001"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                </div>

                {{-- Nama Barang --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" required placeholder="Komputer Desktop"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                {{-- Jumlah --}}
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-slate-700 mb-1.5">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" required min="0"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                </div>

                {{-- Kondisi --}}
                <div>
                    <label for="kondisi" class="block text-sm font-medium text-slate-700 mb-1.5">Kondisi</label>
                    <select name="kondisi" id="kondisi" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                        <option value="Baik" {{ old('kondisi') === 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak" {{ old('kondisi') === 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>

                {{-- Laboratorium --}}
                <div>
                    <label for="laboratorium_id" class="block text-sm font-medium text-slate-700 mb-1.5">Laboratorium</label>
                    <select name="laboratorium_id" id="laboratorium_id" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                        <option value="">Pilih Lab</option>
                        @foreach($laboratories as $lab)
                            <option value="{{ $lab->id }}" {{ old('laboratorium_id') == $lab->id ? 'selected' : '' }}>
                                {{ $lab->nama_lab }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all duration-200">
                    Simpan Barang
                </button>
                <a href="{{ route('inventories.index') }}"
                   class="px-6 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
