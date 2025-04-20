<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $connection = 'sqlite_client';
    protected $fillable = ['learning_item_id', 'title', 'description', 'time_limit', 'passing_score'];

    public function learningItem()
    {
        return $this->belongsTo(LearningItem::class, 'learning_item_id');
    }
}