<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = [
        'name', // FREE trial 
        'type', // trial
        'price',
        'description',
        'adCredits',
    ];

   
    protected $attributes = [
        'type' => 'trial', // Default type
        'price' => ['monthly' => 0, 'yearly' => 0]
    ];

    public static $prices = ['monthly','yearly'];
    public static $types = ['trial', 'basic', 'standard', 'premium']; // Define allowed types



    public function features()
    {
        return $this->belongsToMany(Feature::class, 'pricing_feature')->withPivot('available');
    }

}
