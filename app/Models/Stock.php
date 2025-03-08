<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $fillable = [
        'code',
        'name',
        'category_id',
        'type',
        'unit_id',
        'sale_price',
        'created_user_id',
        'updated_user_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(StockCategory::class, 'category_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'unit_id');
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
