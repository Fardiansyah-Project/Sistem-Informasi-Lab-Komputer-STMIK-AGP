<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReportController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Resource Routes
Route::resource('inventories', InventoryController::class);
Route::resource('laboratories', LaboratoryController::class);
Route::resource('proposals', ProposalController::class)->except(['edit', 'update']);

// Cetak Surat Pengajuan
Route::get('proposals/{proposal}/print', [ProposalController::class, 'print'])->name('proposals.print');
Route::get('proposals/{proposal}/pdf', [ProposalController::class, 'exportPdf'])->name('proposals.exportPdf');

// Laporan
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/inventories', [ReportController::class, 'inventoryReport'])->name('inventories');
    Route::get('/inventories/pdf', [ReportController::class, 'exportInventoriesPdf'])->name('inventories.pdf');
    Route::get('/proposals', [ReportController::class, 'proposalReport'])->name('proposals');
    Route::get('/proposals/pdf', [ReportController::class, 'exportProposalsPdf'])->name('proposals.pdf');
});
