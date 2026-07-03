<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proposal extends Model
{
    protected $fillable = [
        'nomor_surat',
        'lampiran',
        'perihal',
        'tujuan_surat',
        'tanggal_surat',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_surat' => 'date',
        ];
    }

    /**
     * Relasi: Pengajuan milik satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Pengajuan memiliki banyak detail item.
     */
    public function details(): HasMany
    {
        return $this->hasMany(DetailProposal::class);
    }
}
