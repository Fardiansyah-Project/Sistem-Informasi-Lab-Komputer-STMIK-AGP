<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        $laboratories = Laboratory::withCount('inventories')->latest()->get();

        return view('laboratories.index', compact('laboratories'));
    }

    public function create()
    {
        return view('laboratories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lab' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        Laboratory::create($validated);

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratorium berhasil ditambahkan.');
    }

    public function edit(Laboratory $laboratory)
    {
        return view('laboratories.edit', compact('laboratory'));
    }

    public function update(Request $request, Laboratory $laboratory)
    {
        $validated = $request->validate([
            'nama_lab' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        $laboratory->update($validated);

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratorium berhasil diperbarui.');
    }

    public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratorium berhasil dihapus.');
    }
}
