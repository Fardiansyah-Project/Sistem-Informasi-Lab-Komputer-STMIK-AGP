<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\DetailProposal;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with(['user', 'details'])
            ->latest()
            ->paginate(15);

        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        $users = User::all();

        return view('proposals.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'lampiran' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'details' => 'required|array|min:1',
            'details.*.nama_barang' => 'required|string|max:255',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.ruang_tujuan' => 'required|string|max:255',
            'details.*.keterangan' => 'nullable|string|max:255',
        ]);

        $proposal = Proposal::create([
            'nomor_surat' => $validated['nomor_surat'],
            'lampiran' => $validated['lampiran'],
            'perihal' => $validated['perihal'],
            'tanggal_surat' => $validated['tanggal_surat'],
            'user_id' => $validated['user_id'],
        ]);

        foreach ($validated['details'] as $detail) {
            $proposal->details()->create($detail);
        }

        return redirect()->route('proposals.index')
            ->with('success', 'Pengajuan berhasil dibuat.');
    }

    public function show(Proposal $proposal)
    {
        $proposal->load(['user', 'details']);

        return view('proposals.show', compact('proposal'));
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();

        return redirect()->route('proposals.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }

    /**
     * Halaman cetak surat permohonan pengadaan barang.
     */
    public function print(Proposal $proposal)
    {
        $proposal->load(['user', 'details']);

        // Format tanggal Indonesia menggunakan Carbon
        Carbon::setLocale('id');
        $tanggalFormatted = $proposal->tanggal_surat->translatedFormat('d F Y');

        return view('proposals.print', compact('proposal', 'tanggalFormatted'));
    }
}
