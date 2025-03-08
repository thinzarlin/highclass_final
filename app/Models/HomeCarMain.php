<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class HomeCarMain extends Model
{
    protected $fillable = [
        'ref_no',
        'out_date',
        'in_date',
        'tour_id',
        'car_id',
        'daily_car_list_id',

        'tickets',
        'total_people',
        'total_ticket',
        'insurance',
        'ticket_income',

        'total_cargo',
        'cash_cargo',
        'credit_cargo',
        'cargo_bd',
        'lu_par_cargo',
        'out_cargos',
        'cargo_income',

        'grand_total',

        'gate_percent',
        'gate_commission',

        'water_small_qty',
        'water_small_amt',
        'water_large_qty',
        'water_large_amt',
        'drink_qty',
        'drink_amt',
        'snack_qty',
        'snack_amt',
        'snack_special_qty',
        'snack_special_amt',
        'towel_qty',
        'towel_amt',
        'plastic_bag_qty',
        'plastic_bag_amt',
        'candy_qty',
        'candy_amt',
        'guest_reg',
        'medicine',
        'coffee',
        'coffee_cup',
        'ticket_disc',
        'total_expense',

        'pot_sat',
        'la_tha',
        'copy',
        'total_rta',

        'ygn_lan_tg_ticket',
        'lan_tg_ticket',
        'gate_out',
        'ferry',
        'ask_khauk_to',
        'deli',
        'khauk_to',
        'other_expense',
        'site_shin',

        'total',

        'remark',
        'created_user_id',
        'updated_user_id',
    ];

    protected $casts = [
        'tickets' => 'array',
        'out_cargos' => 'array',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function daily_car_list(): BelongsTo
    {
        return $this->belongsTo(DailyCarList::class, 'daily_car_list_id');
    }

    public function cb(): HasOne
    {
        return $this->hasOne(HomeCarMainCb::class, 'main_id', 'id');
    }

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

        if ($last_ref_no) {
            $prefix_count = strlen($user_id . $date);
            $numeric_part = (int) substr($last_ref_no, $prefix_count);
            $next_number = $numeric_part + 1;
        } else {
            $next_number = 1;
        }

        return $user_id . $date . $next_number;
    }
}
