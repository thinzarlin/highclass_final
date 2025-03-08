<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class CbRecord extends Model
{
    protected $fillable = [
        'ref_no',
        'date',
        'line_no',
        'coa_id',
        'remark',
        'debit',
        'credit',

        'created_user_id',
        'updated_user_id',
    ];

    public function coa(): BelongsTo
    {
        return $this->belongsTo(Coa::class, 'coa_id');
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

    public static function generateLineNo($date): string
    {
        return ((int) (self::query()->where('date', $date)->max('line_no') ?? 0)) + 1;
    }
}
