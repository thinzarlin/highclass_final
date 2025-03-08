<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CityTour extends Pivot
{
    protected $fillable = [
        'city_id',
        'tour_id',
        'created_user_id',
        'updated_user_id'
    ];
}
