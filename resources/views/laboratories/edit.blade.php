@extends('layouts.app')

@section('title', 'Edit Laboratorium')
@section('page-title', 'Edit Laboratorium')

@section('content')
<div class="max-w-lg">
    <div class="mb-6">
        <a href="{{ route('laboratories.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Laboratorium
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900">Edit Laboratorium</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui informasi <span class="font-semibold text-slate-700">{{ $laboratory->nama_lab }}</span></p>
        </div>

        <form method="POST" action="{{ route('laboratories.update', $laboratory) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_lab" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Laboratorium</label>
                <input type="text" name="nama_lab" id="nama_lab" value="{{ old('nama_lab', $laboratory->nama_lab) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>

            <div>
                <label for="lokasi" class="block text-sm font-medium text-slate-700 mb-1.5">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $laboratory->lokasi) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all duration-200">
                    Perbarui Lab
                </button>
                <a href="{{ route('laboratories.index') }}"
                   class="px-6 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
