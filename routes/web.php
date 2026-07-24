<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Resource Routes
    Route::resource('inventories', InventoryController::class);
    Route::resource('laboratories', LaboratoryController::class);
    Route::resource('users', UserController::class);
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
});
