<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'banner',
        'status',
        'parent_id'
    ];


    protected $attributes = [
        'status' => 'pending', // Default status
    ];

    public static $statuses = ['active', 'pending', 'rejected']; // Define allowed statuses

    // creator 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
