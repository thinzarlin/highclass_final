<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GatePercent extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'tour_id',
        'start_amount',
        'end_amount',
        'percent',
        'home_car',
        'created_user_id',
        'updated_user_id',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function created_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updated_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }    
}
