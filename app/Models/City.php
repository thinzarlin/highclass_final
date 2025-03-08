<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'en_name',
        'mm_name',
        'short_name',
        'created_user_id',
        'updated_user_id'
    ];

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class)
            ->using(CityTour::class)
            ->withPivot(['created_user_id', 'updated_user_id'])
            ->withTimestamps();
    }

    public function gates(): HasMany
    {
        return $this->hasMany(Gate::class, 'city_id', 'id');
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
