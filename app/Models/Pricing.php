<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'features',
    ];

    protected $casts = [
        'features' => 'array', // Cast features to an array
    ];

    protected $attributes = [
        'type' => 'trial', // Default type
    ];

    public static $types = ['trial', 'basic', 'standard', 'premium']; // Define allowed types

}
