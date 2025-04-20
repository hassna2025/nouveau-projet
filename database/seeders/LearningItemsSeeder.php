<?php

namespace Database\Seeders;

use App\Models\LearningItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningItemsSeeder extends Seeder
{
    /**
     * Exécute le seeder pour la table learning_items (base admin)
     */
    public function run()
    {
        // Vérifie la connexion à la base admin
        try {
            DB::connection('sqlite_admin')->getPdo();
        } catch (\Exception $e) {
            $this->command->error('Connexion à la base admin impossible: ' . $e->getMessage());
            return;
        }

        // Désactive les contraintes de clé étrangère temporairement
        DB::connection('sqlite_admin')->statement('PRAGMA foreign_keys = OFF');

        // Vide la table si elle existe
        if (DB::connection('sqlite_admin')->getSchemaBuilder()->hasTable('learning_items')) {
            DB::connection('sqlite_admin')->table('learning_items')->truncate();
        }

        // Données de démonstration pour les catégories d'apprentissage
        $learningItems = [
            // Catégorie 1: Animaux
            [
                'category_id' => 1,
                'name' => 'Animaux domestiques',
                'description' => 'Découvrez les animaux de compagnie courants',
                'difficulty_level' => 1,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Animaux de la ferme',
                'description' => 'Apprenez à connaître les animaux de la ferme',
                'difficulty_level' => 1,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Animaux sauvages',
                'description' => 'Explorez le monde des animaux sauvages',
                'difficulty_level' => 2,
                'is_active' => true,
            ],

            // Catégorie 2: Transports
            [
                'category_id' => 2,
                'name' => 'Véhicules terrestres',
                'description' => 'Découvrez les différents véhicules qui roulent sur terre',
                'difficulty_level' => 1,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Véhicules aériens',
                'description' => 'Apprenez sur les avions et autres véhicules volants',
                'difficulty_level' => 2,
                'is_active' => true,
            ],

            // Catégorie 3: Couleurs
            [
                'category_id' => 3,
                'name' => 'Couleurs primaires',
                'description' => 'Les couleurs de base pour commencer',
                'difficulty_level' => 1,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Mélanges de couleurs',
                'description' => 'Comment mélanger les couleurs pour en créer de nouvelles',
                'difficulty_level' => 2,
                'is_active' => true,
            ],
        ];

        // Insertion des données
        foreach ($learningItems as $item) {
            LearningItem::on('sqlite_admin')->create([
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'description' => $item['description'],
                'difficulty_level' => $item['difficulty_level'],
                'is_active' => $item['is_active'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Réactive les contraintes
        DB::connection('sqlite_admin')->statement('PRAGMA foreign_keys = ON');

        $this->command->info('Learning items créés avec succès dans la base admin!');
        $this->command->info('Total: '.count($learningItems).' éléments d\'apprentissage insérés.');
    }
}