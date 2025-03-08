<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Diesel extends Model
{
    protected $fillable = [
        'ref_no',
        'out_date',
        'in_date',
        'purchase_date',
        'daily_car_list_id',
        'tour_id',
        'car_id',
        'route_type',
        'shop_id',
        'stock_id',
        'liter',
        'gallon',
        'price',
        'discount',
        'amount',
        'payment_type',
        'remark',
        'created_user_id',
        'updated_user_id',
    ];

    public function dailyCarList(): BelongsTo
    {
        return $this->belongsTo(DailyCarList::class, 'daily_car_list_id');
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(DieselShop::class, 'shop_id');
    }

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function created_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updated_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }

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
}
