<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    protected $fillable = [
        'business_id',
        'category_id',
        'title',
        'description',
        'location',
        'address',
        'banner',
        'website',
        'workingDays',
        'gallery',
        'services',
        'paymentMethods',
        'socialLinks',
        'ratings',
        'status',
    ];

    protected $casts = [
        'workingDays' => 'array',
        'gallery' => 'array',
        'services' => 'array',
    ];

    protected $attributes = [
        'services' => [],
        'workingDays' => [],
        'ratings' => 0,
        'location' => [
            'latitude' => null,
            'longitude' => null
        ],
        'address' => [
            'fullAddress' => null,
            'landmark' => null,
            'street' => null,
            'city' => null,
            'pin' => null,
            'state' => null,
            'country' => null
        ],
        'status' => 'active', // Default to active
        'socialLinks' => [],
    ];


    public static $statuses = ['active', 'pending', 'rejected'];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
