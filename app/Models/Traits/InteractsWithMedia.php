<?php
namespace App\Models\Traits;

trait InteractsWithMedia
{
    public function media()
    {
        return $this->morphMany(\App\Models\Media::class, 'mediable');
    }
}