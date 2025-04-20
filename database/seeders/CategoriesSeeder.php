<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Animaux', 'icon' => '🐶', 'order' => 1],
            ['name' => 'Mathématiques', 'icon' => '➕', 'order' => 2],
            ['name' => 'Langues', 'icon' => '🔤', 'order' => 3],
            ['name' => 'Jeux éducatifs', 'icon' => '🎮', 'order' => 4],
            ['name' => 'Vidéos', 'icon' => '🎥', 'order' => 5],
            ['name' => 'Activités créatives', 'icon' => '🎨', 'order' => 6],
            ['name' => 'Maths de base', 'icon' => '🔢', 'order' => 7],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']), // Ajout du slug
                'icon' => $category['icon'],
                'order' => $category['order'],
            ]);
        }
    }
}