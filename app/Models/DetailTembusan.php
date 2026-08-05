<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTembusan extends Model
{
    protected $table = 'details_tembusan';

    protected $fillable = [
        'proposal_id',
        'tembusan',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
