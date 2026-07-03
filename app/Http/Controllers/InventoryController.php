<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $laboratories = Laboratory::all();

        $query = Inventory::with('laboratory');

        // Filter berdasarkan laboratorium
        if ($request->filled('laboratorium_id')) {
            $query->where('laboratorium_id', $request->laboratorium_id);
        }

        // Pencarian berdasarkan nama atau kode barang
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        $inventories = $query->latest()->paginate(15)->withQueryString();

        return view('inventories.index', compact('inventories', 'laboratories'));
    }

    public function create()
    {
        $laboratories = Laboratory::all();

        return view('inventories.create', compact('laboratories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak',
            'laboratorium_id' => 'required|exists:laboratories,id',
        ]);

        Inventory::create($validated);

        return redirect()->route('inventories.index')
            ->with('success', 'Barang inventaris berhasil ditambahkan.');
    }

    public function edit(Inventory $inventory)
    {
        $laboratories = Laboratory::all();

        return view('inventories.edit', compact('inventory', 'laboratories'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'kondisi' => 'required|in:Baik,Rusak',
            'laboratorium_id' => 'required|exists:laboratories,id',
        ]);

        $inventory->update($validated);

        return redirect()->route('inventories.index')
            ->with('success', 'Barang inventaris berhasil diperbarui.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventories.index')
            ->with('success', 'Barang inventaris berhasil dihapus.');
    }
}
