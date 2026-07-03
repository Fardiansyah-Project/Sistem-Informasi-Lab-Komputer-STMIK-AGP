<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Laboratory;
use App\Models\Proposal;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Inventory::sum('jumlah');
        $totalLab = Laboratory::count();
        $totalPengajuan = Proposal::count();
        $barangRusak = Inventory::where('kondisi', 'Rusak')->sum('jumlah');

        $latestInventories = Inventory::with('laboratory')
            ->latest()
            ->take(5)
            ->get();

        $latestProposals = Proposal::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalLab',
            'totalPengajuan',
            'barangRusak',
            'latestInventories',
            'latestProposals'
        ));
    }
}
