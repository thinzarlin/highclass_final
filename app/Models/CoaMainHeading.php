<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoaMainHeading extends Model
{
    protected $fillable = [
        'name',
        'code_prefix',
    ];

    public function subHeadings(): HasMany
    {
        return $this->hasMany(CoaSubHeading::class, 'main_heading_id', 'id');
    }

    public function accountTypes(): HasMany
    {
        return $this->hasMany(CoaAccountType::class, 'main_heading_id', 'id');
    }

    public function carPLHeadings(): HasMany
    {
        return $this->hasMany(CoaCarPLHeading::class, 'main_heading_id', 'id');
    }
}
