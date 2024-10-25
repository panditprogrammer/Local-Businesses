<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'email',
        'phone',
        'address',
        'description',
        'website',
        'workingDaysandHours',
        'images',
        'socialLinks',
        'logo',
        'banner',
        'services',
        'ratings',
        'status',
    ];


    protected $casts = [
        'address' => 'array',
        'workingDaysandHours' => 'array',
        'images' => 'array',
        'socialLinks' => 'array',
        'services' => 'array',
        'status' => 'boolean',
    ];

    protected $attributes = [
        'address' => [
            'landmark' => null,
            'street' => null,
            'city' => null,
            'pin' => null,
            'state' => null,
            'country' => null
        ],
        'status' => true, // Default to active
        'images' => [],
        'services' => [],
        'ratings' => ['average' => 0, 'totals' => 0],
    ];

    // creator 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
}
