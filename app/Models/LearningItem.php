<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningItem extends Model
{
    use SoftDeletes;

    protected $connection = 'sqlite_admin';
    protected $fillable = ['category_id', 'name', 'description', 'difficulty_level', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}