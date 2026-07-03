<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jumlah',
        'kondisi',
        'laboratorium_id',
    ];

    /**
     * Relasi: Inventaris milik satu laboratorium.
     */
    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class, 'laboratorium_id');
    }
}
