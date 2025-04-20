<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_item_id'); // Clé étrangère sans contrainte
            $table->string('title');
            $table->text('description');
            $table->integer('time_limit')->nullable();
            $table->integer('passing_score')->default(70);
            $table->timestamps();
            
            // Index pour améliorer les performances
            $table->index('learning_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};