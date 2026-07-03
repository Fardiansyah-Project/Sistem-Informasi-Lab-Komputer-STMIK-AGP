@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <x-stat-card
            title="Total Barang"
            :value="number_format($totalBarang)"
            color="indigo"
            subtitle="Unit inventaris"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            title="Laboratorium"
            :value="number_format($totalLab)"
            color="emerald"
            subtitle="Ruang aktif"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            title="Pengajuan"
            :value="number_format($totalPengajuan)"
            color="amber"
            subtitle="Surat masuk"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card
            title="Barang Rusak"
            :value="number_format($barangRusak)"
            color="rose"
            subtitle="Perlu perhatian"
        >
            <x-slot:icon>
                <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </x-slot:icon>
        </x-stat-card>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        {{-- Latest Inventories --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="text-base font-semibold text-slate-900">Inventaris Terbaru</h3>
                <a href="{{ route('inventories.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                    Lihat Semua →
                </a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($latestInventories as $item)
                    <div class="flex items-center justify-between px-6 py-3.5 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg {{ $item->kondisi === 'Baik' ? 'bg-emerald-50' : 'bg-rose-50' }} flex items-center justify-center">
                                <span class="text-xs font-bold {{ $item->kondisi === 'Baik' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ substr($item->kode_barang, 0, 2) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $item->nama_barang }}</p>
                                <p class="text-xs text-slate-400">{{ $item->laboratory->nama_lab }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $item->kondisi === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                {{ $item->kondisi }}
                            </span>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $item->jumlah }} unit</p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-400 text-sm">
                        Belum ada data inventaris.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Latest Proposals --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="text-base font-semibold text-slate-900">Pengajuan Terbaru</h3>
                <a href="{{ route('proposals.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                    Lihat Semua →
                </a>
            </div>
            <div class="divide-y divide-slate-50">
                @forelse($latestProposals as $proposal)
                    <div class="flex items-center justify-between px-6 py-3.5 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $proposal->perihal }}</p>
                                <p class="text-xs text-slate-400">{{ $proposal->nomor_surat }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-500">{{ $proposal->tanggal_surat->format('d/m/Y') }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $proposal->user->name ?? '-' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-400 text-sm">
                        Belum ada data pengajuan.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
