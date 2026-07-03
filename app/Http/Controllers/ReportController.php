<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Laboratory;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Laporan rekapitulasi inventaris per laboratorium.
     */
    public function inventoryReport(Request $request)
    {
        $laboratories = Laboratory::withCount('inventories')
            ->with(['inventories' => function ($query) {
                $query->select('id', 'laboratorium_id', 'kondisi', 'jumlah');
            }])
            ->get()
            ->map(function ($lab) {
                $lab->total_barang = $lab->inventories->sum('jumlah');
                $lab->barang_baik = $lab->inventories->where('kondisi', 'Baik')->sum('jumlah');
                $lab->barang_rusak = $lab->inventories->where('kondisi', 'Rusak')->sum('jumlah');
                return $lab;
            });

        // Detail per lab jika filter aktif
        $selectedLab = null;
        $inventories = collect();

        if ($request->filled('laboratorium_id')) {
            $selectedLab = Laboratory::find($request->laboratorium_id);
            $inventories = Inventory::where('laboratorium_id', $request->laboratorium_id)->get();
        }

        return view('reports.inventories', compact('laboratories', 'selectedLab', 'inventories'));
    }

    /**
     * Laporan riwayat pengajuan berdasarkan rentang waktu.
     */
    public function proposalReport(Request $request)
    {
        $query = Proposal::with(['user', 'details']);

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_surat', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_surat', '<=', $request->end_date);
        }

        $proposals = $query->latest('tanggal_surat')->get();

        return view('reports.proposals', compact('proposals'));
    }

    /**
     * Ekspor laporan inventaris ke PDF.
     */

    public function exportInventoriesPdf(Request $request)
    {
        $selectedLab = null;
        $inventories = collect();

        if ($request->filled('laboratorium_id')) {
            $selectedLab = Laboratory::find($request->laboratorium_id);
            $inventories = Inventory::where('laboratorium_id', $request->laboratorium_id)->get();
        }

        $pdf = Pdf::loadView('reports.inventories-pdf', compact('selectedLab', 'inventories'));

        return $pdf->download('Laporan_Inventaris.pdf');
    }

    /**
     * Ekspor laporan pengajuan ke PDF.
     */
    public function exportProposalsPdf(Request $request)
    {
        $query = Proposal::with(['user', 'details']);

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_surat', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_surat', '<=', $request->end_date);
        }

        $proposals = $query->latest('tanggal_surat')->get();

        $pdf = Pdf::loadView('reports.proposals-pdf', compact('proposals'));

        return $pdf->download('Laporan_Pengajuan.pdf');
    }
}
