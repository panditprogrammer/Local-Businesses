<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    protected $fillable = [
        'featuredFile',
        'status',
        'type',
        'business_id',
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
