<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratory extends Model
{
    protected $fillable = [
        'nama_lab',
        'lokasi',
    ];

    /**
     * Relasi: Laboratorium memiliki banyak inventaris.
     */
    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'laboratorium_id');
    }

    public function proposals(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public function DetailProposals(): HasMany
    {
        return $this->hasMany(DetailProposal::class, 'ruang_tujuan');
    }
}
