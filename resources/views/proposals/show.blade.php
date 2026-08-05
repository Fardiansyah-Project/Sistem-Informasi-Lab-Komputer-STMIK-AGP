@extends('layouts.app')

@section('title', 'Detail Pengajuan')
@section('page-title', 'Detail Pengajuan')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('proposals.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Pengajuan
            </a>
            <div class="flex gap-2">
                <a href="{{ route('proposals.print', $proposal) }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Surat
                </a>
                <a href="{{ route('proposals.exportPdf', $proposal) }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Ekspor PDF
                </a>
            </div>
        </div>

        {{-- Informasi Surat --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 mb-6">
            <h2 class="text-xl font-bold text-slate-900 mb-6">Informasi Surat</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-8">
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Nomor Surat</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->nomor_surat }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Tanggal Surat</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->tanggal_surat->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Lampiran</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->lampiran }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Perihal</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->perihal }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Tujuan Surat</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->tujuan_surat }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Tembusan</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->tembusan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Pembuat</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->user->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Dibuat Pada</p>
                    <p class="text-sm font-semibold text-slate-800">{{ $proposal->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Daftar Barang --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-base font-semibold text-slate-900">Daftar Barang yang Diajukan</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">No
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Nama Barang</th>
                            <th class="text-center px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Jumlah</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Ruang Tujuan</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($proposal->details as $index => $detail)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-3 text-sm text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 text-sm font-medium text-slate-800">{{ $detail->nama_barang }}</td>
                                <td class="px-6 py-3 text-sm text-slate-700 text-center font-semibold">
                                    {{ $detail->jumlah }}</td>
                                <td class="px-6 py-3 text-sm text-slate-500">{{ $detail->laboratory->nama_lab ?? '-' }}
                                </td>
                                <td class="px-6 py-3 text-sm text-slate-400">{{ $detail->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
