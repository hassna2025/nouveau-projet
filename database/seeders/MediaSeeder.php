<?php
// database/seeders/MediaSeeder.php
namespace Database\Seeders;

use App\Models\Content;
use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run()
    {
        $contents = Content::all();
        
        foreach ($contents as $content) {
            // Images
            Media::create([
                'content_id' => $content->id,
                'type' => 'image',
                'path' => 'media/default/image.jpg',
                'alt_text' => 'Image pour ' . $content->title,
            ]);
            
            // Audio
            Media::create([
                'content_id' => $content->id,
                'type' => 'audio',
                'path' => 'media/default/audio.mp3',
                'alt_text' => 'Audio pour ' . $content->title,
            ]);
            
            // Video
            if ($content->category->name === 'Vidéos') {
                Media::create([
                    'content_id' => $content->id,
                    'type' => 'video',
                    'path' => 'media/default/video.mp4',
                    'alt_text' => 'Vidéo pour ' . $content->title,
                ]);
            }
        }
    }
}