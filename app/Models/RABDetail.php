<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RABDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rab_id',
        'work_category_id',
        'work_id',
        'volume',
        'unit',
        'price',
        'sub_amount',
        'is_overbudget',
        'is_add',
    ];

    /**
     * Get the category that owns the RABDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(WorkType::class, 'work_category_id');
    }

    /**
     * Get the work that owns the RABDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class, 'work_id');
    }

    
}
