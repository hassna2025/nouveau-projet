<?php

namespace Database\Seeders;

use App\Models\LearningItem;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzesSeeder extends Seeder
{
    public function run()
    {
        // Vérifie la connexion à la base admin pour les learning_items
        try {
            DB::connection('sqlite_admin')->getPdo();
        } catch (\Exception $e) {
            $this->command->error('Connexion à la base admin impossible: ' . $e->getMessage());
            return;
        }

        // Vérifie la connexion à la base client pour les quizzes
        try {
            DB::connection('sqlite_client')->getPdo();
        } catch (\Exception $e) {
            $this->command->error('Connexion à la base client impossible: ' . $e->getMessage());
            return;
        }

        // Récupère les learning_items depuis la base admin
        $learningItems = LearningItem::on('sqlite_admin')->get();

        if ($learningItems->isEmpty()) {
            $this->command->warn('Aucun learning item trouvé dans la base admin!');
            return;
        }

        foreach ($learningItems as $item) {
            // Crée le quiz dans la base client
            $quiz = Quiz::on('sqlite_client')->create([
                'learning_item_id' => $item->id,
                'title' => "Quiz: {$item->name}",
                'description' => "Questionnaire sur {$item->name} - {$item->description}",
                'passing_score' => 70, // Correction: 'passing_score' au lieu de 'passing_score'
                'time_limit' => 30,
            ]);

            // Crée 5 questions par quiz dans la base client
            for ($i = 1; $i <= 5; $i++) {
                $correctAnswer = ['a', 'b', 'c', 'd'][rand(0, 3)];
                
                QuizQuestion::on('sqlite_client')->create([
                    'quiz_id' => $quiz->id,
                    'question' => "Question {$i}: Quel est la bonne réponse concernant {$item->name}?",
                    'options' => json_encode([
                        'a' => "Réponse A sur {$item->name}",
                        'b' => "Réponse B sur {$item->name}",
                        'c' => "Réponse C sur {$item->name}",
                        'd' => "Réponse D sur {$item->name}",
                    ]),
                    'correct_answer' => $correctAnswer,
                    'points' => 20,
                    'explanation' => "La bonne réponse est {$correctAnswer} parce que...",
                ]);
            }
        }

        $this->command->info('Quizzes créés avec succès: '.$learningItems->count().' quizzes avec 5 questions chacun.');
    }
}