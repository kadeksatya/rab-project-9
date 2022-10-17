<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RAB extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_date',
        'construction_service',
        'real_cost',
        'rounded_up_cost',
    ];
}
