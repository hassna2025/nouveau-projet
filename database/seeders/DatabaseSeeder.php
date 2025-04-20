<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriesSeeder::class,
            ContentsSeeder::class,
            MediaSeeder::class,
            QuizzesSeeder::class,
        ]);
    }
}
