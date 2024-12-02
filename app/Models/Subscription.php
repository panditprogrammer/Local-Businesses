<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = [
        'business_id',
        'pricing_id',
        'type',
        'startDate',
        'endDate',
        'isActive',
    ];

    protected $casts = [
        'startDate' => 'datetime',
        'endDate' => 'datetime',
        'isActive' => 'boolean',
    ];

    protected $attributes = [
        'type' => 'monthly', // Default type
        'isActive' => false,  // Default active status
    ];

    public static $types = ['monthly', 'yearly']; // Define allowed subscription types


    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function pricing()
    {
        return $this->belongsTo(Pricing::class, 'pricing_id');
    }

    // Automatically calculate end date before saving the subscription
    public static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            if (!$subscription->endDate) { // Calculate endDate if not set
                $subscription->endDate = ($subscription->type === 'monthly')
                    ? Carbon::parse($subscription->startDate)->addMonth()
                    : Carbon::parse($subscription->startDate)->addYear();
            }
        });
    }
}
