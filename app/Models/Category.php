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
        'status' => 'active', // Default status
    ];

    public static $statuses = ['active', 'pending', 'rejected']; // Define allowed statuses

    // creator 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the parent-child relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
