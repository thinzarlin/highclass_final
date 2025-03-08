<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeCarMainCbDetail extends Model
{
    protected $fillable = [
        'cb_id',
        'line_no',
        'coa_id',
        'remark',
        'debit',
        'credit',
        'credit_cargo',
    ];

    public function cb(): BelongsTo
    {
        return $this->belongsTo(HomeCarMainCb::class, 'cb_id');
    }

    public function coa(): BelongsTo
    {
        return $this->belongsTo(Coa::class, 'coa_id');
    }
}
