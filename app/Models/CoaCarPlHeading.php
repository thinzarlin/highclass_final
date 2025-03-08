<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoaCarPlHeading extends Model
{
    protected $fillable = [
        'name',
        'main_heading_id',
    ];

    public function mainHeading(): BelongsTo
    {
        return $this->belongsTo(CoaMainHeading::class, 'main_heading_id');
    }

    public function coas(): HasMany
    {
        return $this->hasMany(Coa::class, 'car_pl_heading_id', 'id');
    }
}
