<?php
// app/Models/UserProgress.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $connection = 'sqlite';

    public function learningItem()
    {
        return $this->belongsTo(\App\Models\LearningItem::class);
    }
}