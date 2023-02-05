<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RAB extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'project_date',
        'construction_service',
        'real_cost',
        'rab_cost',
        'cco_cost',
        'rounded_up_cost',
    ];


    /**
     * Get all of the rabDetails for the RAB
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rabDetails(): HasMany
    {
        return $this->hasMany(RABDetail::class, 'rab_id', 'id');
    }
}
