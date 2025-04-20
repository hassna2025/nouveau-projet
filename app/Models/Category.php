<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'order'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    public function learningItems()
    {
        return $this->hasMany(LearningItem::class);
    }
    public function featured()
   {
           return $this->where('is_featured', true)
               ->orderBy('created_at', 'desc')
               ->take(5)
               ->get();
    }
    public function featuredItems()
   {
        return $this->hasMany(LearningItem::class)
               ->where('is_featured', true)
               ->orderBy('created_at', 'desc');
    }
    public function scopeFeatured($query)
{
    return $query->where('is_featured', true)
               ->orderBy('created_at', 'desc');
}
}