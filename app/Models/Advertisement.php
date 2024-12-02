<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'business_id',
        'ad',
        'type',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $attributes = [
        'status' => false, // Default to inactive
    ];

    public static $types = ['video', 'image']; // Define allowed types



    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
