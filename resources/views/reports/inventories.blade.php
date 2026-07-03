@extends('layouts.app')

@section('title', 'Laporan Inventaris')
@section('page-title', 'Laporan Inventaris')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div>
        <h2 class="text-xl font-bold text-slate-900">Laporan Rekapitulasi Inventaris</h2>
        <p class="text-sm text-slate-500 mt-0.5">Ringkasan kondisi barang di setiap laboratorium</p>
    </div>

    {{-- Overview Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @foreach($laboratories as $lab)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">{{ $lab->nama_lab }}</h3>
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div class="bg-slate-50 p-2.5 rounded-xl">
                        <p class="text-xs text-slate-400">Total</p>
                        <p class="text-lg font-bold text-slate-800">{{ $lab->total_barang }}</p>
                    </div>
                    <div class="bg-emerald-50/50 p-2.5 rounded-xl">
                        <p class="text-xs text-emerald-600">Baik</p>
                        <p class="text-lg font-bold text-emerald-700">{{ $lab->barang_baik }}</p>
                    </div>
                    <div class="bg-rose-50/50 p-2.5 rounded-xl">
                        <p class="text-xs text-rose-600">Rusak</p>
                        <p class="text-lg font-bold text-rose-700">{{ $lab->barang_rusak }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Detail Filter --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5">
        <h3 class="text-sm font-semibold text-slate-900 mb-4">Tampilkan Rincian Barang</h3>
        <form method="GET" action="{{ route('reports.inventories') }}" class="flex flex-col sm:flex-row gap-3">
            <select name="laboratorium_id" required
                    class="flex-1 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
                <option value="">Pilih Laboratorium</option>
                @foreach($laboratories as $lab)
                    <option value="{{ $lab->id }}" {{ request('laboratorium_id') == $lab->id ? 'selected' : '' }}>
                        {{ $lab->nama_lab }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-colors">
                Tampilkan Rincian
            </button>
            @if(request('laboratorium_id'))
                <a href="{{ route('reports.inventories') }}"
                   class="px-5 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors text-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Detailed Inventory Table --}}
    @if($selectedLab)
        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden animate-slide-down">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-slate-900">Rincian Barang: {{ $selectedLab->nama_lab }}</h3>
                <button onclick="window.print()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition-colors print:hidden">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak Rincian
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kode</th>
                            <th class="text-left px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="text-center px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
                            <th class="text-center px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($inventories as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex px-2 py-0.5 bg-slate-100 rounded text-xs font-mono font-semibold text-slate-600">
                                        {{ $item->kode_barang }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-sm font-medium text-slate-800">{{ $item->nama_barang }}</td>
                                <td class="px-6 py-3.5 text-sm text-slate-700 text-center font-semibold">{{ $item->jumlah }}</td>
                                <td class="px-6 py-3.5 text-center">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold
                                        {{ $item->kondisi === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-400 text-sm">
                                    Tidak ada data barang di laboratorium ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
