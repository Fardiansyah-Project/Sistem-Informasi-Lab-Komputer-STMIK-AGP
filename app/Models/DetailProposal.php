<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailProposal extends Model
{
    protected $fillable = [
        'proposal_id',
        'nama_barang',
        'jumlah',
        'ruang_tujuan',
        'keterangan',
    ];

    /**
     * Relasi: Detail milik satu pengajuan.
     */
    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class, 'ruang_tujuan');
    }
}
