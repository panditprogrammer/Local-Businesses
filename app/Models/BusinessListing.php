<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    protected $fillable = [
        'user_id',
        'business_id',
        'title',
        'image',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $attributes = [
        'status' => true, // Default to active
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
