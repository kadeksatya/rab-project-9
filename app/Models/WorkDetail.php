<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'type_data',
        'value_id',
        'koefisien',
        'unit',
        'price',
        'sub_amount',
    ];

    /**
     * Get the material that owns the WorkDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'value_id');
    }


    /**
     * Get the worker that owns the WorkDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class, 'value_id');
    }

    /**
     * Get the tool that owns the WorkDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class, 'value_id');
    }
    
    
}
