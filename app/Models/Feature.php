<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// features for pricing 
class Feature extends Model
{
    protected $fillable = ['name', 'description', 'order'];

    public function plans()
    {
        return $this->belongsToMany(Pricing::class, 'pricing_feature')->withPivot('available');
    }
}
