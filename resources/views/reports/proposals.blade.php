@extends('layouts.app')

@section('title', 'Laporan Pengajuan')
@section('page-title', 'Laporan Pengajuan')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div>
        <h2 class="text-xl font-bold text-slate-900">Laporan Riwayat Pengajuan</h2>
        <p class="text-sm text-slate-500 mt-0.5">Filter dan ekspor riwayat pengadaan barang</p>
    </div>

    {{-- Filter Form --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5">
        <form method="GET" action="{{ route('reports.proposals') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
            <div>
                <label for="start_date" class="block text-xs font-medium text-slate-500 mb-1.5">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                       class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>
            <div>
                <label for="end_date" class="block text-xs font-medium text-slate-500 mb-1.5">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                       class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-colors text-center">
                    Filter
                </button>
                @if(request('start_date') || request('end_date'))
                    <a href="{{ route('reports.proposals') }}"
                       class="px-5 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors text-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Results Table --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-base font-semibold text-slate-900">Riwayat Pengajuan</h3>
            @if($proposals->count() > 0)
                <button onclick="window.print()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition-colors print:hidden">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak Laporan
                </button>
            @endif
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Surat</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Perihal</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pembuat</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Daftar Barang</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($proposals as $proposal)
                        <tr class="hover:bg-slate-50/50 transition-colors align-top">
                            <td class="px-6 py-4 text-sm font-mono font-semibold text-slate-600">{{ $proposal->nomor_surat }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $proposal->perihal }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $proposal->tanggal_surat->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $proposal->user->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <ul class="list-disc list-inside text-xs text-slate-600 space-y-1">
                                    @foreach($proposal->details as $detail)
                                        <li>{{ $detail->nama_barang }} ({{ $detail->jumlah }} unit)</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">
                                Tidak ada data pengajuan dalam rentang waktu terpilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
