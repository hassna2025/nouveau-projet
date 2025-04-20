<?php
// database/seeders/ContentsSeeder.php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentsSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        
        foreach ($categories as $category) {
            for ($level = 1; $level <= 3; $level++) {
                Content::create([
                    'category_id' => $category->id,
                    'title' => "{$category->name} Niveau {$level}",
                    'description' => "Contenu éducatif pour {$category->name} niveau {$level}",
                    'level' => $level,
                    'order' => $level,
                    'is_active' => true,
                ]);
            }
        }
    }
}