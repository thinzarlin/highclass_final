<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OwnerMainSetting extends Model
{
    protected $fillable = [
        'tour_id',
        'water_small',
        'water_large',
        'drink',
        'snack_special',
        'snack',
        'towel',
        'plastic_bag',
        'candy',
        'guest_reg',
        'medicine',
        'pot_sat',
        'la_tha',
        'ask',
        'gate_out',
        'created_user_id',
        'updated_user_id',
        'insurance',
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
