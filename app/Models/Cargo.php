<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Cargo extends Model
{
    protected $fillable = [
        'ref_no',
        'date',
        'tour_id',
        'car_id',
        'cargo_no',
        'from_city_id',
        'from_gate_id',
        'from_gate_note',
        'to_city_id',
        'to_gate_id',
        'to_gate_note',
        'sender_name',
        'sender_phone',
        'receiver_name',
        'receiver_phone',

        'item_name',
        'qty',
        'cargo_amt',
        // 'commission',
        'khauk_to',
        'deli',
        // 'paid_amt',
        // 'balance',
        'site_shin',
        'site_shin_prev_car',

        // 'cash_cargo_amt',
        // 'credit_cargo_amt',
        // 'cash_khauk_to',
        // 'credit_khauk_to',
        // 'cash_deli',
        // 'credit_deli',
        'bawdar_fee',
        'total',

        'remark',
        // 'current_city_id',
        // 'current_gate_id',
        // 'current_gate_note',
        // 'current_state',
        // 'status',

        'created_user_id',
        'updated_user_id',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function fromCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function fromGate(): BelongsTo
    {
        return $this->belongsTo(Gate::class, 'from_gate_id');
    }

    public function toCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }

    public function toGate(): BelongsTo
    {
        return $this->belongsTo(Gate::class, 'to_gate_id');
    }

    // public function currentCity(): BelongsTo
    // {
    //     return $this->belongsTo(City::class, 'current_city_id');
    // }

    // public function currentGate(): BelongsTo
    // {
    //     return $this->belongsTo(Gate::class, 'current_gate_id');
    // }

    public function createdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updatedUser(): BelongsTo
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
