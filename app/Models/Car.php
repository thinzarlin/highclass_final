<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    protected $fillable = [
        'car_no',
        'owner',
        'driver_1_id',
        'driver_2_id',
        'spare_id',
        'crew_id',
        'type',
        'type_detail',
        'people',
        'current',
        'home_car',
        'sold',
        'remark',
        'created_user_id',
        'updated_user_id',
    ];

    public function driver_1(): BelongsTo
    {
        return $this->belongsTo(CarStaff::class, 'driver_1_id');
    }

    public function driver_2(): BelongsTo
    {
        return $this->belongsTo(CarStaff::class, 'driver_2_id');
    }

    public function spare(): BelongsTo
    {
        return $this->belongsTo(CarStaff::class, 'spare_id');
    }

    public function crew(): BelongsTo
    {
        return $this->belongsTo(CarStaff::class, 'crew_id');
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
