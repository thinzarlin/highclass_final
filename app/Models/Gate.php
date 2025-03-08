<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gate extends Model
{
    protected $fillable = [
        'city_id',
        'en_name',
        'mm_name',
        'main_branch',
        'created_user_id',
        'updated_user_id'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
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
