<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;

class Coa extends Model
{
    use NodeTrait;

    protected $fillable = [
        'code',
        'name',
        'line_no',
        'level',
        'current',

        'sub_heading_id',
        'account_type_id',
        'cash_flow_heading',
        'car_pl_heading_id',
        
        'created_user_id',
        'updated_user_id',
    ];

    public function subHeading(): BelongsTo
    {
        return $this->belongsTo(CoaSubHeading::class, 'sub_heading_id');
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(CoaAccountType::class, 'account_type_id');
    }

    public function carPlHeading(): BelongsTo
    {
        return $this->belongsTo(CoaCarPlHeading::class, 'car_pl_heading_id');
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
