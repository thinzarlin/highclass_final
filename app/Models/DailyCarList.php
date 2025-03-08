<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class DailyCarList extends Model
{
    protected $fillable = [
        'ref_no',
        'date',
        'sr_no',
        'tour_id',
        'car_id',
        'driver_1_id',
        'driver_2_id',
        'spare_id',
        'crew_id',
        'created_user_id',
        'updated_user_id',
    ];

    protected $with = ['tour', 'car', 'driver_1', 'driver_2', 'spare', 'crew'];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

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

    public function main(): HasOne
    {
        return $this->hasOne(HomeCarMain::class, 'daily_car_list_id', 'id');
    }

    public function diesel(): HasOne
    {
        return $this->hasOne(Diesel::class, 'daily_car_list_id', 'id');
    }

    public function created_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updated_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }

    // protected static function booted()
    // {
    //     static::creating(function ($data) {
    //         $data->ref_no = self::generateRefNo(Carbon::parse($data->date)->format('Ym'));
    //         $data->sr_no = self::generateSrNo(Carbon::parse($data->date)->format('Y-m-d'));
    //     });
    // }

    public static function generateRefNo($date): string
    {
        $user_id = Auth::id();
        $search = $user_id . $date . '%';
        $last_ref_no = self::query()->where('ref_no', 'like', $search)->max('ref_no');
        
        $next_number = 1;
        if ($last_ref_no) {
            $prefix_count = strlen($user_id . $date);
            $numeric_part = (int) substr($last_ref_no, $prefix_count);
            $next_number = $numeric_part + 1;
        }

        return $user_id . $date . $next_number;
    }

    public static function generateSrNo($date): string
    {
        return ((int) (self::query()->where('date', $date)->max('sr_no') ?? 0)) + 1;
    }
}
