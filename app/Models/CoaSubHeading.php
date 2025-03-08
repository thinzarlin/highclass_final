<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoaSubHeading extends Model
{
    protected $fillable = [
        'start_code',
        'end_code',
        'name',
        'main_heading_id',
        'created_user_id',
        'updated_user_id',
    ];

    public function mainHeading(): BelongsTo
    {
        return $this->belongsTo(CoaMainHeading::class, 'main_heading_id');
    }

    public function coas(): HasMany
    {
        return $this->hasMany(Coa::class, 'sub_heading_id', 'id');
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
