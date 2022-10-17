<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkType extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'name',
    ];


    /**
     * Get all of the works for the WorkType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'work_category_id', 'id');
    }
}
