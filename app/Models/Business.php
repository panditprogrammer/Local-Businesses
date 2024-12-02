<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Business extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'regNo',
        'businessName',
        'description',
        'email',
        'phone',
        'address',
        'logo',
        'legalDocs',
        'establishedAt',
        'location',
        'website',
        'socialLinks',
        'status',
        'verified_at'
    ];


    protected $casts = [
        'address' => 'array',
        'location' => 'array',
        'socialLinks' => 'array'
    ];


    protected $attributes = [
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


    protected static function booted()
    {
        static::created(function ($business) {
            $prefix = env("REGISTRATION_PREFIX", "REGBIZ");
            // Ensure the ID is available after the user is created
            $year = now()->year;  // 4-digit year (e.g., 2024)
            $id = $business->id;  // The business's ID (primary key)

            // Convert the ID to string and check if it needs padding
            $idString = (string) "B" . $id . "U" . $business->user->id;
            // Calculate how much length is needed for the random string
            $remainingLength = 16 - (strlen($prefix) + strlen($year) + strlen($idString));
            $randomString = Str::random($remainingLength);

            // Combine year + id + random string
            $regNo = strtoupper($prefix . $year . $idString . $randomString);

            // Update the business with the generated regNo
            $business->update(['regNo' => $regNo]);
        });
    }

    public static $statuses = ['active','pending','rejected']; 

    // creator 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
