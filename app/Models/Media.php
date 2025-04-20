<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $connection = 'sqlite'; // Ou admin selon besoin
    
    public function learningItem()
    {
        return $this->belongsTo(LearningItem::class);
    }
}