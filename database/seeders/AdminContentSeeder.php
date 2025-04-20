<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminContentSeeder extends Seeder
{
    public function run()
{
    // Désactiver les contraintes FK
    DB::connection('sqlite_admin')->statement('PRAGMA foreign_keys = OFF;');

    // Catégories
    DB::connection('sqlite_admin')->table('categories')->insert([
        [
            'id' => 1,
            'name' => 'Animaux',
            'slug' => 'animaux',
            'icon' => '🐶',
            'order' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'name' => 'Transports',
            'slug' => 'transports',
            'icon' => '🚗',
            'order' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);

    // Learning Items
    DB::connection('sqlite_admin')->table('learning_items')->insert([
        [
            'category_id' => 1,
            'title' => 'Le Chien',
            'content' => 'Animal domestique',
            'image_path' => 'animaux/chien.jpg',
            'audio_path' => null,
            'video_path' => null,
            'difficulty_level' => 1,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'category_id' => 1,
            'title' => 'Le Chat',
            'content' => 'Animal indépendant',
            'image_path' => null,
            'audio_path' => 'animaux/chat.mp3',
            'video_path' => null,
            'difficulty_level' => 1,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);

    // Réactiver les contraintes
    DB::connection('sqlite_admin')->statement('PRAGMA foreign_keys = ON;');
}
}