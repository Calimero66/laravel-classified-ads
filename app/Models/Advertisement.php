<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'category_id',
        'user_id',
        'image_url',
    ];

    /**
     * Get the category associated with the advertisement.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user who created the advertisement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
