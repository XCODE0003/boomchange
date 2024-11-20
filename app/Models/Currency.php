<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'image',
        'is_active',
        'type',
        'static_course',
        'address',
        'min_amount',
        'course',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'static_course' => 'boolean',
    ];

}
