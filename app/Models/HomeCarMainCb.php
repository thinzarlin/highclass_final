<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class HomeCarMainCb extends Model
{
    protected $fillable = [
        'ref_no',
        'main_id',

        'total_income',
        'total_expense',

        'net_amount_debit',
        'net_amount_credit',

        'created_user_id',
        'updated_user_id',
    ];

    protected $with = ['main', 'details'];

    public function main(): BelongsTo
    {
        return $this->belongsTo(HomeCarMain::class, 'main_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(HomeCarMainCbDetail::class, 'cb_id', 'id');
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

        $next_number = 1;
        if ($last_ref_no) {
            $prefix_count = strlen($user_id . $date);
            $numeric_part = (int) substr($last_ref_no, $prefix_count);
            $next_number = $numeric_part + 1;
        } 

        return $user_id . $date . $next_number;
    }
}
