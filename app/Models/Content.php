<?PHP
// app/Models/Content.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Content extends Model
{
    protected $fillable = [
        'category_id', 'title', 'description', 'level', 'order', 'is_active'
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }
    
    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class);
    }
}