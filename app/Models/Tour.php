<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kalnoy\Nestedset\NodeTrait;

class Tour extends Model
{
    use NodeTrait;

    protected $fillable = [
        'en_name',
        'mm_name',
        'short_name',
        'route_type',
        'remark',
        'out_tour_id',
        'in_tour_id',
        'current',
        'created_user_id',
        'updated_user_id'
    ];

    protected $with = ['cities'];

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class)
            ->using(CityTour::class)
            ->withPivot(['created_user_id', 'updated_user_id'])
            ->withTimestamps();
    }

    public function outTour()
    {
        return $this->belongsTo(Tour::class, 'out_tour_id');
    }

    public function inTour()
    {
        return $this->belongsTo(Tour::class, 'in_tour_id');
    }

    public function outboundTours()
    {
        return $this->hasMany(Tour::class, 'out_tour_id');
    }

    public function inboundTours()
    {
        return $this->hasMany(Tour::class, 'in_tour_id');
    }

    public function gatePercents()
    {
        return $this->hasMany(GatePercent::class, 'tour_id');
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
