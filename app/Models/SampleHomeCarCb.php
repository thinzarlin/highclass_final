<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleHomeCarCb extends Model
{
    protected $fillable = [
        'tour_id',

        'total_income',
        'total_expense',

        'net_amount_debit',
        'net_amount_credit',

        'created_user_id',
        'updated_user_id',
    ];

    protected $with = ['tour', 'details'];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(SampleHomeCarCbDetail::class, 'cb_id', 'id');
    }

    public function createdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updatedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }
}
